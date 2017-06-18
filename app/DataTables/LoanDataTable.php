<?php

namespace App\DataTables;

use App\Models\Transaction;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class LoanDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($transaction) {
                $button_detail = '<a href="'.route('loan.preview', $transaction->transaction_number).'" class="btn btn-danger btn-xs" title="Lihat Detail"><i class="fa fa-search"></i></a>';
                if ($transaction->status == 'pending') {
                    $button_verification = '<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#my-modal" data-transaction="'.$transaction->id.'" data-transaction_number="'.$transaction->transaction_number.'" title="Verifikasi"><i class="fa fa-check"></i></button>';

                    return $button_detail.' '.$button_verification;
                }

                return $button_detail;
            })
            ->editColumn('amount', function ($transaction) {
                return env('APP_CURRENCY', 'USD').' '.number_format($transaction->amount, 2, ',', '.');
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Transaction::where('transactions.type', 'loan')
            ->join('memberships', 'transactions.membership_id', '=', 'memberships.id')
            ->select([
                'transactions.id',
                'transactions.transaction_number',
                'memberships.name as name',
                'transactions.amount',
                'transactions.status',
                'transactions.created_at',
            ]);

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '87px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'transaction_number' => ['title' => 'No. Transaksi'],
            'name' => ['name' => 'memberships.name', 'title' => 'Nama'],
            'amount' => ['title' => 'Jumlah Pinjam'],
            'status',
            'created_at' => ['title' => 'Tanggal Transaksi'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'loandatatables_' . time();
    }
}
