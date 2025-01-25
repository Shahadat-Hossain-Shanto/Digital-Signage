<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'location',
        'phone',
        'about',
        'password_confirmation',
        'subscriber_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public static function getpermissionsByPermissionName($group_name)
    {

        $permissions = DB::table("permissions")
            ->select("permissions_name")
            ->addSelect(DB::raw("max(if(`permission_type` = 'create', name, null)) `p_create`"))
            ->addSelect(DB::raw("max(if(`permission_type` = 'create', id, null)) `p_create_id`"))
            ->addSelect(DB::raw("max(if(`permission_type` = 'edit', name, null)) `p_edit`"))
            ->addSelect(DB::raw("max(if(`permission_type` = 'edit', id, null)) `p_edit_id`"))
            ->addSelect(DB::raw("max(if(`permission_type` = 'view', name, null)) `p_view`"))
            ->addSelect(DB::raw("max(if(`permission_type` = 'view', id, null)) `p_view_id`"))
            ->addSelect(DB::raw("max(if(`permission_type` = 'destroy', name, null)) `p_destroy`"))
            ->addSelect(DB::raw("max(if(`permission_type` = 'destroy', id, null)) `p_destroy_id`"))
            ->where("group_name", "=", $group_name)
            ->groupBy("permissions_name")
            ->get();
        return $permissions;
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
