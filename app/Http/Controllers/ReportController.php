<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\InstallmentPayment;
use App\Models\InstallmentPaymentDetail;
use App\Models\MemberShip;
use Redirect;

class ReportController extends Controller
{
    public function pinjaman()
    {
    	return view('reports.pinjaman');
    }

    public function simpanan()
    {
    	return view('reports.simpanan');
    }

    public function withdraw()
    {
    	return view('reports.withdraw');
    }

    public function angsuran()
    {
        return view('reports.installment_payments.angsuran');
    }

    public function print($type)
    {
    	switch ($type) {
		    case "simpanan":
    			$transactions = Transaction::with('membership')->where('type', 'saving')->get();
    			$description = "Laporan Simpanan Koperasi";
		        break;
		    case "pinjaman":
		    	$transactions = Transaction::with('membership')->where('type', 'loan')->get();
    			$description = "LAPORAN PINJAMAN ANGGOTA KOPERASI KARYAWAN 'KARYA MANDIRI'";
		        break;
		    case "withdraw":
		        $transactions = Transaction::where('type', 'withdraw')->get();
    			$description = "DAFTAR SALDO WITHDRAW ANGGOTA KOPERASI KARYAWAN 'KARYA MANDIRI'";
		        break;
		    case "angsuran":
		       
		        break;
		    default:
		        echo "Your favorite color is neither red, blue, nor green!";
		}

    	$pdf = \PDF::loadView('reports.print', compact('transactions'), ['type' => $type, 'description' => $description])->setPaper('a3', 'potrait');

        return $pdf->stream();
    }

    public function printByDate(Request $request)
    {
    	$start = date("Y-m-d",strtotime($request->input('start_date')));
        $end = date("Y-m-d",strtotime($request->input('end_date')));

        switch ($request->type) {
		    case "simpanan":
    			$transactions = Transaction::with('membership')->where('type', 'saving')->whereBetween('created_at', [$start, $end])->get();
    			$description = "Laporan Simpanan Koperasi";
		        break;
		    case "pinjaman":
		    	$transactions = Transaction::with('membership')->where('type', 'loan')->whereBetween('created_at', [$start, $end])->get();
    			$description = "LAPORAN PINJAMAN ANGGOTA KOPERASI KARYAWAN 'KARYA MANDIRI'";
		        break;
		    case "withdraw":
		        $transactions = Transaction::with('membership')->where('type', 'withdraw')->whereBetween('created_at', [$start, $end])->get();
    			$description = "LAPORAN SALDO WITHDRAW ANGGOTA KOPERASI KARYAWAN 'KARYA MANDIRI'";
		        break;
		    case "angsuran":
		        echo "Your favorite color is green!";
		        break;
		    default:
		        echo "Your favorite color is neither red, blue, nor green!";
		}
    	


		$pdf = \PDF::loadView('reports.print', compact('transactions'), ['type' => $request->type, 'description' => $description])->setPaper('a3', 'potrait');

		return $pdf->stream();    	
    }

    public function searchTransactionByMember(Request $request)
    {
        $member = MemberShip::where('nik', $request->nik)->first();

        if (!$member) {

            flash('NIK tidak ditemukan, Silahkan masukan NIK yang benar!')->warning();
        
            return redirect()->route('report.angsuran');
        }

        $transactions = Transaction::where('membership_id', $member->id)->get();

        if ($transactions->isEmpty()) {

            flash('Transaksi atas NIK <b>'.$request->nik.'</b> tidak ditemukan!')->warning();
        
            return redirect()->route('report.angsuran');
        }

        $installment_payments = [];

        foreach ($transactions as $value) {
           $installment_payments = InstallmentPayment::with('transaction')->with('instalmentDetail')->where('transaction_id', $value->id)->get();
        }
        
        return view('reports.installment_payments.list_angsuran', compact('installment_payments', 'member'));
    }

    public function printInstallment($id, $n)
    {
        $instalment_detail = InstallmentPaymentDetail::find($id);
        $installment_payment = InstallmentPayment::with('transaction')->find($instalment_detail->installment_payment_id);
        $member = MemberShip::find($installment_payment->transaction->membership_id);

        $pdf = \PDF::loadView('reports.installment_payments.print', compact('instalment_detail', 'installment_payment', 'member'), ['installment_payment_no' => $n])->setPaper('a4', 'potrait');

        return $pdf->stream(); 
    }
}
