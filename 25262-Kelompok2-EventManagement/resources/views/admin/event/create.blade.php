@extends('adminmain')

@section('title', 'Tambah Event')

@section('content')
<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
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
        <label for="pengisi_id" class="form-label">Pengisi event</label>
        <select class="form-control @error('pengisi_id') is-invalid @enderror" id="pengisi_id" name="pengisi_id[]" multiple>
            @foreach ($pengisis as $pengisi)
                <option value="{{ $pengisi->pengisi_acara_id }}" {{ in_array($pengisi->pengisi_acara_id, old('pengisi_id', [])) ? 'selected' : '' }}>
                    {{ $pengisi->nama_pengisi_acara }}
                </option>
            @endforeach
        </select>
        @error('pengisi_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        @if ($pengisis->isEmpty())
            <div class="text-warning mt-2">
                Belum ada pengisi acara. Silakan buat terlebih dahulu melalui <a href="{{ route('pengisi.create') }}">menu Pengisi Acara</a>.
            </div>
        @endif
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
        <input type="date"
               class="form-control datepicker"
               id="tanggal_mulai"
               name="tanggal_mulai"
               value="{{ old('tanggal_mulai', date('Y-m-d')) }}"
               placeholder="YYYY-MM-DD"
               autocomplete="off">
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

    <div class="form-group">
            <label for="">foto</label>
            <input type="file" name="foto" class="form-control" value="{{ old('foto') }}">
        </div>
        @error('foto')
            <div class="text-danger"> {{ $message }} </div>
        @enderror

    <button type="submit" class="btn btn-primary mt-2">Submit</button>

</form>
@endsection