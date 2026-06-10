@extends('usermain')

@section('title', 'Bayar Transaksi')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Bayar Transaksi #{{ $transaksi->transaksi_id }}</h3>
            <p class="text-muted">Total tagihan: Rp {{ number_format($transaksi->total_tagihan,0,',','.') }}</p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.tickets.pay', $transaksi->transaksi_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-control" required>
                                <option value="">Pilih metode</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="Kartu Kredit">Kartu Kredit</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah Pembayaran (Rp)</label>
                            <input type="number" name="total_pembayaran" class="form-control" value="{{ $transaksi->total_tagihan }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Unggah bukti pembayaran (opsional)</label>
                            <input type="file" name="bukti_pembayaran" class="form-control">
                        </div>

                        <button class="btn btn-success">Proses Pembayaran</button>
                        <a href="{{ route('user.tickets.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Detail tiket</h5>
                    @foreach($transaksi->details as $detail)
                        <div class="mb-3">
                            <strong>{{ $detail->tiket->nama_tiket }}</strong>
                            <div class="small text-muted">Event: {{ $detail->tiket->event->nama_event ?? '-' }}</div>
                            <div class="small">Jumlah: {{ $detail->jumlah }}</div>
                            <div class="small">Nama peserta: {{ $detail->nama_peserta }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
