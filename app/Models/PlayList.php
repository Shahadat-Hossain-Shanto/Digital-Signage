<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlayList extends Model
{
    use HasFactory;

    protected $fillable = [
        'playlist_name',
        'mute',
        'subscriber_id',
        'created_at',
        'updated_at'
    ];
}
