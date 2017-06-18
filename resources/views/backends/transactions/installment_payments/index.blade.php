@extends('layouts.app')

@section('page_title')
{{ trans('form.installment-payment.page-title') }}
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endsection

@section('page_header')
<h3 class="page-title">{{ trans('form.installment-payment.page-title') }}</h3>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                {!! $dataTable->table() !!}
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
                <h4 class="modal-title">Payment Confirmation</h4>
            </div>
            <form class="form-horizontal" name="paid">
                {{ csrf_field() }}
                <input type="hidden" name="transaction_number">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status" class="col-sm-5 control-label">Tenor</label>
                        <label for="status" class="col-sm-5 control-label tenor" style="text-align:left !important"></label>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-5 control-label">Installment Payment</label>
                        <label for="status" class="col-sm-5 control-label installment" style="text-align:left !important"></label>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-sm-5 control-label">Note</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="note" id="note"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-dark waves-effect waves-light" data-dismiss="modal">Cancel</a>
                    <button class="btn btn-success waves-effect waves-light" data-dismiss="modal" onclick="paid_action()">Paid</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{!! $dataTable->scripts() !!}
<script type="text/javascript">
    $(document).on('click','.payment',function(){
        $('#my-modal').modal();
        var tenor = $(this).parent().parent().find('td:eq(4)').html();
        var installment = $(this).parent().parent().find('td:eq(3)').html();
        var number = $(this).parent().parent().find('td:eq(0)').html();
        $('.tenor').html(tenor);
        $('.installment').html(installment);
        $('input[name="transaction_number"]').val(number);
    });

    function paid_action() {
        var url = '{{ route('installment-payment.ajax') }}';
        var _form = $('form[name=paid]').serialize();
        $.post(url,_form,function(result){
            $(".dataTable").DataTable().ajax.reload();
            $('form[name=paid]')[0].reset();
            if (result.status) {
                showNotifications('success',result.message);
            } else {
                showNotifications('error',result.message);
            }
        });
    }
</script>
@endpush