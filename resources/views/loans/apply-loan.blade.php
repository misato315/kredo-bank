@extends('layouts.app')

@section('title', 'Loans')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(Auth::user()->accounts->isNotEmpty())
                    <div class="card border-0">
                        <div class="card-header border-0 text-center">
                            <i class="fa-solid fa-hand-holding-dollar fa-9x text-warning mb-2"></i>
                            <h1 class="text-warning">Loans</h1>
                        </div>

                        <div class="card-body">
                            @if($active_loan == true)
                                <h1 class="display-6 text-center text-danger mt-5 mb-2">You currently have an active loan. <br> Please settle your loans first.</h1>
                                <h1 class="display-6 text-center">
                                    <i class="fa-solid fa-triangle-exclamation text-center text-danger fa-5x"></i>
                                </h1>
                            @elseif(empty($_POST))
                                @include('loans.contents.account-selection')
                            @elseif(request('btn_next'))
                                @include('loans.contents.loan-terms')
                            @endif
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