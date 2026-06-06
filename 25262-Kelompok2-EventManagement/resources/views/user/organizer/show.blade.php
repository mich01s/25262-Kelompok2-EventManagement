@extends('usermain')

@section('title', $organizer->nama_organizer)

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('user.organizer.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Organizer
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title">{{ $organizer->nama_organizer }}</h4>
                    <p class="text-muted">Total event: {{ $events->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($events as $event)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('user.events.show', $event->event_id) }}" class="text-decoration-none text-dark">
                                {{ $event->nama_event }}
                            </a>
                        </h5>
                        <p class="text-muted small mb-1">
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}
                        </p>
                        <p class="card-text small text-muted mb-3">
                            <i class="bi bi-geo-alt"></i>
                            {{ $event->lokasi }}
                        </p>
                        <a href="{{ route('user.events.show', $event->event_id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Tidak ada event untuk organizer ini.</div>
            </div>
        @endforelse
    </div>
@endsection
