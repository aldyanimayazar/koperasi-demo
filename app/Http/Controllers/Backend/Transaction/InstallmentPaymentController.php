<?php

namespace App\Http\Controllers\Backend\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\InstallmentPaymentDataTable;
use App\Models\MemberShip;
use App\Models\Transaction;
use App\Models\InstallmentPayment;
use App\Models\InstallmentPaymentDetail;

class InstallmentPaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InstallmentPaymentDataTable $dataTable)
    {
        return $dataTable->render('backends.transactions.installment_payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxRequest(Request $request)
    {
        $note = $request->note;
        $transaction_number = $request->transaction_number;
        $result['status'] = False;
        try {
            $transaction = Transaction::where('transaction_number',$transaction_number)->first();
            if ($transaction) {
                $payment = InstallmentPayment::where('transaction_id',$transaction->id)->first();
                if ($payment) {
                    $payment->update(['tenor' => $payment->tenor - 1 ]);
                } else{
                    $payment = InstallmentPayment::create([
                        'tenor' => $transaction->tenor - 1,
                        'transaction_id' => $transaction->id
                    ]);
                }

                InstallmentPaymentDetail::create([
                    'note' => $note,
                    'transaction_number' => $transaction->transaction_number,
                    'installment_payment_id' => $payment->id,
                ]);

                if ($payment->tenor == 0) {
                    $transaction->update(['status' => 'done']);
                    $result['message'] = 'Last Paid Success';
                } else {
                    $result['message'] = 'Paid Success';
                }

                $result['status'] = true;
            }
        } catch (Exception $e) {
            $result['message'] = 'Something Wrong with query';
        }

        return $result;
    }
}
