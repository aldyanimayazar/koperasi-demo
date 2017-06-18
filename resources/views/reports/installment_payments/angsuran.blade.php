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
		<div class="row">
		    <div class="col-md-12">
		        <div class="panel">
		            <div class="panel-body">
		                <form class="form-horizontal" method="POST" action="{{ route('report.angsuran.member') }}">
		                    {{ csrf_field() }}
		                    <div class="form-group{{ $errors->has('membership_id') ? ' has-error' : '' }}">
		                        <label for="membership_id" class="col-sm-3 control-label">NIK Member{!! trans('form.required') !!}</label>
		                        <div class="col-sm-6">
		                            <input type="text" class="form-control" name="nik" required>
		                            <input type="hidden" name="type" value="search">
		                        </div>
		                    </div>
		                    <div class="form-group">
		                        <div class="col-sm-offset-3 col-sm-6">
		                            <button type="submit" class="btn btn-primary">Cari</button>
		                        </div>
		                    </div>
		                </form>
		            </div>
		        </div>
		    </div>

		    {{-- result --}}
		    <div class="col-md-12 result" style="display:none;">
		        <div class="panel">
		            <div class="panel-body">
		                    <div class="content"></div>
		            </div>
		        </div>
		    </div>
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