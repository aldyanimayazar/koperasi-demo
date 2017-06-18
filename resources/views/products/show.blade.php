@extends('layouts.app')

@section('page_header')
<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('content')
<section class="content-header">
    <h1>
        Detail Product
    </h1>
</section>
<section class="content" id="index-component">
    <div class="box box-primary">
        <div class="box-body">
            <div class="panel-body col-sm-4 col-md-offset-4">

                    <div class="form-group">
	                    <div class="profile-main">
							<img src="{{ asset( $product->images ) }}" height="300" width="300" class="img-circle" alt="Avatar">
						</div>
                        <ul class="list-unstyled list-justify">
							<li>Nama <span>{{ $product->name }}</span></li>
							<li>Stok <span>{{ $product->stock }}</span></li>
							<li>Kategori <span>{{ $product->product_category->name }}</span></li>
							<li>Harga <span>{{ $product->price }}</span></li>
							</li>
						</ul>
                    </div>

                   
                    
            </div>
        </div>
    </div>
</section>
@endsection