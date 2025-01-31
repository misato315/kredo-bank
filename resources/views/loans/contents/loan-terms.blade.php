<div class="row my-4 justify-content-center">
    <div class="col-6">
        <h1 class="lead fs-3 fw-bold text-center text-danger">Account Number: {{ request('account_id') }}</h1>
    </div>
</div>

<h1 class="display-6 my-5 text-center">How many months would you like for your loan term?</h1>
<form action="{{ route('loan.create') }}" method="post">
    @csrf
    @method('GET')
    <input type="hidden" name="account_id" value="{{ request('account_id') }}">
    <div class="row text-center mb-5">
        <div class="col-4">
            <input type="radio" class="btn-check btn-lg" name="loan_term" id="three-months" value="3">
            <label class="btn btn-outline-success w-100 fw-bold" for="three-months">3 Months</label>
        </div>
        <div class="col-4">
            <input type="radio" class="btn-check btn-check-lg" name="loan_term" id="six-months" value="6">
            <label class="btn btn-outline-success w-100 fw-bold" for="six-months">6 Months</label>
        </div>
        <div class="col-4">
            <input type="radio" class="btn-check" name="loan_term" id="twelve-months" value="12">
            <label class="btn btn-outline-success w-100 fw-bold" for="twelve-months">12 Months</label>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <input type="submit" value="Compute" class="btn btn-warning fw-bold w-100">
        </div>
    </div>
</form>