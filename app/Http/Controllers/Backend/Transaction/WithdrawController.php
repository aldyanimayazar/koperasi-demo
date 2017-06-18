<?php

namespace App\Http\Controllers\Backend\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Models\MemberShip;
use App\Models\Transaction;

class WithdrawController extends Controller
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
        return view('backends.transactions.withdraws.index');
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
    public function store(WithdrawRequest $request)
    {
        $result['status'] = False;
        $member = MemberShip::where('nik', $request->nik_member)->orWhere('id_member', $request->nik_member)->first();
        $transaction = Transaction::where('membership_id', $member->id);

        if ($transaction->where('type', 'saving')->where('type_saving', $request->type_saving)->sum('total') == 0) {
            $result['message'] = 'Tidak bisa withdraw untuk,'.$request->type_saving;
        }

        $total_saving = Transaction::where('membership_id', $member->id)->where('type', 'saving')->where('type_saving', $request->type_saving)->sum('total');
        $total_saving_withdraw = Transaction::where('membership_id', $member->id)->where('type', 'withdraw')->where('type_saving', $request->type_saving)->sum('total');

        if (($total_saving - $total_saving_withdraw) <= $request->total) {
            $result['message'] = 'Tidak bisa withdraw untuk amount tidak mencukupi';
        }

        $find_last_transaction = Transaction::where('type', 'withdraw')->get()->last();

        if (!$find_last_transaction) {
            $generate_code = 'W-00001';
        } else {
            $prefix = 'W-0000';
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
            'type' =>'withdraw',
            'transaction_number' =>$generate_code,
            'membership_id' =>$member->id,
        ]);

        // save
        $transaction = Transaction::create($request->all());

        if ($transaction) {
            $result['status'] = true; 
            $result['message'] = 'Withdraw berhasil';
            $result['transaction_number'] = $transaction->transaction_number;
        }

        return $result;
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
        $data['saving'] = Transaction::where('membership_id', $data['transaction']->membership_id)->where('type', 'saving')->where('type_saving', $data['transaction']->type_saving)->sum('total');
        $data['withdraw'] = Transaction::where('membership_id', $data['transaction']->membership_id)->where('type', 'withdraw')->where('type_saving', $data['transaction']->type_saving)->sum('total');

        return view('backends.transactions.withdraws.preview')->with($data);
    }

    public function print($transaction_number)
    {
        $transaction = Transaction::where('transaction_number', $transaction_number)->first();
        $saving = Transaction::where('membership_id', $transaction->membership_id)->where('type', 'saving')->where('type_saving', $transaction->type_saving)->sum('total');
        $withdraw = Transaction::where('membership_id', $transaction->membership_id)->where('type', 'withdraw')->where('type_saving', $transaction->type_saving)->sum('total');

        $pdf = \PDF::loadView('backends.transactions.withdraws.print', compact('transaction', 'saving', 'withdraw'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function ajaxRequest(Request $request)
    {
        $result['status'] = false;
        $type = $request->type;
        switch ($type) {
            case 'search':
                $member = MemberShip::where('nik', $request->nik)->orWhere('id_member', $request->nik)->first();
                if ($member) {
                    $result['status'] = true;
                    $transaction = Transaction::where('membership_id', $member->id);
                    $data['nik'] = $member->nik;
                    $data['name'] = $member->name;
                    $data['pokok'] = ($transaction->count() > 0 ? number_format((Transaction::where('membership_id', $member->id)->where('type', 'saving')->where('type_saving', 'pokok')->sum('total')) - (Transaction::where('membership_id', $member->id)->where('type', 'withdraw')->where('type_saving', 'pokok')->sum('total')),'2',',','.'):0);
                    $data['wajib'] = ($transaction->count() > 0 ? number_format((Transaction::where('membership_id', $member->id)->where('type', 'saving')->where('type_saving', 'wajib')->sum('total')) - (Transaction::where('membership_id', $member->id)->where('type', 'withdraw')->where('type_saving', 'wajib')->sum('total')),'2',',','.'):0);
                    $data['sukarela'] = ($transaction->count() > 0 ? number_format((Transaction::where('membership_id', $member->id)->where('type', 'saving')->where('type_saving', 'sukarela')->sum('total')) - (Transaction::where('membership_id', $member->id)->where('type', 'withdraw')->where('type_saving', 'sukarela')->sum('total')),'2',',','.'):0);
                    // $data['mudarabah'] = ($transaction->count() > 0 ? number_format(Transaction::where('membership_id',$member->id)->where('type','saving')->where('type_saving','mudarabah')->sum('total') - Transaction::where('membership_id',$member->id)->where('type','withdraw')->where('type_saving','mudarabah')->sum('total'),'2',',','.'):0);
                    // $data['qurban'] = ($transaction->count() > 0 ? number_format(Transaction::where('membership_id',$member->id)->where('type','saving')->where('type_saving','qurban')->sum('total') - Transaction::where('membership_id',$member->id)->where('type','withdraw')->where('type_saving','qurban')->sum('total'),'2',',','.'):0);
                    // $data['umrah'] = ($transaction->count() > 0 ? number_format(Transaction::where('membership_id',$member->id)->where('type','saving')->where('type_saving','umrah')->sum('total') - Transaction::where('membership_id',$member->id)->where('type','withdraw')->where('type_saving','umrah')->sum('total'),'2',',','.'):0);
                    // $data['haji'] = ($transaction->count() > 0 ? number_format(Transaction::where('membership_id',$member->id)->where('type','saving')->where('type_saving','haji')->sum('total') - Transaction::where('membership_id',$member->id)->where('type','withdraw')->where('type_saving','haji')->sum('total'),'2',',','.'):0);
                    // $data['ijah'] = ($transaction->count() > 0 ? number_format(Transaction::where('membership_id',$member->id)->where('type','saving')->where('type_saving','ijah')->sum('total') - Transaction::where('type','withdraw')->where('type_saving','ijah')->sum('total'),'2',',','.'):0);

                    $result['data'] = $data;
                } else {
                    $result['status'] = false;
                }

                return $result;
                break;
            
            default:
                $result['message'] = 'default';
                return $result;
                break;
        }
    }
}
