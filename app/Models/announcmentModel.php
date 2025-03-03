<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EquipmetModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class announcmentModel extends Model
{
    use SoftDeletes;
    protected $table = 'announcment';
    protected $fillable = [
        'title',
        "city",
        "price",
        "disponibility",
        "user_id"
    ];
    protected $dates = ['deleted_at'];
    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function equipments()
    {
        return $this->belongsToMany(EquipmetModel::class, 'announcment_equipment', 'annoucment_id', 'equipment_id');
    }
}
