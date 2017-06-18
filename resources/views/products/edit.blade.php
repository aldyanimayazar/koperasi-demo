@extends('layouts.app')

@section('page_header')
<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
				<h3 class="panel-title">Edit Produk</h3>
				<br>
                <a href="{{ route('product.index') }}" type="button" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('product.update', [$product->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
					<div class="panel-body col-md-offset-1">
                        <input type="hidden" class="form-control" id="product_category_id" value="{{ $product->product_category_id }}">
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

                    	<div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
	                        <label for="stock" class="col-sm-3 control-label">Stock{!! trans('form.required') !!}</label>
	                        <div class="col-sm-6">
	                            <input type="number" min="0" max="" class="form-control" name="stock" id="stock" value="{{ $product->stock }}" placeholder="Stock" required>
	                            @if ($errors->has('stock'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('stock') }}</strong>
	                                </span>
	                            @endif
	                        </div>
                    	</div>

                    	<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }} product_category">
	                        <label for="category" class="col-sm-3 control-label">Category{!! trans('form.required') !!}</label>
	                        <div class="col-sm-6">
	                            <select class="form-control" name="product_category_id" id="product_category_id" required>
	                                <option></option>
	                                @foreach ($categories as $category)
	                                	<option value="{{ $category->id }}" {{ (old('category') == $category->name) ? 'selected' : '' }}>{{ $category->name }}</option>
	                                @endforeach
	                            </select>
	                            @if ($errors->has('category'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('category') }}</strong>
	                                </span>
	                            @endif
	                        </div>
                    	</div>

                    	<div class="form-group">
                            <label class="col-sm-3 control-label">Image</label>
                            <div class="col-sm-3 upload-image">
                                <input type="file" id="upload-file" name="images" value="{!! old('images') !!}">
                                @if ($product->images)
                                    <img class="img-thumbnail" id="upload-thumbnail" data-src="holder.js/300x300" src="{{ asset($product->images) }}">
                                @else
                                    <img class="img-thumbnail" id="upload-thumbnail" src="{{ asset('uploads/avatar/placeholder.png') }}">
                                @endif
                                @if ($errors->has('upload'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('upload') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
	                        <label for="price" class="col-sm-3 control-label">Stock{!! trans('form.required') !!}</label>
	                        <div class="col-sm-6">
	                            <input type="number" min="0" max="" class="form-control" name="price" id="price" value="{{ $product->price }}" placeholder="Price" required>
	                            @if ($errors->has('price'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('price') }}</strong>
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