@extends('usermain')

@section('title', $event->nama_event)

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Event Details Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ $event->nama_event }}</h3>
                </div>

                <div class="card-body">
                    <!-- Event Info Grid -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted text-uppercase">Tanggal Mulai</h6>
                            <p class="h5">
                                <i class="bi bi-calendar-event text-primary"></i>
                                {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y H:i') }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted text-uppercase">Lokasi</h6>
                            <p class="h5">
                                <i class="bi bi-geo-alt text-primary"></i>
                                {{ $event->lokasi }}
                            </p>
                        </div>

                        @if($event->kategori)
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted text-uppercase">Kategori</h6>
                                <p class="h5">
                                    <span class="badge bg-primary">{{ $event->kategori->nama_kategori }}</span>
                                </p>
                            </div>
                        @endif

                        @if($event->organizer)
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted text-uppercase">Organizer</h6>
                                <p class="h5">{{ $event->organizer->nama_organizer ?? 'N/A' }}</p>
                            </div>
                        @endif
                    </div>

                    <hr>

                    <!-- Google Maps -->
                    <div class="mb-4">
                        <h5>Lokasi pada Peta</h5>
                        @if($event->google_maps)
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe src="{{ $event->google_maps }}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <p class="small text-muted">
                                <a href="{{ $event->google_maps }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-box-arrow-up-right"></i> Buka di Google Maps
                                </a>
                            </p>
                        @else
                            <div class="alert alert-warning">
                                Google Maps link tidak tersedia untuk event ini.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Info Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Informasi Event</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Event ID:</span>
                        <strong>{{ $event->event_id }}</strong>
                    </div>

                    @if($event->organizer)
                        <div class="d-flex justify-content-between mb-3">
                            <span>Organizer:</span>
                            <strong>{{ $event->organizer->nama_organizer ?? 'N/A' }}</strong>
                        </div>
                    @endif

                    <hr>

                    <p class="text-muted small">
                        <i class="bi bi-clock"></i>
                        Dibuat: {{ $event->created_at->format('d M Y H:i') }}
                    </p>
                </div>
            </div>

            <!-- Action Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-3">Tertarik dengan event ini?</p>
                    <button class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-ticket-perforated"></i> Beli Tiket
                    </button>
                    <button class="btn btn-outline-secondary w-100">
                        <i class="bi bi-share"></i> Bagikan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
