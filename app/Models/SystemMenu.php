<?php

namespace App\Models;

use App\Models\SystemMenuMapping;
use Illuminate\Database\Eloquent\Model;

class SystemMenu extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'system_menu';
    protected $primaryKey   = 'id_menu';

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

    // Define the parent-child relationship for hierarchical structure
    public function parent()
    {
        return $this->belongsTo(SystemMenu::class, 'parent_id'); // assuming `parent_id` column exists
    }

    // Get all child menus
    public function children()
    {
        return $this->hasMany(SystemMenu::class, 'parent_id', 'id_menu')
            ->with('children'); // Rekursif untuk mendukung multi-level
    }


    // Define a relationship to menu mappings (which ties menus to user groups)
    public function mappings()
    {
        return $this->hasMany(SystemMenuMapping::class, 'id_menu', 'id_menu');
    }

}
