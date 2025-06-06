<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $primaryKey = 'id_product_images';

    protected $fillable = [
        'product_id',
        'url_gambar',
        'first_picture',
        'sort',
    ];

    protected $casts = [
        'first_picture' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id_product');
    }
}
