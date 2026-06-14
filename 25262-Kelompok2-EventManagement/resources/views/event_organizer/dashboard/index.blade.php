@extends('organizermain')

@section('title','Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Data User Terdaftar / Pembelian Tiket</h5>
                </div>
                <div class="card-body">
                    @if(count($registrations))
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Event</th>
                                        <th>Pembeli</th>
                                        <th>Tiket</th>
                                        <th>Nama Peserta</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Metode</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrations as $index => $registration)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $registration->nama_event }}</td>
                                            <td>{{ $registration->pembeli }}</td>
                                            <td>{{ $registration->nama_tiket }}</td>
                                            <td>{{ $registration->nama_peserta }}</td>
                                            <td>{{ $registration->jumlah }}</td>
                                            <td>{{ number_format($registration->total_detail_harga, 0, ',', '.') }}</td>
                                            <td>{{ $registration->status_pembayaran }}</td>
                                            <td>{{ $registration->metode_pembayaran }}</td>
                                            <td>{{ date('d-m-Y H:i', strtotime($registration->tanggal_pembelian)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mb-0">Belum ada data user terdaftar atau pembelian tiket untuk event Anda.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection