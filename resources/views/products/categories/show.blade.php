@extends('layouts.app')

@section('page_header')
<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('content')
<section class="content-header">
    <h1>
        Detail Kategori
    </h1>
</section>
<section class="content" id="index-component">
    <div class="box box-primary">
        <div class="box-body">
            <div class="panel-body col-sm-4 col-md-offset-4">
                <div class="form-group">
                    <ul class="list-unstyled list-justify">
						<li>Nama <span>{{ $product->name }}</span></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection