<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'content_type',
        'created_at',
        'updated_at',
        'subscriber_id',
    ];


    public function banner()
    {
        return $this->hasMany(Banner::class, 'app_id', 'id');
    }
}
