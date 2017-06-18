<?php

namespace App\DataTables;

use App\Models\Transaction;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class InstallmentPaymentDataTable extends DataTable
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
            ->addColumn('action', '<button type="button" class="btn btn-primary btn-sm payment" title="Payment"><i class="fa fa-money"></i></button>')
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Transaction::where('type', 'loan')->where('status','open')
            ->join('memberships', 'transactions.membership_id', '=', 'memberships.id')
            ->leftJoin('installment_payments', 'installment_payments.transaction_id', '=', 'transactions.id')
            ->select([
                'memberships.id_member as nik',
                'memberships.name',
                'installment_payment',
                'transaction_number',
                \DB::raw('(CASE WHEN installment_payments.tenor IS NULL THEN transactions.tenor ELSE installment_payments.tenor END) AS tenor'),
                'status',
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
                    ->addAction(['width' => '200px'])
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
        'transaction_number'   => ['data' => 'transaction_number', 'name' => 'transactions.transaction_number'],
        'nik'   => ['data' => 'nik', 'name' => 'memberships.id_member'],
        'name'   => ['data' => 'name', 'name' => 'memberships.name'],
        'installment_payment'   => ['data' => 'installment_payment', 'name' => 'installment_payment'],
        'transaction_number'   => ['data' => 'transaction_number', 'name' => 'transaction_number'],
        'tenor'   => ['data' => 'tenor', 'name' => 'tenor'],
        'status'   => ['data' => 'status', 'name' => 'status']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'installmentpaymentdatatables_' . time();
    }
}
