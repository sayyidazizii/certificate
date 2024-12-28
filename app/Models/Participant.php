<?php

namespace App\Models;

use App\Traits\CreatedUpdatedID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory, SoftDeletes,CreatedUpdatedID;

    protected $fillable = [
        'participant_name',
        'dojo_id',
        'created_id',
        'updated_id',
        'deleted_id'
    ];

    // Relationship to Dojo
    public function dojo()
    {
        return $this->belongsTo(Dojo::class);
    }
}
