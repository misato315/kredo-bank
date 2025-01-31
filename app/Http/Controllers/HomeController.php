<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    #Account List ページに飛ぶ
    public function account(){
        $all_accounts = $this->account->get();
        return view('accounts.index')->with('all_accounts',$all_accounts);
    }

    #Deposit ページに飛ぶ
    // public function deposit(){
    //     return view('deposit.index');
    // }

    #Withdraw ページに飛ぶ
    // public function withdraw(){
    //     return view('withdraw.index');
    // }

    #Payment ページに飛ぶ
    // public function payment(){
    //     return view('payment.index');
    // }
}
