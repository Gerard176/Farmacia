<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = "purchase_orders";
    protected $fillable = [
        'order_date',
        'delivery_date',
        'order_price',
        'factura',
        'id_user',
        'status',
    ];
    protected $guarded = [
        'ID',
        'updated_at',
        'created_at',
        'status',
    ];
  
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
    public function OrderDetails(){
        return $this->hasMany(OrderDetail::class, 'id_order');
    }
}
