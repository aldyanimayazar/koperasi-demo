@extends('layouts.app')

@section('page_header')
<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
				<h3 class="panel-title">Edit Kategori</h3>
				<br>
                <a href="{{ route('product.index') }}" type="button" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('category.update', [$product->id]) }}">
                <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
					<div class="panel-body col-md-offset-1">
                        <input type="hidden" class="form-control" id="id" value="{{ $product->id }}">
                    	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                        <label for="name" class="col-sm-3 control-label">Name{!! trans('form.required') !!}</label>
	                        <div class="col-sm-6">
	                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}" placeholder="Name" required>
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
<style type="text/css">
    .upload-image input,
    .upload-image img,
    .upload-image button {
        display: block;
        width: 300px;
    }

    .checkbox-inline {
        padding-left: 0;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    $(function () {
        $(":file").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function imageIsLoaded(e) {
        $('#upload-thumbnail').attr('src', e.target.result);
    };
</script>

<script type="text/javascript">
    $( document ).ready(function() {
        var product_category_id = $('#product_category_id').val();
        var get_category = "{{ url('master/product/get-category') }}";

        $.get(get_category, function(response) {
            $( response ).each(function( index, value ) {
              if (product_category_id == value.id) {
                $(".product_category select").val(value.id);
              }
            });
        });           
        
    })
</script>
@endpush