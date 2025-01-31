@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">

          <div class="div text-primary text-center mb-4">
            <i class="fa-solid fa-money-bills fa-9x"></i>
            <h1>New Account</h1>
          </div>

          <form action="{{route('account.store')}}" method="post">
            @csrf
            <div class="row mb-3">
              <label for="balance" class="col-md-4 col-form-label text-md-end">Initial Balance</label>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" name="balance" id="balance" class="form-control" value="{{old('balance')}}" name="balance" required placeholder="Enter your Initial Balance here">
                </div>
                
              @error('balance')
              <div class="text-danger small">{{ $message }}</div>                
              @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-5 offset-md-4 text-end">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{route('account.index')}}" class="btn btn-secondary">Cancel</a>
              </div>    
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection