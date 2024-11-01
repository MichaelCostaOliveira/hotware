<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function getWithFilters($request, $perPage = 10, $page = 1, $order = 'asc'){

        $this->model = $this->model->with('escalaTrabalho');
        if ($request->filled('search')){
            $this->model =  $this->model->where('name', 'like', '%'.$request->get('search').'%')
                ->orWhere('cpf', '=', $request->get('search'))
                ->orWhere('matricula', '=', $request->get('search'))
                ->orWhere('escala_trabalho_id', '=', $request->get('search'));
        }

        if ($request->filled('order_by')){
            if ($request->filled('order')){
                $order = $request->get('order');
            }
            $this->model = $this->model->orderBy($request->get('order_by'), $order);
        }

        if ($request->filled('perPage')){
            $perPage = $request->get('perPage');
        }

        if ($request->filled('page')){
            $page = $request->get('page');
        }

        return $this->model->paginate($perPage, ['*'], 'page', $page);
    }

    public function completeById($taskId)
    {
        // Busca a tarefa pelo ID e marca como concluída
        $task = $this->model->findOrFail($taskId);
        $task->update(['completed' => true]);

        return $task;
    }
}
