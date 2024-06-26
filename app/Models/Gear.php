<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gear extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'image_url',
    ];
    
    public function getPaginateBylimit(int $limit_count = 3)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function gear_comments()
    {
        return $this->hasMany(GearComment::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
