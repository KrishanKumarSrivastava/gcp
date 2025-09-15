<?php

namespace Botble\Ecommerce\Models;

use Botble\Base\Models\BaseModel;

class CarModel extends BaseModel
{
    protected $table = 'models';
    protected $fillable = ['make_id', 'name', 'slug'];

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function years()
    {
        return $this->hasMany(CarYear::class);
    }
}
