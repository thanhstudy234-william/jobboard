<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
protected $table = 'job_posts';
protected $guarded = [];
protected $casts = ['deadline' => 'date'];
public function company() { return $this->belongsTo(Company::class); }
public function category() { return $this->belongsTo(Category::class); }
public function applications() { return $this->hasMany(Application::class); }
}
