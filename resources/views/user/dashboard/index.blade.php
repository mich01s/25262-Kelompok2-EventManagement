@extends('usermainbaru')

@section('title','Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mb-4">Event Terbaru</h4>
        </div>
    </div>

    <div class="row">
        @forelse($events as $event)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 event-card" style="cursor: pointer; transition: transform 0.2s;">
                    <!-- Event Image/Map Preview -->
                    @if($event->foto)
                        <div class="card-img-top position-relative overflow-hidden" style="height: 200px; background-color: #f8f9fa;">
                            <img src="{{ asset('storage/event_fotos/' . $event->foto) }}" alt="{{ $event->nama_event }}" class="img-fluid w-100 h-100 object-fit-cover">
                        </div>
                    @else
                        <div class="card-img-top bg-light position-relative overflow-hidden" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="text-center text-white">
                                    <i class="bi bi-geo-alt" style="font-size: 3rem;"></i>
                                    <p class="mt-2 small">{{ $event->lokasi }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card-body">
                        <!-- Event Title -->
                        <h5 class="card-title text-truncate" style="cursor: pointer;">
                            <a href="{{ route('user.events.show', $event->event_id) }}" class="text-decoration-none text-dark">
                                {{ $event->nama_event }}
                            </a>
                        </h5>

                        <!-- Date -->
                        <p class="card-text text-muted small mb-2">
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}
                        </p>

                        <!-- Location -->
                        <p class="card-text small text-muted mb-3">
                            <i class="bi bi-geo-alt"></i>
                            {{ Str::limit($event->lokasi, 30) }}
                        </p>

                        <!-- Category Badge -->
                        @if($event->kategori)
                            <span class="badge bg-primary mb-3">{{ $event->kategori->nama_kategori }}</span>
                        @endif
                    </div>

                    <div class="card-footer bg-white border-top">
                        <a href="{{ route('user.events.show', $event->event_id) }}" class="btn btn-sm btn-primary w-100">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Belum ada event tersedia.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($events->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif

    <style>
        .event-card {
            transition: all 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
        }

        .event-card .card-title a {
            font-weight: 600;
            transition: color 0.2s;
        }

        .event-card .card-title a:hover {
            color: #667eea !important;
        }
    </style>
@endsection

