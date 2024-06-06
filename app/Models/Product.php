<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'name',
        'description',
        'stock',
        'unit_price',
        'category',
        'id_supplier',
        'due_date',
        'image',
        'status',
        'registerby',
    ];
    protected $guarded = [
        'ID',
        'updated_at',
        'created_at',
        'status',
        'registerby',

    ];
    public function supplier(){
        return $this->belongsTo(Supplier::class,'id_supplier');
    }
    public function orderDetail(){
        return $this->hasMany(OrderDetail::class, 'id_product');
    }
    
   
}
