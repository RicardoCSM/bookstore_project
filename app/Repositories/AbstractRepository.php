<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository {

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectRelatedAttributes($attributes) {
        $this->model = $this->model->with($attributes);
    }

    public function filter($filters) {
        $filters = explode(';', $filters);
            foreach($filters as $condition) {
                $c = explode(':', $condition);
                $this->model = $this->model->where($c[0], $c[1], $c[2]);
        }
    }

    public function selectAttributes($attributes) {
        $this->model = $this->model->selectRaw($attributes);
    }

    public function getResult() {
        return $this->model->paginate(12);
    }

}

?>
