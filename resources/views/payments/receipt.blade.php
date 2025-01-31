@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="display-4 text-center text-success mt-5 mb-2">Thank you for paying!</h1>
                <h1 class="display-6 text-center text-success mt-5 mb-2">Your change: $ {{ number_format($change,2) }}.</h1>
                <div class="text-center mt-5 mb-2"><a href="{{ route('account.index') }}" class="btn btn-warning w-25 fw-bold">Back to account</a></div>
            </div>
        </div>
    </div>
@endsection