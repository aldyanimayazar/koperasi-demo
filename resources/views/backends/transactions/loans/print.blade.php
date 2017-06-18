<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>No. Transaksi #{{ $transaction->transaction_number }}</title>
    <style type="text/css">
        @font-face {
          font-family: SourceSansPro;
          src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
          content: "";
          display: table;
          clear: both;
        }

        a {
          color: #0087C3;
          text-decoration: none;
        }

        body {
          position: relative;
          /*width: 21cm;  */
          /*height: 29.7cm; */
          margin: 0 auto;
          color: #555555;
          background: #FFFFFF;
          font-family: Arial, sans-serif;
          font-size: 14px;
          font-family: SourceSansPro;
        }

        header {
          padding: 10px 0;
          margin-bottom: 20px;
          border-bottom: 1px solid #AAAAAA;
        }

        #logo {
          float: left;
          margin-top: 8px;
        }

        #logo img {
          height: 70px;
        }

        #company {
          /*float: right;*/
          text-align: right;
        }


        #details {
          margin-bottom: 50px;
        }

        #client {
          padding-left: 6px;
          border-left: 6px solid #0087C3;
          float: left;
        }

        #client .to {
          color: #777777;
        }

        h2.name {
          font-size: 1.4em;
          font-weight: normal;
          margin: 0;
        }

        #invoice {
          /*float: right;*/
          text-align: right;
        }

        #invoice h1 {
          color: #0087C3;
          font-size: 2.0em;
          line-height: 1em;
          font-weight: normal;
          margin: 0  0 10px 0;
        }

        #invoice .date {
          font-size: 1.1em;
          color: #777777;
        }

        table {
          width: 100%;
          border-collapse: collapse;
          border-spacing: 0;
          margin-bottom: 20px;
        }

        table th,
        table td {
          padding: 20px;
          background: #EEEEEE;
          text-align: center;
          border-bottom: 1px solid #FFFFFF;
        }

        table th {
          white-space: nowrap;
          font-weight: normal;
        }

        table td {
          text-align: right;
        }

        table td h3{
          color: #57B223;
          font-size: 1.2em;
          font-weight: normal;
          margin: 0 0 0.2em 0;
        }

        table .no {
          color: #FFFFFF;
          font-size: 1.6em;
          background: #57B223;
        }

        table .desc {
          text-align: left;
        }

        table .unit {
          background: #DDDDDD;
        }

        table .qty {
        }

        table .total {
          background: #57B223;
          color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
          font-size: 1.2em;
        }

        table tbody tr:last-child td {
          border: none;
        }

        table tfoot td {
          padding: 10px 20px;
          background: #FFFFFF;
          border-bottom: none;
          font-size: 1.2em;
          white-space: nowrap;
          border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
          border-top: none;
        }

        table tfoot tr:last-child td {
          color: #57B223;
          /*font-size: 1.5em;*/
          border-top: 1px solid #57B223;

        }

        table tfoot tr td:first-child {
          border: none;
        }

        #thanks{
          font-size: 2em;
          margin-bottom: 50px;
        }

        #notices{
          padding-left: 6px;
          border-left: 6px solid #0087C3;
        }

        #notices .notice {
          font-size: 1.2em;
        }

        footer {
          color: #777777;
          width: 100%;
          height: 30px;
          position: absolute;
          bottom: 0;
          border-top: 1px solid #AAAAAA;
          padding: 8px 0;
          text-align: center;
        }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="front/assets/img/logo-sintesa.png">
      </div>
      <div id="company">
        <h2 class="name">Company Name</h2>
        <div>455 Foggy Heights, AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">UNTUK:</div>
          <h2 class="name">{{ $transaction->membership->name }}</h2>
          <div class="address">{{ $transaction->membership->nik }}</div>
          <div class="address">{{ $transaction->membership->phone }}</div>
          <div class="email"><a href="mailto:{{ $transaction->membership->email }}">{{ $transaction->membership->email }}</a></div>
        </div>
        <div id="invoice">
          <h1>NO. TRANSAKSI {{ $transaction->transaction_number }}</h1>
          <div class="date">Tanggal Transaksi: {{ date('d F Y H:i:s', strtotime($transaction->created_at)) }}</div>
          <!-- <div class="date">Due Date: 30/06/2014</div> -->
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <!-- <th class="no">#</th> -->
            <th class="desc">JUMLAH<br>PINJAMAN</th>
            <th class="unit">TENOR</th>
            <th class="qty">BUNGA<br>PER ({{ $transaction->interest_by }})</th>
            <th class="unit">TOTAL</th>
            <th class="total">ANGSURAN</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <!-- <td class="no">#</td> -->
            <td class="desc">{{ number_format($transaction->amount, 2, ',', '.') }}</td>
            <td class="unit">{{ $transaction->tenor }}</td>
            <td class="qty">{{ number_format($transaction->interest, 0) }}%</td>
            <td class="unit">{{ number_format($transaction->total, 2, ',', '.') }}</td>
            <td class="total">{{ number_format($transaction->installment_payment, 2, ',', '.') }}</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">JUMLAH PINJAM</td>
            <td>{{ env('APP_CURRENCY', 'USD') }} {{ number_format($transaction->amount, 2, ',', '.') }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">ADMINISTRASI</td>
            <td>{{ env('APP_CURRENCY', 'USD') }} {{ number_format($transaction->admin_fee, 2, ',', '.') }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL DITERIMA</td>
            <td>{{ env('APP_CURRENCY', 'USD') }} {{ number_format($transaction->amount - $transaction->admin_fee, 2, ',', '.') }}</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Terimakasih!</div>
      <div id="notices">
        <div>Catatan:</div>
        <div class="notice">{{ $transaction->note }}</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
