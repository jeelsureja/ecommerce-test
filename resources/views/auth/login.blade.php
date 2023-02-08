@extends('layout.master')

@section('guest_content')
<div class="container mt-3">
    @include('layout.response_message')
    <h2>Login</h2>
    <form action="{{ route('verify-login') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('register') }}" class="ml-2">Register</button>
    </form>
</div>
@endsection