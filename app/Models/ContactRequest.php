<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_name', 'email', 'org_name', 'mobile', 'issue_title', 'issue_description'
    ];
}
