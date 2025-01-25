<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_id',
        'name',
        'text',
        'subscriber_id',
        'created_at',
        'updated_at',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class, 'app_id', 'id');
    }
}
