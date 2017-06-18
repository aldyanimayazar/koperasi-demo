@extends('layouts.app')

@section('page_title')
Preview Transaksi
@endsection

@section('css')

@endsection

@section('page_header')
<h3 class="page-title">No. Transaksi #{{ $transaction->transaction_number }}</h3>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info" role="alert">
            <p>Catat dan simpan Nomor Transaksi. Periksa kembali detail Simpanan dibawah ini sebelum print.</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">{{ env('APP_NAME', 'Aplikasi Koperasi Karyawan') }}</h3>
                <p class="panel-subtitle pull-right">Transaction: {{ date('d F Y H:i:s', strtotime($transaction->created_at)) }}</p>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <p>
                            Koperasi:<br>
                            <strong>{{ env('APP_NAME', 'Aplikasi Koperasi Karyawan') }}</strong><br>
                            Address: <br>
                            Phone: <br>
                            Email:
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            To:<br>
                            <strong>{{ $transaction->membership->name }}</strong><br>
                            NIK: {{ $transaction->membership->nik }}<br>
                            Phone: {{ $transaction->membership->phone }}<br>
                            Email: {{ $transaction->membership->email }}<br>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            Transaction No. <strong>{{ $transaction->transaction_number }}</strong><br>
                            Member : <strong>{{ $transaction->membership->id_member }}</strong>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Jumlah Simpanan</th>
                                    <th>Type Simpanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($transaction->total, 2, ',', '.') }}</td>
                                    <td>{{ ucwords($transaction->type_saving) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4"><span class="pull-right">Jumlah Simpan</span></th>
                                    <th>{{ env('APP_CURRENCY', 'USD') }} {{ number_format($transaction->total, 2, ',', '.') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ url()->previous() }}" class="btn btn-dark waves-effect waves-light">Kembali</a>
                <a href="{{ route('saving.print', $transaction->transaction_number) }}" class="btn btn-success waves-effect waves-light" target="_blank">Print</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
