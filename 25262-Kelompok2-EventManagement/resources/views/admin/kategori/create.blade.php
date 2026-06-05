@extends('adminmain')



@section('title', 'Tambah kategori')

@section('content')
<form action="{{route('kategori.store')}}" method="POST">
    <div class="mb-3">
        <label for="nama_kategori" class="form-label">Nama_Kategori</label>
        <div class="form group" value="{{old('nama_kategori')}}">
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori">
        </div>
    </div>

    @error('nama_kategori')
    <div class="text-danger">{{ $message }}</div>
        
    @enderror
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>
@endsection