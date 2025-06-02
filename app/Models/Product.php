<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'quality',
        'origin',
        'status',
        'unit',
        'image',
        'stock_quantity'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock_quantity' => 'integer',
    ];

    // Scope untuk filter berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope untuk produk yang tersedia
    public function scopeAvailable($query)
    {
        return $query->where('status', 'Available');
    }

    // Scope untuk pencarian produk
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%');
    }

    // Accessor untuk format harga
    public function getPriceFormattedAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Accessor untuk URL gambar
    public function getImageUrlAttribute()
    {
        return asset('images/products/' . $this->image);
    }

    // Mutator untuk nama produk (capitalize)
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

    // Method untuk mengurangi stok
    public function decreaseStock($quantity = 1)
    {
        if ($this->stock_quantity >= $quantity) {
            $this->decrement('stock_quantity', $quantity);
            return true;
        }
        return false;
    }

    // Method untuk menambah stok
    public function increaseStock($quantity = 1)
    {
        $this->increment('stock_quantity', $quantity);
    }

    // Method untuk cek ketersediaan stok
    public function isInStock($quantity = 1)
    {
        return $this->stock_quantity >= $quantity;
    }

    // Method untuk mendapatkan status stok
    public function getStockStatusAttribute()
    {
        if ($this->stock_quantity == 0) {
            return 'Out of Stock';
        } elseif ($this->stock_quantity <= 10) {
            return 'Low Stock';
        } else {
            return 'In Stock';
        }
    }

    // Konstanta untuk kategori produk
    const CATEGORIES = [
        'Fresh Fruit',
        'Fresh Vegetables',
        'Meat & Fish',
        'Snacks',
        'Eggs & Dairy',
        'Bakery & Pastry',
        'Honey & Jam',
        'Cooking',
        'Breakfast',
        'Beverages',
        'Fruits Juice',
        'Tea'
    ];

    // Method untuk mendapatkan semua kategori
    public static function getCategories()
    {
        return self::CATEGORIES;
    }

    // Method untuk mendapatkan produk berdasarkan kategori dengan pagination
    public static function getProductsByCategory($category = null, $perPage = 12)
    {
        $query = self::available();

        if ($category) {
            $query->byCategory($category);
        }

        return $query->latest()->paginate($perPage);
    }

    // Method untuk mendapatkan produk terpopuler (berdasarkan stok yang sedikit terjual)
    public function scopePopular($query, $limit = 10)
    {
        return $query->available()
            ->orderBy('stock_quantity', 'asc')
            ->limit($limit);
    }

    // Method untuk mendapatkan produk terbaru
    public function scopeLatest($query, $limit = 10)
    {
        return $query->available()
            ->orderBy('created_at', 'desc')
            ->limit($limit);
    }
}
