<!DOCTYPE html>
<html>
    <head>
        <title>No. Transaksi #{{ $transaction->transaction_number }}</title>
        <style type="text/css">
            table {
                color: #333; /* Lighten up font color */
                font-family: Helvetica, Arial, sans-serif; /* Nicer font */
                width: 640px;
                border-collapse:
                collapse; border-spacing: 0;
            }

            td, th { border: 1px solid #CCC; height: 30px; } /* Make cells a bit taller */

            th {
                background: #F3F3F3; /* Light grey background */
                font-weight: bold; /* Make sure they're bold */
            }

            td {
                background: #FAFAFA; /* Lighter grey background */
                text-align: center; /* Center our text */
            }
        </style>
    </head>
    <body>
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
                                    <th>Jumlah Pinjaman</th>
                                    <th>Tenor</th>
                                    <th>Bunga Per Tahun</th>
                                    <th>Total #</th>
                                    <th>Angsuran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($transaction->amount, 2, ',', '.') }}</td>
                                    <td>{{ $transaction->tenor }}</td>
                                    <td>{{ number_format($transaction->interest_by_year, 0) }}%</td>
                                    <td>{{ number_format($transaction->total, 2, ',', '.') }}</td>
                                    <td>{{ number_format($transaction->installment_payment, 2, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <strong>Note:</strong> <br>
                            {{ $transaction->note }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4"><span class="pull-right">Jumlah Pinjam</span></th>
                                    <th>{{ env('APP_CURRENCY', 'USD') }} {{ number_format($transaction->amount, 2, ',', '.') }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4"><span class="pull-right">Administrasi</span></th>
                                    <th>{{ env('APP_CURRENCY', 'USD') }} {{ number_format($transaction->admin_fee, 2, ',', '.') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
