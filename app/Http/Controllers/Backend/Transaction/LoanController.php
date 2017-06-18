<?php

namespace App\Http\Controllers\Backend\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Http\Requests\LoanVerificationRequest;
use App\DataTables\LoanDataTable;
use App\Models\MemberShip;
use App\Models\Transaction;
use App\Mail\LoanVerification;
use Mail;

class LoanController extends Controller
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
    public function index(LoanDataTable $dataTable)
    {
        return $dataTable->render('backends.transactions.loans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['members'] = MemberShip::all();

        return view('backends.transactions.loans.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request)
    {
        $find_last_transaction = Transaction::where('type', 'loan')->orderby('created_at', 'desc')->first();
        if (!$find_last_transaction) {
            $generate_code = 'P-00001';
        } else {
            $prefix = 'P-0000';
            $explode = explode("-", $find_last_transaction->transaction_number);
            $increments_number = (int)$explode[1] + 1;
            $generate_code = $prefix.$increments_number;
        }

        // Total
        switch ($request->tenor) {
            case 6:
                $fix_interest = $request->interest / 2;
                break;
            default:
                $fix_interest = $request->interest * ($request->tenor / 12);
        }

        $total = (($request->amount / 100) * $fix_interest) + $request->amount;

        $request->merge([
            'transaction_number' => $generate_code,
            'total' => $total,
            'installment_payment' => $total / $request->tenor,
        ]);

        // Save
        $transaction = Transaction::create($request->all());

        // Send mail verification
        Mail::to('iddandunk@gmail.com')->send(new LoanVerification($transaction));

        $request->session()->flash('context', 'success');
        $request->session()->flash('message', 'Success!');

        return redirect()->route('loan.preview', $transaction->transaction_number);
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

    public function preview($transaction_number)
    {
        $data['transaction'] = Transaction::where('transaction_number', $transaction_number)->first();

        return view('backends.transactions.loans.preview')->with($data);
    }

    public function print($transaction_number)
    {
        $transaction = Transaction::where('transaction_number', $transaction_number)->first();

        $pdf = \PDF::loadView('backends.transactions.loans.print', compact('transaction'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function verification(LoanVerificationRequest $request)
    {
        $transaction = Transaction::find($request->transaction_id)->update($request->all());

        return redirect()->route('loan.index');
    }
}
