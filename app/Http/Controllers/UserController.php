<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Account;

class UserController extends Controller
{
    private $user;
    private $accounts;

    public function __construct(User $user, Account $accounts){
        $this->user = $user;
        $this->accounts = $accounts;
    }

    public function withdrawal()
    {
        return view('users.withdrawal');
    }

    public function withdraw(Request $request)
    {
        $account_details = $this->accounts->findOrFail($request->account);

        $request->validate([
            'account'   => 'required',
            'amount'    => 'required|numeric|min:1|max:'. $account_details->balance
        ],[
            'amount.max' => 'Your current account balance is: $ ' . $account_details->balance
        ]);

        $account_details->balance -= $request->amount;
        $account_details->save();

        return redirect()->route('account.index');
    }

    public function depositSlip()
    {
        return view('users.deposit');
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'account'   => 'required',
            'amount'    => 'required|numeric|min:1'
        ]);

        $account = $this->accounts->findOrFail($request->account);
        $account->balance += $request->amount;
        $account->save();
        
        return redirect()->route('account.index');
    }
}
