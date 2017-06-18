@extends('layouts.app')

@section('page_title')
    Data Produk
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<style type="text/css">
    .glyphicon { margin-right:5px; }
    .thumbnail
    {
        margin-bottom: 20px;
        padding: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
    }

    .item.list-group-item
    {
        float: none;
        width: 100%;
        background-color: #fff;
        margin-bottom: 10px;
    }
    .item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
    {
        background: #428bca;
    }

    .item.list-group-item .list-group-image
    {
        margin-right: 10px;
    }
    .item.list-group-item .thumbnail
    {
        margin-bottom: 0px;
    }
    .item.list-group-item .caption
    {
        padding: 9px 9px 0px 9px;
    }
    .item.list-group-item:nth-of-type(odd)
    {
        background: #eeeeee;
    }

    .item.list-group-item:before, .item.list-group-item:after
    {
        display: table;
        content: " ";
    }

    .item.list-group-item img
    {
        float: left;
    }
    .item.list-group-item:after
    {
        clear: both;
    }
    .list-group-item-text
    {
        margin: 0 0 11px;
    }
</style>
@endsection

@section('page_header')
<h3 class="page-title">Data Produk</h3>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
        
        <div class="btn-group" style="float:right;width:400px; margin-right: -200px;">
            <div class="form-group{{ $errors->has('interest_by') ? ' has-error' : '' }}">
                <div class="col-sm-6">
                    <select class="form-control" name="interest_by" id="interest-by" required>
                        <option></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('interest_by'))
                        <span class="help-block">
                            <strong>{{ $errors->first('interest_by') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="products" class="row list-group">
        @foreach ($products as $product)
            <div class="item  col-xs-4 col-lg-4">
                <input type="hidden" name="nik" value="{{ $nik }}">
                <div class="thumbnail">
                    <img class="group list-group-image" src="{{ asset($product->images) }}" alt="" style="max-width:300px; max-height: 300px;" height="400" width="400" />
                    <div class="caption">
                        <h4 class="group inner list-group-item-heading">
                            {{ $product->name }}</h4>
                        <p class="group inner list-group-item-text">
                            Stock : {{ $product->stock }}</p>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <p class="lead">
                                    {{ $product->price }}
                                </p>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <a class="btn btn-success" href="{{ route('sales.buy.product', ['id_product' => $product->id, 'nik' => $nik]) }}">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $('select').select2({
        theme: "bootstrap",
        placeholder: "Select",
        allowClear: true
    });

    $(document).ready(function() {
        $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
        $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
    });
</script>
@endpush
