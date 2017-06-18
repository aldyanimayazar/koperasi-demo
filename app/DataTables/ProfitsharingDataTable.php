<?php

namespace App\DataTables;

use App\Models\Transaction;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class ProfitsharingDataTable extends DataTable
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
                    return '<button type="button" class="btn btn-primary btn-sm action" data-id="'.$transaction->id.'" data-option="'.$transaction->membership_id.'"><i class="fa fa-briefcase"></i></button>';
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
        $query = Transaction::where('transactions.type', 'saving')
            ->where('type_saving','mudarabah')
            ->where('status','open')
            ->leftJoin('memberships', 'transactions.membership_id', '=', 'memberships.id')
            ->select([
                'transactions.id',
                'transactions.membership_id',
                'memberships.name',
                'memberships.nik',
                'memberships.id_member',
                'memberships.phone',
                'transactions.total',
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
                    ->addAction(['width' => '80px'])
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
            'id_member' => ['name' => 'memberships.id_member','title' => 'Id'],
            'nik' => ['name' => 'memberships.nik','title' => 'Nik'],
            'name' => ['name' => 'memberships.name', 'title' => 'Nama'],
            'phone' => ['name' => 'memberships.phone', 'title' => 'No Telp'],
            'total' => ['name' => 'transactions.total', 'title' => 'Simpanan Mudarabah'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'profitsharings_' . time();
    }
}
