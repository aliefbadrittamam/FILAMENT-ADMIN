<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';
    protected $primaryKey = 'id_product_variant';

    protected $fillable = [
        'color',
        'id_price',
    ];

    public function price()
    {
        return $this->belongsTo(Price::class, 'id_price', 'id_price');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_product_variant', 'id_product_variant');
    }
}