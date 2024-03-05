<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>TodoList</title>
</head>

<body class="todo-container">
    <h1>Todo list with laravel</h1>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if (session()->has('success'))
        <div>
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="todo_form">
        <form action="" method="POST">
            @csrf
            <input name="title" id="todo__add" type="text" placeholder="Add todo title">
            <input class="btn" type="submit" value="Add Todo">
        </form>
    </div>

    <table cellspacing="0">
        <tr>
            <th>N°</th>
            <th>Title</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @if ($todos)
            @foreach ($todos as $todo)
                <tr>
                    <td>{{ $todo->id }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>
                        @if ($todo->is_completed)
                            Completed
                        @else
                            Pending
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('todo.edit', ['id' => $todo->id]) }}">
                            <div class="btn-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path
                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                </svg>
                            </div>
                        </a>
                        <a href="{{ route('todo.destroy', ['id' => $todo->id]) }}">
                            <div class="btn-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                                </svg>
                            </div>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
</body>

</html>
