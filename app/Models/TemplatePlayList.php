<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplatePlayList extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'order_index',
        'playlist_name',
        'subscriber_id',
        'created_at',
        'updated_at'
    ];
}
