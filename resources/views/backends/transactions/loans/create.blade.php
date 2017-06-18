@extends('layouts.app')

@section('page_title')
    
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
                <form class="form-horizontal" action="{{ route('loan.store') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="loan">
                    <div class="form-group{{ $errors->has('membership_id') ? ' has-error' : '' }}">
                        <label for="membership_id" class="col-sm-3 control-label">Member{!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="membership_id" id="membership_id" required>
                                <option></option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" {{ old('membership_id') ? 'selected' : '' }}>{{ $member->id_member }} - {{ $member->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('membership_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('membership_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label for="amount" class="col-sm-3 control-label">Jumlah Pinjam{!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="amount" id="amount" min="0" maxlength="10" value="{{ old('amount') }}" placeholder="Jumlah Pinjam" required>
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('interest') ? ' has-error' : '' }}">
                        <label for="interest" class="col-sm-3 control-label">Bunga (%){!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="interest" id="interest" min="0" maxlength="3" value="{{ old('interest') }}" placeholder="Bunga(%)" required>
                            @if ($errors->has('interest'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('interest') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('interest_by') ? ' has-error' : '' }}">
                        <label for="interest-by" class="col-sm-3 control-label">Bunga per{!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="interest_by" id="interest-by" required>
                                <option></option>
                                <option value="month" {{ (old('interest_by') == 'month') ? 'selected' : '' }}>Month</option>
                                <option value="year" {{ (old('interest_by') == 'year') ? 'selected' : '' }}>Year</option>
                            </select>
                            @if ($errors->has('interest_by'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('interest_by') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('tenor') ? ' has-error' : '' }}">
                        <label for="tenor" class="col-sm-3 control-label">Tenor{!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="tenor" id="tenor" required>
                                <option></option>
                                <option value="6" {{ (old('tenor') == 6) ? 'selected' : '' }}>6 Month</option>
                                <option value="12" {{ (old('tenor') == 12) ? 'selected' : '' }}>12 Month</option>
                                <option value="18" {{ (old('tenor') == 18) ? 'selected' : '' }}>18 Month</option>
                                <option value="24" {{ (old('tenor') == 24) ? 'selected' : '' }}>24 Month</option>
                                <!-- <option value="36" {{ (old('tenor') == 36) ? 'selected' : '' }}>36 Month</option>
                                <option value="48" {{ (old('tenor') == 48) ? 'selected' : '' }}>48 Month</option> -->
                            </select>
                            @if ($errors->has('tenor'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tenor') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('admin_fee') ? ' has-error' : '' }}">
                        <label for="admin-fee" class="col-sm-3 control-label">Biaya Admin{!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_fee" id="admin-fee" min="0" maxlength="10" value="{{ old('admin_fee') }}" placeholder="Biaya Admin" required>
                            @if ($errors->has('admin_fee'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('admin_fee') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                        <label for="note" class="col-sm-3 control-label">Catatan</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="note" id="note" placeholder="Catatan">{{ old('note') }}</textarea>
                            @if ($errors->has('note'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
