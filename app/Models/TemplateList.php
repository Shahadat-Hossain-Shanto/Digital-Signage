<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplateList extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_name',
        'full_screen',
        'screen_height',
        'screen_width',
        'footer',
        'left_sidebar',
        'right_sidebar',
        'rotation',
        'subscriber_id',
        'created_at',
        'updated_at'
    ];

    public function playlist()
    {
        return $this->belongsTo(PlayList::class, 'playlist_name');
    }

    // Total number of Templates
    public static function totalTemplates()
    {
        $subscriberId = Auth::user()->subscriber_id;
        $total_template_count = TemplateList::where('subscriber_id', $subscriberId)->count();
        return $total_template_count;
    }
}
