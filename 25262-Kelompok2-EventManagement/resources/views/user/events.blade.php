@extends('usermain')

@section('title','Events')

@section('content')
    <div class="mb-4">
        @if(!empty($q))
            <p class="mb-2">Hasil pencarian untuk: <strong>"{{ $q }}"</strong></p>
        @else
            <p class="mb-2">Menampilkan semua event.</p>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Event</th>
                    <th>Tanggal Mulai</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ $event->nama_event }}</td>
                        <td>{{ $event->tanggal_mulai }}</td>
                        <td>{{ $event->lokasi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada event yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
