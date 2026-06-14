@extends('usermainbaru')

@section('title','Organizer')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <h4>Organizer</h4>
            <p class="text-muted">Pilih organizer untuk melihat daftar event yang tersedia.</p>
        </div>
    </div>

    <div class="row">
        @forelse($organizers as $organizer)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('user.organizer.show', $organizer) }}" class="text-decoration-none text-dark">
                                {{ $organizer->nama_organizer }}
                            </a>
                        </h5>

                        <p class="text-muted small mb-3">
                            <i class="bi bi-calendar-check"></i>
                            {{ $organizer->events_count }} event tersedia
                        </p>

                        <a href="{{ route('user.organizer.show', $organizer) }}" class="btn btn-sm btn-primary">
                            Lihat Event
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada organizer tersedia.</div>
            </div>
        @endforelse
    </div>
@endsection

