<?php

namespace App\Models;

use App\Traits\CreatedUpdatedID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Winner extends Model
{
    /** @use HasFactory<\Database\Factories\DojoFactory> */
    use HasFactory,SoftDeletes,CreatedUpdatedID;

    protected $fillable = [
        'winner_name', // Add other fields here that you want to be mass assignable
    ];
}
