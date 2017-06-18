@extends('layouts.app')

@section('page_header')
<!-- <h3 class="page-title">Dashboard</h3> -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Form Registrasi Keanggotaan</h3>
                <br>
                <a href="{{ route('member.index') }}" type="button" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('member.store') }}">
                {{ csrf_field() }}
                    <div class="panel-body col-md-offset-1">
                        <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                            <label for="nik" class="col-sm-3 control-label">NIK{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nik" id="nik" value="{{ old('nik') }}" placeholder="Nik" required>
                                @if ($errors->has('nik'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
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
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-3 control-label">Email{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-sm-3 control-label">Phone{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" max="" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" placeholder="phone" required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                            <label for="date_of_birth" class="col-sm-3 control-label">Date of Birth{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" required>
                                @if ($errors->has('date_of_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-sm-3 control-label">Gender{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="gender" id="gender" required>
                                    <option></option>
                                    <option value="laki-laki" {{ (old('gender') == 'laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ (old('gender') == 'perempuan') ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('blood_type') ? ' has-error' : '' }}">
                            <label for="blood_type" class="col-sm-3 control-label">Blood Type{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="blood_type" id="blood_type" required>
                                    <option></option>
                                    <option value="A" {{ (old('blood_type') == 'A') ? 'selected' : '' }}>A</option>
                                    <option value="AB" {{ (old('blood_type') == 'AB') ? 'selected' : '' }}>AB</option>
                                    <option value="B" {{ (old('B') == 'B') ? 'selected' : '' }}>B</option>
                                     <option value="O" {{ (old('blood_type') == 'O') ? 'selected' : '' }}>O</option>
                                </select>
                                @if ($errors->has('blood_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('blood_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('religion') ? ' has-error' : '' }}">
                            <label for="religion" class="col-sm-3 control-label">Religion{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="religion" id="religion" required>
                                    <option></option>
                                    <option value="islam" {{ (old('religion') == 'islam') ? 'selected' : '' }}>Islam</option>
                                    <option value="protestan" {{ (old('religion') == 'protestan') ? 'selected' : '' }}>Protestan</option>
                                    <option value="katolik" {{ (old('B') == 'katolik') ? 'selected' : '' }}>Katolik</option>
                                    <option value="hindu" {{ (old('religion') == 'hindu') ? 'selected' : '' }}>Hindu</option>
                                    <option value="budha" {{ (old('religion') == 'budha') ? 'selected' : '' }}>Budha</option>
                                    <option value="kepercayaan" {{ (old('religion') == 'kepercayaan') ? 'selected' : '' }}>Kepercayaan</option>
                                </select>
                                @if ($errors->has('religion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('religion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                            <label for="group_id" class="col-sm-3 control-label">Group{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="group_id" id="group_id" required>
                                    <option></option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}" {{ (old('group_id') == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('group_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('member_role_id') ? ' has-error' : '' }}">
                            <label for="member_role_id" class="col-sm-3 control-label">Member{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="member_role_id" id="member_role_id" required>
                                    <option></option>
                                    @foreach ($member_roles as $member)
                                        <option value="{{ $group->id }}" {{ (old('member_role_id') == $member->id) ? 'selected' : '' }}>{{ $member->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('member_role_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('member_role_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-sm-3 control-label">Address{!! trans('form.required') !!}</label>
                            <div class="col-sm-6">
                                <textarea name="address" class="form-control" id="address" placeholder="Address" required>{{ old('address') }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('savings') ? ' has-error' : '' }}">
                            <label for="savings" class="col-sm-3 control-label">Savings</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" max="" class="form-control" name="savings" id="savings" value="{{ old('savings') }}" placeholder="Savings">
                                @if ($errors->has('savings'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('savings') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                            <label for="salary" class="col-sm-3 control-label">Salary</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" max="" class="form-control" name="salary" id="salary" value="{{ old('salary') }}" placeholder="Salary">
                                @if ($errors->has('salary'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('max_plafond_debiting') ? ' has-error' : '' }}">
                            <label for="max_plafond_debiting" class="col-sm-3 control-label">Max. Plafond Debiting</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" max="" class="form-control" name="max_plafond_debiting" id="max_plafond_debiting" value="{{ old('max_plafond_debiting') }}" placeholder="Max. Plafond Debiting">
                                @if ($errors->has('max_plafond_debiting'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('max_plafond_debiting') }}</strong>
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