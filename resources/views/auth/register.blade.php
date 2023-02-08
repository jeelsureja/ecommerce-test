@extends('layout.master')

@section('guest_content')
<div class="container mt-3">
    @include('layout.response_message')
    <h2>Register</h2>
    <form action="{{ route('user-register') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="email">First Name:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter first name" name="first_name">
        </div>
        <div class="form-group">
            <label for="email">Last Name:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter last name" name="last_name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="email">Phone number:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter phone number" name="phone_no">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter confirm password" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="#" class="ml-2">Register</button>
    </form>
</div>
@endsection