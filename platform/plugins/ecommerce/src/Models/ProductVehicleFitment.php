<?php

namespace Botble\Ecommerce\Models;

use Botble\Base\Models\BaseModel;

class ProductVehicleFitment extends BaseModel
{
    protected $table = 'product_vehicle_fitments';
    
    protected $fillable = [
        'product_id',
        'make_id', 
        'model_id',
        'year_id',
        'variant_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function year()
    {
        return $this->belongsTo(CarYear::class);
    }

    public function variant()
    {
        return $this->belongsTo(CarVariant::class);
    }

    public function getFullDescriptionAttribute()
    {
        $parts = [];
        if ($this->make) {
            $parts[] = $this->make->name;
        }
        if ($this->model) {
            $parts[] = $this->model->name;
        }
        if ($this->year) {
            $parts[] = $this->year->year;
        }
        if ($this->variant) {
            $parts[] = $this->variant->name;
        }
        
        return implode(' - ', $parts);
    }
}