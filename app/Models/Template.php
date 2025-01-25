<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;

    public function playlist()
    {
        return $this->belongsTo(PlayList::class, 'playlist_name');
    }

    // Total number of Templates
    public static function totalTemplates()
    {
        $subscriberId = Auth::user()->subscriber_id;
        $total_template_count = Template::where('subscriber_id', $subscriberId)->count();
        return $total_template_count;
    }
}
