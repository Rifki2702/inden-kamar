<?php

namespace App\Http\Controllers;

use App\Charts\IndenChart;
use App\Charts\PasienChart;
use App\Charts\StatusChart;
use App\Models\IndenPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function dashboard(Request $request, StatusChart $StatusChart, PasienChart $PasienChart, IndenChart $IndenChart)
    {
        $StatusChart = $StatusChart->build();
        $PasienChart = $PasienChart->build();
        $IndenChart = $IndenChart->build();
        $totalPasien = IndenPasien::count();
        $totalIndenKamar = IndenPasien::where('status', 'proses')->count();

        return view('menu.dashboard', compact('StatusChart', 'PasienChart', 'totalPasien', 'totalIndenKamar', 'IndenChart'));
    }

    public function profile()
    {
        return view('menu.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile', $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect()->back()->with('message', 'Profile updated successfully');
    }

    public function indenkamar()
    {
        $indenPasien = IndenPasien::all(); // Ganti dengan cara Anda untuk mendapatkan data
        return view('menu.indenkamar', compact('indenPasien'));
    }

    public function insertinden(Request $request)
    {
        $request->validate([
            'rm' => 'required',
            'nama' => 'required',
            'telepon' => 'required',
            'telepon1' => 'required',
            'diagnosa' => 'required',
            'dpjp' => 'required',
            'kelas' => 'required',
            'mrs' => 'required',
        ]);

        $data = [
            'tanggal_input' => now(),
            'no_rm' => $request->rm,
            'nama_pasien' => $request->nama,
            'no_telepon' => $request->telepon,
            'no_telepon1' => $request->telepon1,
            'diagnosa' => $request->diagnosa,
            'dpjp' => $request->dpjp,
            'kelas_perawatan' => $request->kelas,
            'tanggal_mrs' => $request->mrs,
            'status' => 'proses',
        ];

        IndenPasien::create($data);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function updateinden(Request $request, $id)
    {
        // Validasi data yang diterima dari form edit
        $request->validate([
            'no_rm' => 'required|numeric|min:1|max:9999999',
            'nama_pasien' => 'required|string|max:255',
            'no_telepon' => 'required|numeric|min:1',
            'no_telepon1' => 'required|numeric|min:1',
            'diagnosa' => 'required|string|max:255',
            'dpjp' => 'required|string|max:255',
            'kelas_perawatan' => 'required|string|max:255',
            'ruang' => 'required|string|max:255',
            'bed' => 'required|string|max:255',
            'tanggal_mrs' => 'required|date',
        ]);

        // Mengambil data yang akan diupdate dari database
        $data = IndenPasien::findOrFail($id);

        // Mengupdate data
        $data->update([
            'no_rm' => $request->no_rm,
            'nama_pasien' => $request->nama_pasien,
            'no_telepon' => $request->no_telepon,
            'no_telepon1' => $request->no_telepon1,
            'diagnosa' => $request->diagnosa,
            'dpjp' => $request->dpjp,
            'kelas_perawatan' => $request->kelas_perawatan,
            'ruang' => $request->ruang,
            'bed' => $request->bed,
            'tanggal_mrs' => $request->tanggal_mrs,
        ]);

        // Redirect dengan flash message
        return redirect()->route('admin.indenkamar')->with('warning', 'Data berhasil diupdate.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:batal,proses,selesai',
        ]);

        $indenPasien = IndenPasien::findOrFail($id);

        // Jika status sudah batal atau selesai, maka tidak dapat diubah
        if (($indenPasien->status == 'batal' || $indenPasien->status == 'selesai') && $request->status != $indenPasien->status) {
            return redirect()->back()->with('error', 'Status tidak dapat diubah karena sudah batal atau selesai.');
        }

        // Update status dan warna tombol
        $indenPasien->status = $request->status;
        $indenPasien->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function tambahuser()
    {
        $users = User::all();
        return view('menu.tambahuser', compact('users'));
    }

    public function insertuser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    public function printdata(Request $request)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        $data = IndenPasien::whereBetween('tanggal_mrs', [$startDate, $endDate])->get();

        return view('menu.print', ['data' => $data]);
    }

    public function deletedata($id)
    {
        $inden = IndenPasien::find($id);

        if (!$inden) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $nama = $inden->nama_pasien; // Simpan nama pasien untuk pesan success
        $inden->delete();

        return redirect()->route('admin.indenkamar')->with('danger', 'Data ' . $nama . ' berhasil dihapus');
    }

    public function getStatusCounts()
    {
        $jumlahBatal = IndenPasien::where('status', 'batal')->count();
        $jumlahSelesai = IndenPasien::where('status', 'selesai')->count();
        $jumlahProses = IndenPasien::where('status', 'proses')->count();

        return view('menu.dashboard', compact('jumlahBatal', 'jumlahSelesai', 'jumlahProses'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $user->delete();

        return redirect()->back()->with('danger', 'Data berhasil dihapus');
    }

    public function updatedata(request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;

        if ($request->hasFile('new_image')) {
            $image = $request->file('new_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public', $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect()->route('admin.tambahuser')->with('warning', 'User updated successfully');
    }
}
