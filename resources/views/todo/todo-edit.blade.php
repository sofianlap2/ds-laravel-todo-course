@extends('layout/app')
@section('title', 'Todo Edit')
@section('content')
    <div>
        <h1>Edit Todo list with laravel</h1>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <form action="{{ route('todo.update', ['id' => $todo->id]) }}" method="POST">
            @method('PUT')
            @csrf
            <input value="{{ $todo->title }}" name="title" type="text">
            <br>
            <select name="is_completed" id="">
                <option {{ !$todo->is_completed ? 'selected' : '' }} value="0">Pending</option>
                <option {{ $todo->is_completed ? 'selected' : '' }} value="1">Completed</option>
            </select>
            <input class="btn"  type="submit" value="Edit Todo">
        </form>

    </div>
@endsection
