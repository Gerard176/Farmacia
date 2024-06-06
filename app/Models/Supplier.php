<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    
    protected $table = "suppliers";
    protected $fillable = [
        'name',
        'adress',
        'phone',
        'email',
        'description',
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
    public function product(){
        return $this->hasMany(Product::class, 'id_supplier');
    }
}
