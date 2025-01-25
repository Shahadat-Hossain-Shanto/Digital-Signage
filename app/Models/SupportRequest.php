<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'orgName',
        'mobile',
        'issueTitle',
        'issue_description',
        'ticketNumber',
        'status',
    ];
}
