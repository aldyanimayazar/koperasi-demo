@extends('layouts.app')

@section('page_title')
{{ trans('form.withdraw.page-title-add') }}
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
@endsection

@section('page_header')
<h3 class="page-title">{{ trans('form.withdraw.page-title-add') }}</h3>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                <form class="form-horizontal" name="searchwithdraw">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('membership_id') ? ' has-error' : '' }}">
                        <label for="membership_id" class="col-sm-3 control-label">NIK / ID Member{!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nik" required>
                            <input type="hidden" name="type" value="search">
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- result --}}
    <div class="col-md-12 result" style="display:none;">
        <div class="panel">
            <div class="panel-body">
                <div class="content"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal content-->
<div id="my-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Withdraw</h4>
            </div>
            <form class="form-horizontal" name="withdraw">
                {{ csrf_field() }}
                <input type="hidden" name="nik_member">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type_saving" class="col-sm-3 control-label">Type {!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="type_saving" id="type_saving" required>
                                <option></option>
                                <option value="pokok">Pokok</option>
                                <option value="wajib">Wajib</option>
                                <option value="sukarela">Sukarela</option>
                                <!-- <option value="mudarabah">Mudarabah</option>
                                <option value="qurban">Qurban</option>
                                <option value="umrah">Umrah</option>
                                <option value="haji">Haji</option>
                                <option value="ijah">Ijah</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="loan-amount" class="col-sm-3 control-label">Jumlah Withdraw{!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="total" id="total" min="0" maxlength="10" placeholder="Jumlah Withdraw" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-dark waves-effect waves-light" data-dismiss="modal">Cancel</a>
                    <button class="btn btn-success waves-effect waves-light" data-dismiss="modal" onclick="withdraw_action()">Withdraw</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    var _url = '{{ route("withdraw.ajax") }}';

    $('form[name=searchwithdraw]').on('submit',function(e){
        e.preventDefault();
        var _form = $('form[name=searchwithdraw]').serialize();
        var member = $('input[name=nik]').val();
        $.post(_url, _form, function(response) {
            $('.result').show('slideDown');
            if (response.status) {
                var html = '<table class="table table-responsive">'+
                    '<thead>'+
                        '<tr>'+
                            '<td>NIK</td>'+
                            '<td>Nama</td>'+
                            '<td>Simpanan Pokok</td>'+
                            '<td>Simpanan Wajib</td>'+
                            '<td>Simpanan Sukarela</td>'+
                            // '<td>Mudarabah</td>'+
                            // '<td>Qurban</td>'+
                            // '<td>Umrah</td>'+
                            // '<td>Haji</td>'+
                            // '<td>Ijah</td>'+
                            '<td>Action</td>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody>'+
                        '<tr>'+
                            '<td>'+response.data.nik+'</td>'+
                            '<td>'+response.data.name+'</td>'+
                            '<td>{{ env("APP_CURRENCY", "USD") }} '+response.data.pokok+'</td>'+
                            '<td>{{ env("APP_CURRENCY", "USD") }} '+response.data.wajib+'</td>'+
                            '<td>{{ env("APP_CURRENCY", "USD") }} '+response.data.sukarela+'</td>'+
                            // '<td>'+response.data.mudarabah+'</td>'+
                            // '<td>'+response.data.qurban+'</td>'+
                            // '<td>'+response.data.umrah+'</td>'+
                            // '<td>'+response.data.haji+'</td>'+
                            // '<td>'+response.data.ijah+'</td>'+
                            '<td>'+
                                '<button class="btn btn-info withdraw"><i class="fa fa-credit-card"></i> Withdraw</button>'
                            '</td>'+
                        '</tr>'+
                    '</tbody>'+
                '</table>';

                $('.content').html(html);
            } else {
                $('.content').html('Tidak ditemukan member dengan NIK / Member ID, '+member);
            }
        });
    });

    $(document).on('click','.withdraw',function(){
        $('#my-modal').modal();
        $('input[name=nik_member]').val($('input[name=nik]').val());
    });

    function withdraw_action() {
        var url = '{{ route("withdraw.store") }}';
        var _form = $('form[name=withdraw]').serialize();
        $.post(url, _form, function(result){
            $('form[name=withdraw]')[0].reset();
            if (result.status) {
                showNotifications('success', result.message);
                window.location.href = '{{ url("transaction/withdraw/preview") }}/'+result.transaction_number;
            } else {
                showNotifications('error', result.message);
            }
        });
    }

    $('select').select2({
        theme: "bootstrap",
        placeholder: "Select",
        allowClear: true
    });
</script>
@endpush

