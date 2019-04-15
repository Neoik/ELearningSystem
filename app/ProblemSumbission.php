<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemSumbission extends Model
{

    protected $appends = ['problem_name'];
    protected $hidden = ['source_code', 'updated_at', 'max_mem', 'max_time'];

    public const STATUS_PROCESSING    = 0;
    public const STATUS_ACCEPTED      = 1;
    public const STATUS_MEMORY_EXICED = 2;
    public const STATUS_TIME_EXICED   = 3;
    public const STATUS_COMPILE_ERROR = 4;
    public const STATUS_RUNTIME_ERROR = 5;
    public const STATUS_WRONG_ANSWER  = 6;

    private $s2m = array(
      self::STATUS_PROCESSING     => "Processing",
      self::STATUS_ACCEPTED       => "Accepted",
      self::STATUS_MEMORY_EXICED  => "Memory limit exceeded",
      self::STATUS_TIME_EXICED    => "Time limit exceeded",
      self::STATUS_COMPILE_ERROR  => "Compilation error",
      self::STATUS_RUNTIME_ERROR  => "Runtime error",
      self::STATUS_WRONG_ANSWER   => "Wrong answer",
    );

    public function status2msg($status) {
      $rval = "";
      if (array_key_exists($status,$this->s2m)) {
        $rval = $this->s2m[$status];
      }
      return $rval;
    }

    public function getProblemNameAttribute() {
        return Problem::find($this->problem_id)->name;
    }
}
