<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'product_name',
        'slug',
        'description',
        'stok',
        'stok_sales',
        'size',
        'view',
        'id_product_variant',
        'id_category',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'id_product_variant', 'id_product_variant');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id_product');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_product', 'id_product');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'id_product', 'id_product');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id_product');
    }

    public function comments()
    {
        return $this->hasMany(Content::class, 'id_product', 'id_product');
    }

    public function getMainImageAttribute()
    {
        return $this->images()->where('first_picture', true)->first();
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->count();
    }
}