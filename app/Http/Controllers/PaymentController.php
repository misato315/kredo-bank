<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Loan;
use App\Models\Account;


class PaymentController extends Controller
{
    private $loan;
    private $account;

    public function __construct(Loan $loan, Account $account)
    {
        $this->loan = $loan;
        $this->account = $account;
    }

    public function index()
    {
        $user_accounts = $this->account->where('user_id', Auth::user()->id)->get();
        $active_loan = 0;
        foreach($user_accounts as $account){
            if($account->loan){
                $active_loan = true;
            }
        }
        return view('payments.index')->with('active_loan', $active_loan);
    }

    public function payLoan()
    {
        $user_accounts = $this->account->where('user_id', Auth::user()->id)->get();
        $active_loan = 0;
        foreach($user_accounts as $account){
            if($account->loan){
                $active_loan = true;
            }
        }
        return view('payments.pay-loan')->with('active_loan', $active_loan);
    }

    public function processSelection(Request $request)
    {
        $request->validate([
            'account_id' => 'required|numeric|exists:accounts,id'
        ]);
        
        $account_id = $request->input('account_id');
        $account_details = $this->account->findOrFail($request->account_id);
        return view('payments.terms-amount', compact('account_id', 'account_details'));
    }
    public function termsAmount(Request $request)
    {
        $request->validate([
            'account_id' => 'required|numeric|exists:accounts,id',
            'months' => 'required|numeric|min:1'
        ]);
        $account_details = $this->account->findOrFail($request->account_id);
        $account_id = $request->input('account_id');
        $months = $request->months;
        return view('payments.confirm-payment', compact('account_id', 'months', 'account_details')); 
    }

    public function update(Request $request, $account_id)
    {
        $account = $this->account->findOrFail($request->account_id);
       // Calculate the new loan amount and term

        $amount_paid = $request->input('months') * $account->loan->monthly_payment;
        $account->loan->total_amount -= $amount_paid;
        $account->loan->loan_term -= $request->input('months');
       
        // Save the updated loan details
        $account->loan->save();
        
        // Check if loan_amount or loan_term is 0 or null and delete the loan if tru
        if ($account->loan->total_amount <= 0 || $account->loan->loan_term <= 0) {
            $account->loan->delete();
        }
        // Calculate the change to be returned if the payment exceeds the required amount
        $total_payment = $request->input('payment');
        $change = $total_payment - $amount_paid;

        return view('payments.receipt')->with('change', $change);
    }

}
