<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id_customer';

    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'no_telepon',
        'tanggal_lahir',
        'profil_picture',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'id_customer', 'id_customer');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id_customer');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'id_customer', 'id_customer');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'customer_id', 'id_customer');
    }

    public function comments()
    {
        return $this->hasMany(Content::class, 'id_customer', 'id_customer');
    }
}