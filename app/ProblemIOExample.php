<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemIOExample extends Model
{
    protected $fillable = array('input', 'output');
    protected $hidden = ['problem_id', 'created_at', 'updated_at'];
}
