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
		        <li class="active">View Data Withdraw</li>
		    </ol>
		</section>
		<div class="bootstrap-iso">
		 	<div class="container-fluid">
		  		<div class="row">
		   			<div class="col-md-6 col-sm-6 col-xs-12">
		   				<BR>
		   				<div class="form-group">

		   					<span class="description" style="float: left;"><a href="{{ route('report.print', 'withdraw') }}" target="_blank" class="btn btn-warning pull-right"><i class="fa fa-print"></i> Print All</a></span>
		   				</div>
		  			</div>
		   			<div class="col-md-6 col-sm-6 col-xs-12">
			    		<!-- Form code begins -->
			    		<form method="post" action="{{ route('post.print') }}">
			    			{{ csrf_field() }}
			    			<input type="hidden" name="type" value="withdraw">
			     	 		<div class="form-group"> <!-- Date input -->
			        			<label class="control-label" for="date">Start Date :</label>
			        			<input class="form-control" id="date" name="start_date" placeholder="MM/DD/YYY" type="text" required/>
			      			</div>
			      			<div class="form-group"> <!-- Date input -->
			        			<label class="control-label" for="date">End Date :</label>
			        			<input class="form-control" id="date" name="end_date" placeholder="MM/DD/YYY" type="text" required/>
			      			</div>
			      			<div class="form-group"> <!-- Submit button -->
			        			<button class="btn btn-warning" name="submit" type="submit"><i class="fa fa-print"></i> Print</button>
			      			</div>
			     		</form>
				    	<!-- Form code ends --> 
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