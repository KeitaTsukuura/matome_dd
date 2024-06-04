<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GearComment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'body',
        'gear_id',
    ];
    
    public function gear()
    {
        return $this->belongsTo(Gear::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
