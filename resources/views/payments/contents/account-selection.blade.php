<h1 class="display-6 text-center my-4">Please select an account for your payment:</h1>
<form action="{{ route('payment.selection') }}" method="post">
    @csrf
    <div class="row justify-content-center mb-5">
        <div class="col-4">
            <select name="account_id" id="account-id" class="form-select form-select-lg">
                @foreach(Auth::user()->accounts as $account)
    <option value="{{ $account->id }}">
        {{ $account->id }} - 
        @if($account->loan && $account->loan->first()) 
            ${{ number_format($account->loan->first()->total_amount, 2) }} [ACTIVE LOAN]
        @else
            {{ "[Account has no loan]" }}
        @endif
    </option>
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