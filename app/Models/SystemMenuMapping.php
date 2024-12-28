<?php

namespace App\Models;

use App\Models\SystemMenu;
use App\Models\SystemUserGroup;
use Illuminate\Database\Eloquent\Model;

class SystemMenuMapping extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'system_menu_mapping';
    protected $primaryKey   = 'menu_mapping_id';

    protected $guarded = [
    ];

    protected $casts = [
        'id_menu' => 'string',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
    ];


    // Relation to the SystemMenu model
    public function menu()
    {
        return $this->belongsTo(SystemMenu::class, 'id_menu', 'id_menu');
    }

    // Relation to the SystemUserGroup model
    public function userGroup()
    {
        return $this->belongsTo(SystemUserGroup::class, 'user_group_id');
    }
}
