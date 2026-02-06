@extends('dashboard')

@section('content')
<div class="container-fluid px-4">

    <h1 class="h3 mb-4 text-gray-800">Edit Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Foto Profile</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3 text-center">
                        @if(auth()->user()->photo)
                            <img src="{{ asset('storage/photos/' . auth()->user()->photo) }}" width="120" class="rounded shadow">
                        @else
                            <img src="{{ asset('assets/img/user2-160x160.jpg') }}" width="120" class="rounded shadow">
                        @endif
                    </div>

                </div>

                <button class="btn btn-primary">Update Profile</button>

            </form>
        </div>
    </div>
</div>
@endsection
