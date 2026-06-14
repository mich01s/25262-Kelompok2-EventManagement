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
                    @php
                        $googleMapsUrl = $event->google_maps;
                        $isEmbedUrl = $googleMapsUrl && str_contains($googleMapsUrl, '/maps/embed');
                    @endphp
                    <div class="mb-4">
                        <h5>Lokasi pada Peta</h5>
                        @if($googleMapsUrl)
                            @if($isEmbedUrl)
                                <div class="ratio ratio-16x9 mb-3">
                                    <iframe src="{{ $googleMapsUrl }}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Link Google Maps disimpan, tapi URL saat ini belum dalam format embed. Klik tombol di bawah untuk membuka peta di tab baru.
                                </div>
                            @endif

                            <p class="small text-muted">
                                <a href="{{ $googleMapsUrl }}" target="_blank" class="btn btn-outline-primary btn-sm">
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

                    <div class="d-flex justify-content-between mb-3">
                        <span>Harga:</span>
                        <strong>
                            @if($event->tiket)
                                Rp {{ number_format($event->tiket->harga,0,',','.') }}
                            @elseif($event->tikets && $event->tikets->count())
                                Rp {{ number_format($event->tikets->first()->harga,0,',','.') }}+
                            @else
                                Gratis
                            @endif
                        </strong>
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

                    @if($event->tiket)
                        @php $tiket = $event->tiket; @endphp
                        <div class="mb-3 border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>{{ $tiket->nama_tiket }}</strong>
                                    <div class="small text-muted">Harga: Rp {{ number_format($tiket->harga,0,',','.') }}</div>
                                </div>
                                <div class="text-end">
                                    <div class="small text-muted">Tersisa: {{ $tiket->jumlah_tiket }}</div>
                                </div>
                            </div>

                            <form action="{{ route('user.tickets.purchase') }}" method="POST">
                                @csrf
                                <input type="hidden" name="tiket_id" value="{{ $tiket->tiket_id }}">

                                <div class="mb-2">
                                    <input type="text" name="nama_peserta" class="form-control form-control-sm" placeholder="Nama peserta" required>
                                </div>

                                <div class="mb-2 d-flex">
                                    <input type="number" name="jumlah" min="1" max="{{ max(1, $tiket->jumlah_tiket) }}" value="1" class="form-control form-control-sm me-2" style="width:90px;">
                                    <button class="btn btn-primary btn-sm"> <i class="bi bi-ticket-perforated"></i> Beli</button>
                                </div>
                            </form>
                        </div>
                    @elseif($event->tikets && $event->tikets->count())
                        @foreach($event->tikets as $tiket)
                            <div class="mb-3 border rounded p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <strong>{{ $tiket->nama_tiket }}</strong>
                                        <div class="small text-muted">Harga: Rp {{ number_format($tiket->harga,0,',','.') }}</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="small text-muted">Tersisa: {{ $tiket->jumlah_tiket }}</div>
                                    </div>
                                </div>

                                <form action="{{ route('user.tickets.purchase') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="tiket_id" value="{{ $tiket->tiket_id }}">

                                    <div class="mb-2">
                                        <input type="text" name="nama_peserta" class="form-control form-control-sm" placeholder="Nama peserta" required>
                                    </div>

                                    <div class="mb-2 d-flex">
                                        <input type="number" name="jumlah" min="1" max="{{ max(1, $tiket->jumlah_tiket) }}" value="1" class="form-control form-control-sm me-2" style="width:90px;">
                                        <button class="btn btn-primary btn-sm"> <i class="bi bi-ticket-perforated"></i> Beli</button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-secondary">Tiket belum tersedia untuk event ini.</div>
                    @endif

                    <button class="btn btn-outline-secondary w-100">
                        <i class="bi bi-share"></i> Bagikan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
