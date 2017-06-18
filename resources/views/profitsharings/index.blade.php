@extends('layouts.app')

@section('page_title')
{{ trans('form.profitsharing.page-title') }}
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endsection

@section('page_header')
<h3 class="page-title">{{ trans('form.profitsharing.page-title') }}</h3>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                </div>
            </div>
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
                <h4 class="modal-title">Bagi Hasil Mudarabah</h4>
            </div>
            <form class="form-horizontal" action="{{ route('profitsharing.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="transaction_id" id="transaction-id">
                <input type="hidden" name="total" id="total">
                <input type="hidden" name="membership_id" id="membership_id">
                <div class="modal-body">
                    <table class="table table-striped table-profit">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>No. Telp</th>
                                <th>Jumlah Bagi Hasil #</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-dark waves-effect waves-light" data-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Action</button>
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
<!-- Modal -->
<script type="text/javascript">
    $(document).on('click','.action', function (event) {
        $('#my-modal').modal();
        var id = $(this).parent().parent().find('td:eq(0)').html();
        var nik = $(this).parent().parent().find('td:eq(1)').html();
        var name = $(this).parent().parent().find('td:eq(2)').html();
        var telp = $(this).parent().parent().find('td:eq(3)').html();
        var jumlah = $(this).parent().parent().find('td:eq(4)').html();
        var html = '<tr>'+
        '<td>'+id+'</td>'+
        '<td>'+nik+'</td>'+
        '<td>'+name+'</td>'+
        '<td>'+telp+'</td>'+
        '<td>'+jumlah+'</td>'+
        '<tr>';
        $('.table-profit tbody').html(html);
        $('input[name=transaction_id]').val($(this).attr('data-id'));
        $('input[name=membership_id]').val($(this).attr('data-option'));
        $('input[name=total]').val(jumlah);
    });
</script>
@endpush