<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CompanyScope implements Scope{

    /**
     * 会社の表示のみに絞り込み
     * @param  Builder  $builder
     * @param  Model  $model
     */
    public function apply(Builder $builder, Model $model){
      $builder->where($model->getTable() . '.type', 2);
    }
}
