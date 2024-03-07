@extends('layout/basic')

@section('title', 'Register')

@section('content')
    <h1>Login</h1>
    <div class="todo_form">
        <form action="{{ route('auth.doLogin') }}" method="POST" name="login">
            @csrf
            <div class="box__table">
                <label for="">Email :</label>
                <input type="email" name="email">
            </div>
            @error('email')
            {{ $message }}
            @enderror
            <div class="box__table">
                <label for="">Password :</label>
                <input type="password" name="password">
            </div>
            @error('password')
            {{ $message }}
            @enderror
            <br>
            <br>
            <div class="box__table">
                <input class="btn" type="reset" value="annuler">
                <input class="btn" type="submit" value="Login">
            </div>
        </form>
    </div>
@endsection
