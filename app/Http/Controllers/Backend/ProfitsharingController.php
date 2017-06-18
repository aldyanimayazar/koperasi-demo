<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProfitsharingDataTable;
use App\Models\MemberShip;
use App\Models\Transaction;

class ProfitsharingController extends Controller
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
    public function index(ProfitsharingDataTable $dataTable)
    {
        return $dataTable->render('profitsharings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['members'] = MemberShip::all();

        return view('profitsharings.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $find_last_transaction = Transaction::where('type','profitsharing')->get()->last();
        if (!$find_last_transaction) {
            $generate_code = 'PS-00001';
        } else {
            $prefix = 'PS-0000';
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
            'type' =>'profitsharing',
            'type_saving' =>'mudarabah',
            'transaction_number' =>$generate_code,
        ]);

        // save
        $transaction = Transaction::create($request->all());

        if ($transaction) {
            $update = Transaction::where('id',$request->transaction_id)->first();
            $update->update(['status' => 'done']);
        }

        $request->session()->flash('context', 'success');
        $request->session()->flash('message', 'Success!');

        return redirect()->route('profitsharing.preview', $transaction->id);
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

    public function preview($id)
    {
        $data['transaction'] = Transaction::find($id);

        return view('profitsharings.preview')->with($data);
    }

    public function print($id)
    {
        $transaction = Transaction::where('transaction_number', $id)->first();

        $pdf = \PDF::loadView('profitsharings.print', compact('transaction'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
