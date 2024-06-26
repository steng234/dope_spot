<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $table ='credit_cards';
    protected $fillable = ['user_id', 'card_number', 'expiry_date', 'cvv'];

    // Define any relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
