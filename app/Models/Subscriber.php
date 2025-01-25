<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;
    protected $table = 'subscribers';
    protected $fillable = [
        'org_name',
        'org_address',
        'owner_name',
        'bin_number',
        'contact_number',
        'email',
        'status',
        'logo'

    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
