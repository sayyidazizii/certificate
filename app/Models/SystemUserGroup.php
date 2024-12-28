<?php

namespace App\Models;
use App\Traits\CreatedUpdatedID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SystemUserGroup extends Model
{
    use HasFactory,SoftDeletes,CreatedUpdatedID;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'system_user_group'; 
    protected $primaryKey   = 'user_group_id';
    
    protected $guarded = [
        'user_group_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
    ];

}