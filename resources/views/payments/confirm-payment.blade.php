@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card  border-0">
                <div class="card-header  border-0 text-center">
                    <i class="fa-solid fa-money-bill-transfer fa-9x text-warning mb-2"></i>
                    <h1 class="text-warning">Payment</h1>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th class="text-success" colspan="2"><h1 class="fs-4 fw-bold">Payment Details</h1></th>
                                </tr>
                                <tr>
                                    <th>Account ID:</th>
                                    <td class="fw-bold text-end text-success">{{ $account_id }}</td>
                                </tr>
                                <tr>
                                    <th>Terms Paid:</th>
                                    <td class="fw-bold text-end text-success">{{ $months }} month/s</td>
                                </tr>
                                <tbody>
                                    <tr>
                                        <th>
                                            Paid Amount Per Term:
                                        </th>
                                        <td class="fw-bold text-end text-success">$ {{ number_format(optional($account_details->loan->first())->monthly_payment ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">
                                            Total Amount Due:
                                            <div class="fw-bold text-end text-success">
                                                $ {{ number_format(optional($account_details->loan->first())->monthly_payment * $months, 2) }}
                                            </div>
                                            <div class="small fw-light fst-italic text-warning">*Paid Amount will be deducted to your loan amount after confirmation</div>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="{{ route('payment.update', $account_details->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="input-group mb-3 w-75">
                                    <input type="hidden" name="account_id" value="{{ request('account_id') }}">
                                    <input type="hidden" name="months" value="{{ request('months') }}">
                                    <div class="input-group-prepend me-1">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control me-1 text-end" aria-label="Amount (to the nearest dollar)" step="0.01" min="{{ optional($account_details->loan->first())->monthly_payment * $months ?? 0 }}" name="payment">
                                    <div class="input-group-append">
                                        <input type="submit" value="Confirm" class="btn btn-warning w-100 fw-bold">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
