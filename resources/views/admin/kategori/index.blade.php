@extends('adminmainbaru')

@section('title','Kategori')

@section('content')
<a href="{{route('kategori.create')}}" class="btn btn-primary mb-2">Tambah </a>
    
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($result as $item)
            <tr>
                <td>{{$item->nama_kategori}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

