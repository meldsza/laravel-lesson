<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['employee_code', 'designation', 'test', 'test2'];
    public function user()
    {
        return $this->morphOne('App\User', 'details');
    }
}
