@extends('adminmainbaru')

@section('title','Dashboard')

@section('content')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/themes/adaptive.js"></script>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Jumlah Event per Kategori</h5>
                </div>
                <div class="card-body">
                    <div id="categoryChart" style="min-height: 400px;"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Jumlah Event per Organizer / Admin</h5>
                </div>
                <div class="card-body">
                    <div id="organizerChart" style="min-height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

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
                                        <th>Organizer</th>
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
                                            <td>{{ $registration->nama_organizer }}</td>
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
                        <p class="mb-0">Belum ada data user terdaftar atau pembelian tiket.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        Highcharts.chart('categoryChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Event Berdasarkan Kategori'
            },
            xAxis: {
                categories: [
                    @foreach($categoryStats as $category)
                        '{{ $category->nama_kategori }}',
                    @endforeach
                ],
                crosshair: true,
                title: {
                    text: 'Kategori'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Event'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Event',
                data: [@foreach($categoryStats as $category) {{ $category->events_count }}, @endforeach]
            }]
        });

        Highcharts.chart('organizerChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Event Berdasarkan Organizer / Admin'
            },
            xAxis: {
                categories: [
                    @foreach($organizerStats as $organizer)
                        '{{ $organizer->nama_organizer }}',
                    @endforeach
                ],
                crosshair: true,
                title: {
                    text: 'Organizer / Admin'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Event'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Event',
                data: [@foreach($organizerStats as $organizer) {{ $organizer->events_count }}, @endforeach]
            }]
        });
    </script>
@endsection

