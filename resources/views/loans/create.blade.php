@extends('layouts.app')

@section('title', 'Loans')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0">
                    <div class="card-header border-0 text-center">
                        <i class="fa-solid fa-hand-holding-dollar fa-9x text-warning mb-2"></i>
                        <h1 class="text-warning">Loans</h1>
                    </div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th class="text-success" colspan="2"><h1 class="fs-4 fw-bold">Loan Details</h1></th>
                                    </tr>
                                    <tr>
                                        <th>Account Number</th>
                                        <td class="fw-bold text-end text-success">{{ $loan_details['account_id'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Loan Term</th>
                                        <td class="fw-bold text-end text-success">{{ $loan_details['loan_term'] }} months</td>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <th>
                                                Loan Amount
                                                <div class="small fw-light fst-italic text-danger">*Loaned Amount will be added to your balance after confirmation</div>
                                            </th>
                                            <td class="fw-bold text-end text-success">${{ number_format($loan_details['loan_amount'],2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Interest</th>
                                            <td class="fw-bold text-end text-success">{{ round((float)$loan_details['interest'] * 100 ) . '%' }}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Total Amount
                                                <div class="small fw-light fst-italic text-danger">*Loaned Amount with Interest</div>
                                            </th>
                                            <td class="fw-bold text-end text-success">${{ number_format($loan_details['loan_amount_interest'],2) }}</td>

                                        </tr>
                                        <tr>
                                            <th>Monthly Payment</th>
                                            <td class="fw-bold text-end text-success">${{ number_format($loan_details['monthly_payment'], 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form action="{{ route('loan.store', $loan_details) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="account_id" value="{{ $loan_details['account_id'] }}">
                                    <input type="hidden" name="loan_term" value="{{ $loan_details['loan_term'] }}">
                                    <input type="hidden" name="loan_amount" value="{{ $loan_details['loan_amount'] }}">
                                    <input type="hidden" name="interest" value="{{ $loan_details['interest'] }}">
                                    <input type="hidden" name="monthly_payment" value="{{ $loan_details['monthly_payment'] }}">
                                    <input type="hidden" name="loan_amount_interest" value="{{ $loan_details['loan_amount_interest'] }}">
                                    <input type="submit" value="Loan" class="btn btn-warning w-100 fw-bold">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
