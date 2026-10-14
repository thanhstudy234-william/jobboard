<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
protected $guarded = [];
public function jobPost() { return $this->belongsTo(JobPost::class); }
public function candidate() { return $this->belongsTo(User::class, 'candidate_id'); }
}
