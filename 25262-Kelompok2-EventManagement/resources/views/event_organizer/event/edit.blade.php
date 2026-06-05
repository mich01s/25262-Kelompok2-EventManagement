@extends('organizermain')

@section('title', 'Edit Event')

@section('content')
<div class="card card-primary m-2 p-3">
    <form action="{{ route('events.update', $event->event_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori Event</label>
            <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->kategori_id }}" {{ old('kategori_id', $event->kategori_id) == $category->kategori_id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama_event" class="form-label">Nama Event</label>
            <div class="form-group">
                <input type="text" class="form-control @error('nama_event') is-invalid @enderror" id="nama_event" name="nama_event" value="{{ old('nama_event', $event->nama_event) }}">
            </div>
            @error('nama_event')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <div class="form-group">
                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $event->tanggal_mulai) }}">
            </div>
            @error('tanggal_mulai')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <div class="form-group">
                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $event->lokasi) }}">
            </div>
            @error('lokasi')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="google_maps" class="form-label">Google Maps</label>
            <div class="form-group">
                <input type="text" class="form-control @error('google_maps') is-invalid @enderror" id="google_maps" name="google_maps" value="{{ old('google_maps', $event->google_maps) }}">
            </div>
            @error('google_maps')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning mt-2">Update Event</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary mt-2">Batal</a>
    </form>
</div>
@endsection