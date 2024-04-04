<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_Product extends Model
{
    use HasFactory;
    protected $fillable = ['ticket_id', 'product_id', 'quantity'];
    protected $table = 'ticket_product';
}
