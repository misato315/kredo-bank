@extends('layouts.app')

@section('content')
<div class="container justify-content-center">

    <h1>Good day, {{ Auth::user()->name }}!</h1>
    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header bg-info">
                    <p class="fw-bold">Announcements</p>
                </div>
                <div class="card-body">
                    <p class="">Welcome to Kredo Bank!</p>
                </div>
        </div>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col">
      <a class="btn btn-success d-block" href="{{route('users.depositSlip')}}">
        <h3>Deposit</h3>
        <i class="fa-solid fa-circle-dollar-to-slot fa-4x"></i>
      </a>
    </div>
    <div class="col">
        <a class="btn btn-danger text-white d-block" href="{{route('users.withdrawal')}}">
          <h3>Withdrawal</h3>
          <i class="fa-solid fa-money-bill-wave fa-4x"></i>
        </a>
    </div>
    <div class="col">
        <a class="btn btn-warning d-block" href="{{route('loan.index')}}">
          <h3>Loans</h3>
          <i class="fa-solid fa-hand-holding-dollar fa-4x"></i>
        </a>
    </div>
    <div class="col">
      <a class="btn btn-success text-white d-block" href="{{route('payment.index')}}">
        <h3>Payment</h3>
        <i class="fa-solid fa-money-bill-transfer fa-4x"></i>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <a class="btn btn-secondary text-white d-block" href="{{route('account.index')}}">
        <h3>Accounts</h3>
        <i class="fa-solid fa-money-check-dollar fa-4x"></i>
      </a>
    </div>
  </div>

</div>
@endsection
