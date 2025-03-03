<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\announcmentModel;

class EquipmetModel extends Model
{
    protected $table = 'equipment';
    protected $fillable = [
        'name',
    ];
    public function announcements()
    {
        return $this->belongsToMany(announcmentModel::class, 'announcement_equipment', 'equipment_id', 'announcement_id');
    }
}
