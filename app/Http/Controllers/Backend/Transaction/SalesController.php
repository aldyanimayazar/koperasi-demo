<?php

namespace App\Http\Controllers\Backend\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MemberShip;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Transaction;
use App\Mail\LoanVerification;
use App\Http\Requests\LoanRequest;
use App\Http\Requests\LoanVerificationRequest;
use Mail;

class SalesController extends Controller
{
    public function index()
    {
    	return view('backends.transactions.sales.create');
    }

    public function store(Request $request)
    {
    	$member = MemberShip::where('nik', $request->nik)->first();

    	if (!$member) {

            flash('NIK tidak ditemukan, Silahkan masukan NIK yang benar!')->warning();
        
            return redirect()->route('sales.index');
        }

        return redirect()->route('sales.product', array('nik' => $member->nik));
    }

    public function show()
    {

    }

    public function listProduct($nik)
    {
    	$products = Product::all();
    	$categories = ProductCategory::all();
    	return view('backends.transactions.sales.list_product', compact('products', 'categories'), ['nik' => $nik]);
    }

    public function addToChart($id_product, $nik)
    {
        $product = Product::find($id_product);
        $member = MemberShip::where('nik', $nik)->first();
        return view('backends.transactions.sales.buy_product', compact('product', 'member'));
    }

    public function transaction(LoanRequest $request)
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
        $order = Order::create(['transaction_id' => $transaction->id, 'product_id' => $request->product_id]);

        // Send mail verification
        Mail::to('budimanokky93@gmail.com')->send(new LoanVerification($transaction));

        $request->session()->flash('context', 'success');
        $request->session()->flash('message', 'Success!');

        return redirect()->route('loan.preview', $transaction->transaction_number);
    }
}
