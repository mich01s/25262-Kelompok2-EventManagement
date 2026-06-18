@extends('organizermainbaru')
@section('title','Event')

@section('content')
<div class="mb-3">
    <a href="{{ route('events.create') }}" class="btn btn-primary">Tambah Event</a>
</div>

<table class="table table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Event</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Google Maps</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

@foreach ($events as $key => $event)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $event->nama_event }}</td>
        <td>{{ $event->tanggal_mulai }}</td>
        <td>{{ $event->lokasi }}</td>
        <td>{{ $event->google_maps }}</td>
        <td>
            @if ($event->foto)
                <img src="{{ asset('storage/event_fotos/' . $event->foto) }}" alt="Foto Event" width="100">
            @else
                <p>foto tidak tersedia</p>
            @endif
        </td>
        <td>
            <form method="POST" action="{{ route('events.destroy', $event->event_id) }}" class="d-inline me-1">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="btn btn-xs btn-danger btn-rounded show_confirm"
                    data-toggle="tooltip" title="Delete"
                    data-nama="{{ $event->nama_event }}">Hapus</button>
            </form>
            <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-xs btn-warning btn-rounded">Edit</a>
        </td>
    </tr>
@endforeach
    </tbody>
</table>
@endsection