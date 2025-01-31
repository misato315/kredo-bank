<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Loan;
use App\Models\Account;

class LoanController extends Controller
{
    private $loan;
    private $account;
    private $interest = ['3' => '0.02', '6' => '0.05', '12' => '0.07'];

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
        return view('loans.index')->with('active_loan', $active_loan);
    }

    public function applyLoan()
    {
        $user_accounts = $this->account->where('user_id', Auth::user()->id)->get();
        $active_loan = 0;
        foreach($user_accounts as $account){
            if($account->loan){
                $active_loan = true;
            }
        }
        return view('loans.apply-loan')->with('active_loan', $active_loan);
    }

    public function create(Request $request)
    {
        $request->validate([
            'account_id'   => 'numeric|min:1'
        ],
        [
            'account_id.numeric' => 'Please select an eligible account.',
            'account_id.min' => 'Please select an eligible account.'
        ]
    );
        $account_details = $this->account->findOrFail($request->account_id);
        $loan_amount = $this->loanAmount($account_details->balance);

        $loan_details = [
            'account_id'            => $account_details->id,
            'loan_term'             => $request->loan_term,
            'balance'               => $account_details->balance,
            'loan_amount'           => $loan_amount,
            'interest'              => $this->interest[$request->loan_term],
            'loan_amount_interest'  => ($loan_amount * $this->interest[$request->loan_term]) + $loan_amount,
            'monthly_payment'       => $this->monthlyPayment($loan_amount, $request->loan_term)
        ];

        return view('loans.create')->with('loan_details', $loan_details);
    }

    private function loanAmount($balance)
    {
        if($balance <= 10000){
            return 0;
        } elseif($balance > 10000 && $balance <= 30000){
            return $balance * 0.10;
        } elseif($balance > 30000 && $balance <= 50000){
            return $balance * 0.20;
        } elseif($balance > 50000 && $balance <= 100000){
            return $balance * 0.25;
        } elseif($balance > 100000){
            return $balance * 0.50;
        }
    }

    private function monthlyPayment($loan_amount, $loan_term)
    {
        return ($loan_amount + ($loan_amount * $this->interest[$loan_term])) / $loan_term;
    }

    public function store(Request $request)
    {
        $this->loan->account_id = $request->account_id;
        $this->loan->loan_amount = $request->loan_amount;
        $this->loan->loan_term = $request->loan_term;
        $this->loan->interest = $request->interest;
        $this->loan->monthly_payment = $request->monthly_payment;
        $this->loan->total_amount = $request->loan_amount_interest;
        $this->loan->save();
        $this->updateAccountBalance($request->account_id, $request->loan_amount);

        return redirect()->route('account.index');
    }

    private function updateAccountBalance($account_id, $loan_amount)
    {
        $account = $this->account->findOrFail($account_id);
        $account->balance += $loan_amount;
        $account->save();
    }
    
}
