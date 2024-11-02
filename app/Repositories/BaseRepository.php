<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * The Model name.
     *
     * @var \Illuminate\Database\Eloquent\Model;
     */
    protected $model;

    public function all()
    {
        return $this->model->all();
    }
    /**
     * Paginate the given query.
     *
     * @param The number of models to return for pagination $n integer
     *
     * @return mixed
     */
    public function getPaginate($n)
    {
        return $this->model->paginate($n);
    }

    /**
     * Create a new model and return the instance.
     *
     * @param array $inputs
     *
     * @return Model instance
     */
    public function store(array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function insert(array $inputs)
    {
        return $this->model->insert($inputs);
    }

    /**
     * FindOrFail Model and return the instance.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    /* public function getById($id)
    {
        return $this->model->findOrFail($id);
    } */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Update the model in the database.
     *
     * @param $id
     * @param array $data
     */
    public function update(int $id, array $data)
    {
        //$this->getById($id)->update($inputs);
        $result = $this->find($id);
        if (!$result) {
            return false;
        }
        return $result->update($data);
    }

    /**
     * Delete the model from the database.
     *
     * @param int $id
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->find($id)->delete();
    }
}
