@extends('layouts.app')

@section('title', 'Payment')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if (Auth::user()->accounts->isnotEmpty())
      <div class="card border-0">

        <div class="card-header border-0 text-center text-warning">
          <i class="fa-solid fa-money-bill-transfer fa-9x mb-4"></i>
          <h1>Payment</h1>
        </div>

        <div class="card-body">
          <div class="row justify-content-center">
              <div class="col-7">
                  <table class="table table-hover table-bordered my-4">
                      <thead>
                          <th>Account Number</th>
                          <th class="text-end">Account Balance</th>
                          <th class="text-end">Loaned Amount</th>
                          <th class="text-center">Status</th>
                      </thead>
                      <tbody>
                          @foreach(Auth::user()->accounts as $account)
                              <tr>
                                  <td>{{ $account->id }}</td>
                                  <td class="text-end">${{ number_format($account->balance, 2) }}</td>
                                  <td class="text-end text-success fw-bold">
                          
                                      @if($account->loan&& $account->loan->first())
                                          ${{ number_format($account->loan->total_amount, 2) }}
                                      @else
                                          $ 0
                                      @endif
                                  </td>
                                  @if($account->loan)
                                      <td class="text-center text-danger text-uppercase fw-bold">Active Loan</td>  
                                  @elseif($account->balance <= 10000)
                                      <td class="text-center text-secondary text-uppercase fw-bold">Not Eligible</td>
                                  @else
                                      <td class="text-center text-primary text-uppercase fw-bold">Eligible</td>  
                                  @endif
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                  @if($active_loan == true)
                      <a href="{{ route('payment.pay-loan') }}" class="btn btn-warning w-100 fw-bold">Pay Loan</a>
                  @else
                      <h1 class="lead text-center text-warning mt-3">You currently have no active loan.</h1>
                      <h1 class="text-center">
                          <i class="fa-solid fa-thumbs-up text-center text-warning fa-xl"></i>
                      </h1>
                  @endif
              </div>
          </div>
      </div>

      </div>
      @else
      <div class="card border-0 mt-5">
        <div class="card-body">
            <h1 class="display-6 text-center text-danger mt-5 mb-3">
                Please create an account and deposit a balance first.
            </h1>
            <h1 class="display-6 text-center">
                <i class="fa-solid fa-triangle-exclamation text-danger fa-5x"></i>
            </h1>
        </div>
    </div>
        
      @endif
    </div>
  </div>
</div>   
@endsection