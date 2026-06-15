@extends('usermainbaru')

@section('title', 'Riwayat Tiket')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Riwayat Pemesanan Tiket</h3>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($transaksis->count())
                @foreach($transaksis as $transaksi)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Transaksi #{{ $transaksi->transaksi_id }}</strong>
                                    <div class="small text-muted">{{ $transaksi->created_at->format('d M Y H:i') }}</div>
                                </div>
                                <div class="text-end">
                                    <div>Total: Rp {{ number_format($transaksi->total_tagihan,0,',','.') }}</div>
                                    <div class="small">Status: {{ $transaksi->status_pembayaran }}</div>
                                </div>
                            </div>

                            <hr>

                            @foreach($transaksi->details as $detail)
                                <div class="mb-2">
                                    <div><strong>{{ $detail->tiket->nama_tiket ?? 'Tiket' }}</strong></div>
                                    <div class="small text-muted">Event: {{ $detail->tiket->event->nama_event ?? '-' }}</div>
                                    <div class="small">Jumlah: {{ $detail->jumlah }} | Nama peserta: {{ $detail->nama_peserta }}</div>
                                </div>
                            @endforeach

                            @if($transaksi->status_pembayaran === 'paid')
                                <div class="alert alert-success small mb-3">
                                    Tiket ini sudah dibayar dan resmi menjadi milik Anda.
                                </div>
                            @endif

                            @php
                                $canCancel = true;
                                foreach($transaksi->details as $detail) {
                                    $start = \Carbon\Carbon::parse($detail->tiket->event->tanggal_mulai);
                                    if ($start->isPast()) { $canCancel = false; break; }
                                }
                            @endphp

                            <div class="d-flex gap-2 flex-wrap">
                                @if($transaksi->status_pembayaran === 'pending')
                                    <a href="{{ route('user.tickets.pay.form', $transaksi->transaksi_id) }}" class="btn btn-primary btn-sm">Bayar</a>
                                @endif

                                @if($canCancel)
                                    <form action="{{ route('user.tickets.cancel', $transaksi->transaksi_id) }}" method="POST" onsubmit="return confirm('Batalkan transaksi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Batalkan</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-secondary">Belum ada transaksi tiket.</div>
            @endif
        </div>
    </div>
@endsection

