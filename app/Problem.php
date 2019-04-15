<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = array('name', 'description', 'input_description', 'output_description', 'max_mem', 'max_time');
    public function ioExamples() {
        return $this->hasMany('App\ProblemIOExample');
    }

    protected $hidden = ['submit_count', 'solve_count', 'created_at', 'updated_at'];
}
