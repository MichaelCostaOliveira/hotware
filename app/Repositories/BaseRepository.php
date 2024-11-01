<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function updateOrCreate(array $data)
    {
        $this->model->updateOrCreate($data);
    }

    public function updateOrCreateValidate(array $validate, array $data){
        $this->model->updateOrCreate($validate,$data);
    }
    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function relationships(array $relations)
    {
        return $this->model->with($relations);
    }

    public function getObject(){
        return $this->model;
    }

    public function where($column, $operator, $value){
        return $this->where($column, $operator, $value);
    }

    public function restore($id){
        return $this->model->withTrashed()->find($id)->restore();
    }
}
