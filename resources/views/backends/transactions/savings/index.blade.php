@extends('layouts.app')

@section('page_title')
{{ trans('form.saving.page-title-add') }}
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
@endsection

@section('page_header')
<h3 class="page-title">{{ trans('form.saving.page-title-add') }}</h3>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('saving.store') }}" method="POST">
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
                    <div class="form-group{{ $errors->has('type_saving') ? ' has-error' : '' }}">
                        <label for="type_saving" class="col-sm-3 control-label">Type {!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="type_saving" id="type_saving" required>
                                <option></option>
                                <option value="pokok" {{ (old('type_saving') == 'pokok') ? 'selected' : '' }}>Pokok</option>
                                <option value="wajib" {{ (old('type_saving') == 'wajib') ? 'selected' : '' }}>Wajib</option>
                                <option value="sukarela" {{ (old('type_saving') == 'sukarela') ? 'selected' : '' }}>Sukarela</option>
                                <!-- <option value="mudarabah" {{ (old('type_saving') == 'mudarabah') ? 'selected' : '' }}>Mudarabah</option>
                                <option value="qurban" {{ (old('type_saving') == 'qurban') ? 'selected' : '' }}>Qurban</option>
                                <option value="umrah" {{ (old('type_saving') == 'umrah') ? 'selected' : '' }}>Umrah</option>
                                <option value="haji" {{ (old('type_saving') == 'haji') ? 'selected' : '' }}>Haji</option>
                                <option value="ijah" {{ (old('type_saving') == 'ijah') ? 'selected' : '' }}>Ijah</option> -->
                            </select>
                            @if ($errors->has('type_saving'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type_saving') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                        <label for="loan-amount" class="col-sm-3 control-label">Jumlah Simpan{!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="total" id="loan-amount" min="0" maxlength="10" value="{{ old('total') }}" placeholder="Jumlah Simpan" required>
                            @if ($errors->has('total'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('total') }}</strong>
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

