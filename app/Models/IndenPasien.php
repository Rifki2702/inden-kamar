<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndenPasien extends Model
{
    protected $table = 'indenpasien';

    protected $fillable = [
        'tanggal_input',
        'no_rm',
        'nama_pasien',
        'no_telepon',
        'no_telepon1',
        'diagnosa',
        'dpjp',
        'kelas_perawatan',
        'tanggal_mrs',
        'status',
        'ruang',
        'bed',
    ];

    public $timestamps = false; // Menonaktifkan timestamps

    protected $dates = [
        'tanggal_input',
        'tanggal_mrs',
    ];

    public $incrementing = true; // Mengaktifkan incrementing untuk primary key
}
