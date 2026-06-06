@extends('adminmain')

@section('title', 'Pengisi Acara')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="fas fa-users"></i> Daftar Pengisi Acara
            </h1>
            <p class="text-muted">Kelola data pengisi acara/pembicara untuk event Anda</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('pengisi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pengisi Acara
            </a>
        </div>
    </div>

    <!-- Alert Section -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> Terjadi kesalahan!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-light border-bottom">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="fas fa-table"></i> Data Pengisi Acara
                        <span class="badge bg-primary">{{ $result->total() }}</span>
                    </h5>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            @if ($result->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="40%">Nama Pengisi Acara</th>
                                <th width="20%">Jumlah Event</th>
                                <th width="15%">Terdaftar</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $key => $item)
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ($result->currentPage() - 1) * $result->perPage() + $key + 1 }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-primary-light me-2">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $item->nama_pengisi_acara }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $item->event_pengisi_acara_count }} Event
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $item->created_at->format('d M Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('pengisi.edit', $item->pengisi_acara_id) }}" 
                                               class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $item->pengisi_acara_id }}"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $item->pengisi_acara_id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-trash-alt"></i> Hapus Pengisi Acara
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white" 
                                                                data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="mb-0">
                                                            Apakah Anda yakin ingin menghapus <strong>{{ $item->nama_pengisi_acara }}</strong>?
                                                        </p>
                                                        <p class="text-danger small mt-2">
                                                            <i class="fas fa-exclamation-triangle"></i> 
                                                            Tindakan ini tidak dapat dibatalkan.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" 
                                                                data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('pengisi.destroy', $item->pengisi_acara_id) }}" 
                                                              method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer bg-light border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Menampilkan {{ $result->firstItem() }} hingga {{ $result->lastItem() }} 
                                dari {{ $result->total() }} data
                            </small>
                        </div>
                        <div>
                            {{ $result->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">Belum ada data pengisi acara</p>
                    <a href="{{ route('pengisi.create') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus"></i> Tambah Pengisi Acara Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Additional CSS for styling -->
<style>
    .avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        width: 2.5rem;
        height: 2.5rem;
    }

    .bg-primary-light {
        background-color: rgba(0, 123, 255, 0.1) !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .card {
        border: none;
        border-radius: 0.5rem;
    }

    h1 {
        color: #2c3e50;
        font-weight: 600;
    }

    .btn-group-sm .btn {
        padding: 0.35rem 0.5rem;
        font-size: 0.85rem;
    }
</style>
@endsection
