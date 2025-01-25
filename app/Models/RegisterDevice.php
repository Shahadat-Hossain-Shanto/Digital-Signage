<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegisterDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'device_type',
        'size',
        'model',
        'brand',
        'regulation',
        'description',
        'IMEI',
        'setup_location',
        'group_name',
        'user_by',
        'organized_by',
        'template_id',
        'status',
        'subscriber_id',
        'os'
    ];

    public function template_list()
    {
        return $this->belongsTo(TemplateList::class, 'template_id');
    }

    // Total number of Devices
    public static function totalDevices()
    {
        $subscriberId = Auth::user()->subscriber_id;
        $total_device_count = RegisterDevice::where('subscriber_id', $subscriberId)->count();
        return $total_device_count;
    }
    // Total number of Active Devices
    public static function totalActiveDevices()
    {
        $subscriberId = Auth::user()->subscriber_id;
        $total_active_device_count = RegisterDevice::where([['status', 'true'], ['subscriber_id', $subscriberId]])->count();
        return $total_active_device_count;
    }
    // Total number of Inactive Devices
    public static function totalInactiveDevices()
    {
        $subscriberId = Auth::user()->subscriber_id;
        $total_inactive_device_count = RegisterDevice::where([['status', 'false'], ['subscriber_id', $subscriberId]])->count();
        return $total_inactive_device_count;
    }
}
