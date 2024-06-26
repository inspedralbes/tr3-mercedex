<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'lastname', 'status', 'address', 'phone', 'email', 'total'];
    protected $table = 'tickets';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ticket_product')->withPivot('quantity');
    }
}
