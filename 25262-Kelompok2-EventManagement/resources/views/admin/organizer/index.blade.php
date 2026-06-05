@extends('adminmain')

@section('title', 'Organizer')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Data Organizer</h3>
        <a href="{{ route('organizer.create') }}" class="btn btn-primary">Tambah Organizer</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User ID</th>
                    <th>Nama Organizer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($result as $organizer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $organizer->user_id }}</td>
                        <td>{{ $organizer->nama_organizer }}</td>
                        <td>
                            <a href="{{ route('organizer.edit', $organizer->organizer_id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('organizer.destroy', $organizer->organizer_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada organizer.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
