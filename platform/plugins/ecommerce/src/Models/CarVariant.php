<?php

namespace Botble\Ecommerce\Models;

use Botble\Base\Models\BaseModel;

class CarVariant extends BaseModel
{
    protected $table = 'variants';
    protected $fillable = ['year_id', 'name'];

    public function year()
    {
        return $this->belongsTo(CarYear::class);
    }
}
