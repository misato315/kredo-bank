@extends('layouts.app')

@section('title', 'Accounts')

@section('content')
<div class="container w-25 mt-4">
  <div class="row mb-4">
    <div class="col d-flex flex-column flex-md-row justify-content-between">
      <h1 class="display-6 fw-light">Account List</h1>
      <a href="{{route('account.create')}}"><i class="fa-solid fa-square-plus text-primary fa-3x"></i></a>
    </div>
  </div>
      
</div>

<div class="container w-25 mt-5">
  @forelse (Auth::user()->accounts as $account)
    <div class="row mb-3">
      <div class="col">
        <div class="card border-0 text-decoration-none bg-light shadow">
          <div class="card-body">
            <h3 class="card-title fw-bold">SAVINGS ACCOUNT</h3>
            <p class="card-text text-muted">ID: {{$account->id}}</p>
            <p class="card-text text-muted">Name: {{$account->user->name}}</p>
            <div class="text-end">
              <h5 class="card-text">$ {{number_format($account->balance,2)}}</h5>          
              <span class="text-muted">Available Balance</p> 
            </div>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="row">
      <div class="col">
        <div class="card border-0 text-decoration-none bg-light shadow">
          <div class="card-body">
            <p class="text-center">No Accounts Added yet.</p>
          </div>
        </div>
      </div>
    </div>
    @endforelse
    
</div>
@endsection


