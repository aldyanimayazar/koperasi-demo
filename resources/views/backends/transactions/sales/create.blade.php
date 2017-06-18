@extends('layouts.app')

@section('page_title')
{{ trans('form.loan.page-title-add') }}
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
@endsection

@section('page_header')
<h3 class="page-title">{{ trans('form.loan.page-title-add') }}</h3>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                    <a href="{{ route('loan.index') }}" type="button" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Kembali</a>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('sales.store') }}">
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
                            <button type="submit" class="btn btn-primary">Lanjut</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
</script>
@endpush
