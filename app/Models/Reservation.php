<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\announcmentModel;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation'; // Explicitly defining the table name

    protected $fillable = [
        'startDate',
        'endDate',
        'totale',
        'announce_id',
        'user_id',
    ];

    /**
     * Get the announcement associated with the reservation.
     */
    public function announcement()
    {
        return $this->belongsTo(announcmentModel::class, 'announce_id');
    }

    /**
     * Get the user who made the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
