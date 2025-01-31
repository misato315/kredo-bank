@extends('layouts.app')

@section('body_class', 'bg-dark')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(Auth::user()->accounts->isNotEmpty())
                    <div class="card border-0">
                        <div class="card-header border-0 text-center">
                            <i class="fa-solid fa-circle-dollar-to-slot fa-9x text-success mb-2"></i>
                            <h1 class="text-success">Deposit</h1>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('users.deposit') }}" method="post">
                                @csrf
                                @method('PATCH')
                                
                                <div class="row mb-3">
                                    <label for="account" class="col-md-4 col-form-label text-white text-md-end">{{ __('Account') }}</label>

                                    <div class="col-md-5">
                                        @foreach(Auth::user()->accounts as $account)
                                            <input type="radio" class="btn-check" name="account" id="account-{{$account->id}}" value="{{ $account->id }}" autocomplete="off" required>
                                            <label class="btn btn-outline-success fw-bold" for="account-{{$account->id}}">{{ $account->id }}</label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="amount" class="col-md-4 col-form-label text-white text-md-end">{{ __('Deposit Amount') }}</label>

                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <span class="input-group-text" id="dollar-mark">$</span>

                                            <input type="number" class="form-control @error('amount') is-invalid @enderror" placeholder="Enter your deposit amount here" name="amount" value="{{ old('amount') }}" required>
                                        </div>

                                        @error('amount')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 offset-md-4">
                                        <button type="submit" class="btn btn-success w-100">
                                            {{ __('Deposit') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card border-0 mt-5">
                        <div class="card-body">
                            <h1 class="display-6 text-center text-danger mt-5 mb-3">
                                Please create an account first.
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
