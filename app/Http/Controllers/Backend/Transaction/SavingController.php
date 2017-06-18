<?php

namespace App\Http\Controllers\Backend\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SavingRequest;
use App\Models\MemberShip;
use App\Models\Transaction;

class SavingController extends Controller
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
    public function index()
    {
        $data['members'] = MemberShip::all();

        return view('backends.transactions.savings.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // leave empty
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavingRequest $request)
    {
        $find_last_transaction = Transaction::where('type','saving')->get()->last();
        if (!$find_last_transaction) {
            $generate_code = 'S-00001';
        } else {
            $prefix = 'S-0000';
            $explode = explode("-", $find_last_transaction->transaction_number);
            $increments_number = (int)$explode[1] + 1;
            $generate_code = $prefix.$increments_number;
        }

        $request->merge([
            'amount' =>0,
            'interest' =>0,
            'tenor' =>0,
            'admin_fee' =>0,
            'status' =>'done',
            'note' =>'',
            'type' =>'saving',
            'transaction_number' =>$generate_code,
        ]);

        if ($request->type_saving == 'mudarabah') {
            $request->merge([
                'status' =>'open'
            ]);
        }

        // save
        $transaction = Transaction::create($request->all());

        $request->session()->flash('context', 'success');
        $request->session()->flash('message', 'Success!');

        return redirect()->route('saving.preview', $transaction->transaction_number);
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

        return view('backends.transactions.savings.preview')->with($data);
    }

    public function print($transaction_number)
    {
        $transaction = Transaction::where('transaction_number', $transaction_number)->first();

        $pdf = \PDF::loadView('backends.transactions.savings.print', compact('transaction'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
