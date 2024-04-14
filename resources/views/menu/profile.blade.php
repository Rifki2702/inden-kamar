@extends('layout.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    <div class="row">
        <div class="col-lg-6">
            @if(session('message'))
            <div class="alert alert-warning">{{ session('message') }}</div>
            @endif
            @if(session('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <!-- Default Card Example -->
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/profile/' . auth()->user()->image) }}" class="card-img" alt="User Image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ auth()->user()->name }}</h5>
                            <p class="card-text">{{ auth()->user()->email }}</p>
                            <p class="card-text">
                                <small class="text-body-secondary">Member since {{ auth()->user()->created_at->format('M Y') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-user" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Full Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ auth()->user()->name }}">
                                @error('name')
                                <small class="text-danger pl-3">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label">Foto</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control-file" id="image" name="image">
                                @error('image')
                                <small class="text-danger pl-3">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection