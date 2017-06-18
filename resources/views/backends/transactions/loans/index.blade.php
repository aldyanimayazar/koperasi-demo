@extends('layouts.app')

@section('page_title')
{{ trans('form.loan.page-title') }}
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endsection

@section('page_header')
<h3 class="page-title">{{ trans('form.loan.page-title') }}</h3>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <a href="{{ route('loan.create') }}" type="button" class="btn btn-default"><i class="fa fa-plus-square"></i> Tambah</a>
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
                <h4 class="modal-title">Verifikasi Pinjaman</h4>
            </div>
            <form class="form-horizontal" action="{{ route('loan.verification') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="transaction_id" id="transaction-id">
                <input type="hidden" name="verification_by" id="verification_by" value="{{ Auth::id() }}">
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <label for="status" class="col-sm-3 control-label">Status{!! trans('form.required') !!}</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status" id="status" required>
                                <option value="pending" selected disabled>Pending</option>
                                <option value="open" {{ (old('status') == 'open') ? 'selected' : '' }}>Accept</option>
                                <option value="reject" {{ (old('status') == 'reject') ? 'selected' : '' }}>Reject</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('note_status') ? ' has-error' : '' }}">
                        <label for="note_status" class="col-sm-3 control-label">Note</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="note_status" id="note_status" placeholder="Note (Required for Reject)">{{ old('note_status') }}</textarea>
                            @if ($errors->has('note_status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('note_status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <p>{!! trans('form.required') !!}View detail member for the confirm decision</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-dark waves-effect waves-light" data-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Confirm</button>
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
    $('#my-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var transaction = button.data('transaction');
        var transaction_number = button.data('transaction_number');
        var modal = $(this);
        modal.find('.modal-title').text('Verifikasi Pinjaman #' + transaction_number);
        modal.find('#transaction-id').val(transaction);
    });
</script>
@endpush