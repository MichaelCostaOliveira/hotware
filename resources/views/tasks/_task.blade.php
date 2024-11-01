<div id="task_{{ $task->id }}">
    <p>{{ $task->name }} @if($task->completed) (Concluída) @endif</p>
    @unless($task->completed)
        <form action="{{ route('tasks.complete', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit">Concluir</button>
        </form>
    @endunless
</div>
