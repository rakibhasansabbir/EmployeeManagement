<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

class EmployeeActivity extends Model
{
  public function employee()
  {
      return $this->belongsTo('App\Employee');
  }
}
