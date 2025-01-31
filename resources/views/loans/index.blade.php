@extends('layouts.app')

@section('title', 'Loans')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if(Auth::user()->accounts->isnotEmpty())
        <div class="card border-0 ">

          <div class="card-header border-0  text-center">
            <i class="fa-solid fa-hand-holding-dollar fa-9x text-warning mb-2"></i>
            <h1 class="text-warning">Loans</h1>
          </div>

          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-7">
                <table class="table table-bordered table-hover my-4">
                  <thead>
                    <th>Account Number</th>
                    <th class="text-end">Account Balance</th>
                    <th class="text-end">Loaned Amount</th>
                    <th class="text-center">Status</th>
                  </thead>
                  <tbody>
                    @foreach (Auth::user()->accounts as $account)
                    <tr>
                      <td>{{$account->id}}</td>
                      <td class="text-end">$ {{number_format($account->balance, 2)}}</td>
                      <td class="text-end text-success fw-bold">
                        @if($account->loan)
                            ${{ number_format($account->loan->loan_amount, 2) }}
                        @else
                            $ 0
                        @endif
                      </td>
                      @if ($account->loan)
                        <td class="text-center text-danger text-uppercase fw-bold">Active Loan</td> 
                      @elseif ($account->balance <= 10000)
                        <td class="text-center text-secondary text-uppercase fw-bold">Not Eligible</td>
                      @else
                        <td class="text-center text-primary text-uppercase fw-bold">Eligible</td>
                      @endif
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                @if ($active_loan )
                  <h1 class="lead text-center text-danger mt-3">You currently have an active loan. <br> Please settle your loans first.</h1>
                  <h1 class="text-center">
                    <i class="fa-solid fa-triangle-exclamation text-center text-danger fa-xl"></i>
                  </h1>
                @else
                  <a href="{{route('loan.apply')}}" class="btn btn-warning w-100 fw-bold">Apply Loan</a>
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