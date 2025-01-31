<h1 class="display-6 text-center my-4">Please select an account for your loan:</h1>
<form action="" method="post">
    @csrf
    @method('GET')
    <div class="row justify-content-center mb-5">
        <div class="col-4">
            <select name="account_id" id="account-id" class="form-select form-select-lg">
                <option hidden>Account Number - Balance</option>
                @foreach(Auth::user()->accounts as $account)
                    @if($account->loan)
                        <option disabled>{{ $account->id }} - ${{ number_format($account->balance)  . "[ACTIVE LOAN]"}}</option>
                    @elseif($account->balance <= 10000)
                        <option disabled>{{ $account->id }} - ${{ number_format($account->balance)  . "[NOT ELIGIBLE]"}}</option>
                    @elseif($account->balance > 10000)
                        <option value="{{ $account->id }}">{{ $account->id }} - ${{ number_format($account->balance)}}</option>
                    @endif
                @endforeach
            </select>
            @error('account_id')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <input type="submit" value="Next" name="btn_next" class="btn btn-warning w-100 fw-bold">
        </div>
    </div>
</form>