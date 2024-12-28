<?php

// app/Models/Certificate.php

namespace App\Models;

use App\Traits\CreatedUpdatedID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory,SoftDeletes,CreatedUpdatedID;

    protected $fillable = [
        'participant_id',
        'certificate_date',
        'winner_id',
        'created_id',
        'updated_id',
        'deleted_id'
    ];

    // Define the relationship with Participant
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    // Define the relationship with Winner
    public function winner()
    {
        return $this->belongsTo(Winner::class);
    }
}
