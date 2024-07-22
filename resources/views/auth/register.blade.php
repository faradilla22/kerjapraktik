@extends('layouts.apps')

@section('content')
<title>@section('title','Setting ECR')</title>

<form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <label>Username</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <div>
        <label>Status</label>
        <select name="status" required>
            <option value="engineer">Engineer</option>
            <option value="engineer koordinator">Engineer Koordinator</option>
        </select>
    </div>
    <button type="submit">Register</button>
</form>

@endsection