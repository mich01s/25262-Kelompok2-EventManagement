@extends('adminmain')

@section('title', 'Tambah Organizer')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('organizer.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{ old('user_id') }}">
                @error('user_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_organizer" class="form-label">Nama Organizer</label>
                <input type="text" class="form-control @error('nama_organizer') is-invalid @enderror" id="nama_organizer" name="nama_organizer" value="{{ old('nama_organizer') }}">
                @error('nama_organizer')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('organizer.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
