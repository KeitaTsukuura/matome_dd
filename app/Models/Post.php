<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
        'category_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);    
    }
    public function getByLimit(int $limit_count = 100)
    {
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    public function getPaginateBylimit(int $limit_count = 5)
    {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
