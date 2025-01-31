@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(Auth::user()->accounts->isNotEmpty())
                    <div class="card  border-0">
                        <div class="row my-4 justify-content-center">
                            <div class="col-6">
                                <h1 class="lead fs-3 fw-bold text-center text-danger">Account Number: {{ request('account_id') }}</h1>
                            </div>

                            <div class="card-body">
                                <h1 class="display-6 my-5 text-center">Please type the number of months you would like to repay your loan:</h1>
                                <form action="{{ route('payment.amount') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="account_id" value="{{ request('account_id') }}">
                                    <div class="row justify-content-center mb-5">
                                        <div class="col-4 align-items-center">
                                            <input type="number" class="form-control text-center fw-bold" name="months" id="months" min="1" max="{{ $account_details->loan->first() }}">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <input type="submit" value="Pay" class="btn btn-warning fw-bold w-100">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection