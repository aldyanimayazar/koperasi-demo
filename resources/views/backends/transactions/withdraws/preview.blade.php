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
            <p>Withdraw simpanan {{ ucwords($transaction->type_saving) }} sebesar IDR {{ number_format($transaction->total, 2, ',', '.') }} telah berhasil</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-headline">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Member ID</th>
                                    <th>Jumlah</th>
                                    <th>Tipe Simpanan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $transaction->transaction_number }}</td>
                                    <td>{{ $transaction->membership->nik }}</td>
                                    <td>{{ number_format($transaction->total, 2, ',', '.') }}</td>
                                    <td>{{ ucwords($transaction->type_saving) }}</td>
                                    <td>{{ $transaction->created_at }}</td>
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
                                    <th colspan="4"><span class="pull-right">Sisa Simpanan {{ ucwords($transaction->type_saving) }}</span></th>
                                    <th>{{ env('APP_CURRENCY', 'USD') }} {{ number_format($saving - $withdraw,2,',','.') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('withdraw.index') }}" class="btn btn-dark waves-effect waves-light">Back</a>
                <a href="{{ route('withdraw.print', $transaction->transaction_number) }}" class="btn btn-success waves-effect waves-light" target="_blank">Print</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
