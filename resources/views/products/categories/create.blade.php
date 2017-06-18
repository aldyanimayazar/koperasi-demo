@extends('layouts.app')

@section('page_header')
<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
				<h3 class="panel-title">Tambah Kategori</h3>
				<br>
                <a href="{{ route('product.index') }}" type="button" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
					<div class="panel-body col-md-offset-1">
						
                    	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                        <label for="name" class="col-sm-3 control-label">Name{!! trans('form.required') !!}</label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Name" required>
	                            @if ($errors->has('name'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('name') }}</strong>
	                                </span>
	                            @endif
	                        </div>
                    	</div>

						<div class="form-group">
	                        <div class="col-sm-offset-3 col-sm-6">
	                            <button type="submit" class="btn btn-primary">Save</button>
	                        </div>
                    	</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush