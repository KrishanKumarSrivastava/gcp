<?php

namespace Botble\Ecommerce\Models;

use Botble\Base\Models\BaseModel;

class CarYear extends BaseModel
{
    protected $table = 'years';
    protected $fillable = ['model_id', 'year'];

    public function model()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function variants()
    {
        return $this->hasMany(CarVariant::class);
    }

    public function getYearWithModelAttribute()
    {
        return $this->model->make->name . ' - ' . $this->model->name . ' (' . $this->year . ')';
    }
}
