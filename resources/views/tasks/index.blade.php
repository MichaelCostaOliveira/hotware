@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Lista de Tarefas</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('tasks_store') }}" method="POST">
                        @csrf
                        <input type="text" name="name" placeholder="Nova tarefa" required>
                        <button type="submit">Adicionar</button>
                    </form>

                    <div id="tasks">
                        @foreach ($tasks as $task)
                            @include('tasks._task', ['task' => $task])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
