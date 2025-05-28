<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function atribute()
    {
        return $this->belongsTo(ProductsAttribute::class, 'atribute_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // di model Order


}
