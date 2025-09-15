<?php

namespace Botble\Ecommerce\Models;

use Botble\Base\Models\BaseModel;

class Make extends BaseModel
{
    protected $table = 'makes';
    protected $fillable = ['name', 'slug'];

    public function models()
    {
        return $this->hasMany(CarModel::class);
    }
}
