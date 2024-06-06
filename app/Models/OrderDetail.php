<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $fillable = [
        'required_amount',
        'total_per_product',
        'id_product',
        'id_order',
    ];
    protected $guarded = [
        'ID',
        'updated_at',
        'created_at',
    ];
    public function products(){
        return $this->belongsTo(Product::class,'id_product');
    }
    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class,'id_order');
    }
}
