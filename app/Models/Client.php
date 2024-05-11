<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends User
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'address',
        'phone',
        'stars',
        'notifications',
    ];
    
    public function getClientType(): string
    {
        return 'Client';
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
