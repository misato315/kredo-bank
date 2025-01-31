@extends('layouts.app')

@section('title', 'Withdraw')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">

      @if (Auth::user()->accounts->isnotEmpty())
      <div class="card border-0">

        <div class="card-header text-danger text-center border-0">
          <i class="fa-solid fa-money-bill-wave fa-9x"></i>
          <h1>Withdrawal</h1>
        </div>

        <div class="card-body">
          <form action="{{route('users.withdraw')}}" method="POST">
            @csrf
            @method('PATCH')

            <div class="row mb-3">
              <label for="account" class="col-md-4 col-form-label text-md-end">Account</label>
              
              <div class="col-md-6 form-check-inline">
                 <!-- アカウント情報をループしてラジオボタンを表示 -->
                @foreach (Auth::user()->accounts as $account)
                <input type="radio" class="btn-check" name="account" id="account-{{ $account->id }}" autocomplete="off" value="{{ $account->id }}" required>
                <label class="btn btn-outline-danger" for="account-{{ $account->id }}">{{ $account->id }}</label>
                @endforeach
              </div>
                           
            </div>

            <div class="row mb-3">
              <label for="balance" class="col-md-4 col-form-label text-md-end">Withdrawal Amount</label>
              
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text" id="dollar-mark">$</span>
                  <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{old('amount')}}" placeholder="Enter your withdrawal amount here" required>
                  {{-- balanceをamountに変えた --}}
                </div>
                
              @error('amount')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-danger px-5">Withdraw</button>
              </div>            
            </div>
          </form>
        </div>
      </div>
        
      @else
      <div class="card border-0 mt-5 ">
        <div class="card-body text-center text-danger">
          <h1 class="display-6 mt-4 mb-4">
            Please create an account and deposit a balance first.
          </h1>
          <h1 class="display-6">
            <i class="fa-solid fa-triangle-exclamation text-danger fa-5x"></i>
          </h1>
        </div>
      </div>
        
      @endif
      
    </div>
  </div>
</div>
    
@endsection