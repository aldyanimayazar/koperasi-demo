@extends('layouts.app')

@section('page_title')
Member
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endsection

@section('page_header')
<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('content')
	<h3 class="page-title">Data Member</h3>
	<div class="row">
		<div class="col-md-12" style="background-color: white">
			<div class="box">
				<div class="box-header with-border">
		            <h3 class="box-title">
		                <a href="{{ url('/member/create') }}" type="button" class="btn btn-default btn-xs"><i class="fa fa-plus-square"></i> Tambah </a>
		            </h3>
		        </div>
		        <div class="box-body">
					{!! $dataTable->table() !!}
		        </div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
	{!! $dataTable->scripts() !!}
@endpush