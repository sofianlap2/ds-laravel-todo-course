@extends('layout/basic')

@section('title', 'Register')

@section('content')
    <h1>Inscription</h1>
    <div class="todo_form">
        <form action="{{ route('auth.store') }}" method="POST" name="register">
            @csrf
            <div class="box__table">
                <label for="">Name :</label>
                <input type="text" name="name">
            </div>
            @error('name')
            {{ $message }}
            @enderror
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
            <div class="box__table">
                <a class="link" href="{{ route('auth.indexLogin') }}">Already have an account ?</a>
            </div>
            <br>
            <div class="box__table">
                <input class="btn" type="reset" value="annuler">
                <input class="btn" type="submit" value="Inscription">
            </div>
        </form>
    </div>
@endsection
