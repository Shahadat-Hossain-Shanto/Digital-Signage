<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayListContents extends Model
{
    use HasFactory;
    protected $fillable = [
        'playlist_id',
        'content',
        'content_type',
        'duration',
        'order_index',
        'subscriber_id',
        'created_at',
        'updated_at'
    ];
}
