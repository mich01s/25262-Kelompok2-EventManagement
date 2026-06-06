@extends('adminmain')
@section('title','Event')

@section('content')
<a href="{{ route('events.create') }}" class="btn btn-primary"> tambah Event</a>

<table class="table table-sm" >
    <tr> 
        <th>No</th>
        <th>Nama Event</th>
        <th>Deskripsi</th>
        <th>Tanggal</th>
        <th>Lokasi</th>
        <th>Aksi</th>
    </tr>


@foreach ($events as $key => $event)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $event->nama_event }}</td>
        <td>{{ $event->deskripsi }}</td>
        <td>{{ $event->tanggal }}</td>
        <td>{{ $event->lokasi }}</td>
        <td>
<form method="POST" action="{{ route('events.destroy', $event->event_id) }}" class="d-inline">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-xs btn-danger btn-rounded show_confirm"
                        data-toggle="tooltip" title='Delete'
                        data-nama='{{ $event->nama_event }}'>Hapus</button>
                </form>
                <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-xs btn-warning btn-rounded">Edit</a>
                

        </td>
    </tr>               
@endforeach
</table>
@endsection