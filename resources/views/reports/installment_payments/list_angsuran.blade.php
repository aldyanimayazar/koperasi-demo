@extends('layouts.app')

@section('page_header')

<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('css')
	<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection

@section('content')
	<section class="content">
		<section class="content-header">
		    <h1><small>Preview Data Withdraw</small></h1>
		    <ol class="breadcrumb">
		        <li>
		        	<a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a>
		        </li>
		        <li class="active">View Data Angsuran</li>
		    </ol>
		</section>
		<section class="invoice">
			<div class="row">
				<div class="col-xs-12 table-responsive">
					<table class="table table-striped">
					<thead>
						<tr>
							<th>No. Angsuran</th>
							<th>No. Pinjam</th>
							<th>ID Member</th>
							<th>Angsuran Ke #</th>
							<th>Jumlah #</th>
							<th>Tanggal Transaksi</th>
							<th>More</th>
						</tr>
					</thead>
					<tbody>
						<?php $n = 1;  ?>	
						@foreach ($installment_payments as $installment_payment)
							@foreach ($installment_payment->instalmentDetail as $detail)
								<tr>
									<td>A-0000{{ $detail->id }}</td>
									<td>{{ $detail->transaction_number }}</td>
									<td>{{ $member->id_member }}</td>
									<td>{{ $n }}</td>
									<td>IDR {{ $installment_payment->transaction->installment_payment }}</td>
									<td>{{ $detail->created_at }}</td>
									<td align="center"><a href="{{ route('report.print.installment', ['id' => $detail->id, 'n' => $n]) }}" target="_blank" title="print"><i class="fa fa-print"></i></a></td>
								</tr>
							<?php $n++;  ?>	
							@endforeach
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
	</section>
@endsection

@push('scripts')
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<script>
    $(document).ready(function(){
      var start_date=$('input[name="start_date"]'); //our date input has the name "date"
      var end_date=$('input[name="end_date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      start_date.datepicker(options);
      end_date.datepicker(options);
    })
</script>
@endpush