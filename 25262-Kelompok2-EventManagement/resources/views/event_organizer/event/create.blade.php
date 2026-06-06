@extends('organizermain')

@section('title', 'Tambah Event')

@section('content')
<form action="{{ route('events.store') }}" method="POST">
    @csrf

    @error('organizer')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori Event</label>
        <select class="form-control" id="kategori_id" name="kategori_id">
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->kategori_id }}" {{ old('kategori_id') == $category->kategori_id ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nama_event" class="form-label">Nama Event</label>
        <input type="text" class="form-control" id="nama_event" name="nama_event" value="{{ old('nama_event') }}">
        @error('nama_event')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
        @error('tanggal_mulai')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}">
        @error('lokasi')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="google_maps" class="form-label">Google Maps</label>
        <input type="text" class="form-control" id="google_maps" name="google_maps" value="{{ old('google_maps') }}">
        @error('google_maps')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mt-2">Submit</button>

</form>
@endsection