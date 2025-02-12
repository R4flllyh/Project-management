<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['project_name', 'project_description', 'timeline', 'project_type', 'priority', 'status', 'link', 'assets', 'project_image', 'user_id', 'checkbox_names'];

    public function assignee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public static function countProjects()
    {
        return self::count();
    }
}
