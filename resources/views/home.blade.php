@extends('layouts.app')

@section('page_title')
Home
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('front/assets/vendor/chartist/css/chartist-custom.css') }}">
@endsection

@section('page_header')
<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('content')
<!-- OVERVIEW -->
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Laporan Mingguan</h3>
        <p class="panel-subtitle">Period: March 31, 2017 - April 04, 2017</p>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                    <p>
                        <span class="number">65.000.000</span>
                        <span class="title">Total Hutang</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-book"></i></span>
                    <p>
                        <span class="number">35.000.000</span>
                        <span class="title">Total Piutang</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-credit-card"></i></span>
                    <p>
                        <span class="number">20.746.780</span>
                        <span class="title">Total Kredit</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-bar-chart"></i></span>
                    <p>
                        <span class="number">500</span>
                        <span class="title">Total Anggota</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div id="headline-chart" class="ct-chart"></div>
            </div>
            <div class="col-md-3">
                <div class="weekly-summary text-right">
                    <span class="number">115</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
                    <span class="info-label">Total Peminjam</span>
                </div>
                <div class="weekly-summary text-right">
                    <span class="number">18.000.000</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
                    <span class="info-label">Pendapatan Bulanan</span>
                </div>
                <div class="weekly-summary text-right">
                    <span class="number">58.000.000</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
                    <span class="info-label">Total Pendapatan</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OVERVIEW -->
<div class="row">
    <div class="col-md-12">
        <!-- RECENT PURCHASES -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Pengajuan Pinjaman</h3>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body no-padding">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nomor Keanggotaan</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Date &amp; Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#">763648</a></td>
                            <td>Steve</td>
                            <td>$122</td>
                            <td>April 21, 2017</td>
                            <td><span class="label label-success">Diterima</span></td>
                        </tr>
                        <tr>
                            <td><a href="#">763649</a></td>
                            <td>Amber</td>
                            <td>$62</td>
                            <td>April 21, 2017</td>
                            <td><span class="label label-warning">PENDING</span></td>
                        </tr>
                        <tr>
                            <td><a href="#">763650</a></td>
                            <td>Michael</td>
                            <td>$34</td>
                            <td>April 18, 2017</td>
                            <td><span class="label label-danger">Ditolak</span></td>
                        </tr>
                        <tr>
                            <td><a href="#">763651</a></td>
                            <td>Roger</td>
                            <td>$186</td>
                            <td>April 17, 2017</td>
                            <td><span class="label label-success">Diterima</span></td>
                        </tr>
                        <tr>
                            <td><a href="#">763652</a></td>
                            <td>Smith</td>
                            <td>$362</td>
                            <td>April 16, 2017</td>
                            <td><span class="label label-success">Diterima</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> 1 Bulan Terakhir</span></div>
                    <div class="col-md-6 text-right"><a href="#" class="btn btn-primary">Lihat daftar keseluruhan</a></div>
                </div>
            </div>
        </div>
        <!-- END RECENT PURCHASES -->
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('front/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('front/assets/vendor/chartist/js/chartist.min.js') }}"></script>
<script>
    $(function() {
        var data, options;

        // headline charts
        data = {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            series: [
                [23, 29, 24, 40, 25, 24, 35],
                [14, 25, 18, 34, 29, 38, 44],
            ]
        };

        options = {
            height: 300,
            showArea: true,
            showLine: false,
            showPoint: false,
            fullWidth: true,
            axisX: {
                showGrid: false
            },
            lineSmooth: false,
        };

        new Chartist.Line('#headline-chart', data, options);

        // visits trend charts
        data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [{
                name: 'series-real',
                data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
            }, {
                name: 'series-projection',
                data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
            }]
        };

        options = {
            fullWidth: true,
            lineSmooth: false,
            height: "270px",
            low: 0,
            high: 'auto',
            series: {
                'series-projection': {
                    showArea: true,
                    showPoint: false,
                    showLine: false
                },
            },
            axisX: {
                showGrid: false,

            },
            axisY: {
                showGrid: false,
                onlyInteger: true,
                offset: 0,
            },
            chartPadding: {
                left: 20,
                right: 20
            }
        };

        new Chartist.Line('#visits-trends-chart', data, options);

        // visits chart
        data = {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            series: [
                [6384, 6342, 5437, 2764, 3958, 5068, 7654]
            ]
        };

        options = {
            height: 300,
            axisX: {
                showGrid: false
            },
        };

        new Chartist.Bar('#visits-chart', data, options);

        // real-time pie chart
        var sysLoad = $('#system-load').easyPieChart({
            size: 130,
            barColor: function(percent) {
                return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
            },
            trackColor: 'rgba(245, 245, 245, 0.8)',
            scaleColor: false,
            lineWidth: 5,
            lineCap: "square",
            animate: 800
        });

        var updateInterval = 3000; // in milliseconds

        setInterval(function() {
            var randomVal;
            randomVal = getRandomInt(0, 100);

            sysLoad.data('easyPieChart').update(randomVal);
            sysLoad.find('.percent').text(randomVal);
        }, updateInterval);

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // showNotifications('info', 'Testing info');
        // showNotifications('warning', 'Testing warning');
        // showNotifications('success', 'Testing success');
        // showNotifications('error', 'Testing error');
    });
</script>
@endpush
