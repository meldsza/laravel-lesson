<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['employee_code', 'designation', 'test'];
    public function user()
    {
        return $this->morphOne('App\User', 'details');
    }
    public function test()
    {
        return $this->morphOne('App\User', 'details');
    }
}
