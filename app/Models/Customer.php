<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
    ];

    public function getCustomerCodeAttribute(): string
    {
        return 'CUS-'.str_pad((string) $this->getKey(), 6, '0', STR_PAD_LEFT);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
