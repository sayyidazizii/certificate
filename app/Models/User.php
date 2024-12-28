<?php
namespace App\Models;

// use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SystemUserGroup;
use App\Traits\CreatedUpdatedID;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles, SoftDeletes, CreatedUpdatedID;

    protected $table = 'system_user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'user_group_id',
        'branch_id',
        'phone',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $logAttributes = [
        'username',
        'first_name',
        'last_name',
        'email',
        'user_group_id',
        'branch_id',
        'phone',
        'avatar',
    ];

    protected static $logName = 'user_activity';
    protected static $logOnlyDirty = true;

    // Implement the getActivitylogOptions() method with correct return type
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['username', 'first_name', 'last_name', 'email', 'user_group_id', 'branch_id', 'phone', 'avatar'])
            ->useLogName('user_activity'); // Custom log name, optional
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->info) {
            return asset($this->info->avatar_url);
        }
        return asset(theme()->getMediaUrlPath().'avatars/blank.png');
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo(CoreBranch::class, 'branch_id', 'branch_id');
    }

    public function group()
    {
        return $this->belongsTo(SystemUserGroup::class, 'user_group_id', 'user_group_id');
    }
}
