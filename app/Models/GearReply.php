<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GearReply extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'body',
        'gear_comment_id',
    ];
    
    public function gear_comment()
    {
        return $this->belongsTo(GearComment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
