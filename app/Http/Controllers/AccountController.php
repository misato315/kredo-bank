<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Account;


class AccountController extends Controller
{
    private $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function index()
    {
        return view('accounts.index');
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'balance'   => 'required|numeric|min:0',
        ]);

        $this->account->user_id = Auth::user()->id;
        $this->account->balance = $request->balance;
        $this->account->save();

        return redirect()->route('account.index');
    }

    public function withdrawal()
    {
        return view('users.withdrawal');
    }
}