<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CalculateC45 extends Model
{
	protected $table = "calculate_c45";
	public $timestamps = true;
	protected $primaryKey = 'id';	

	protected $fillable = [
       'no_peg',
       'avg_epr1',
       'avg_epr2',
       'avg_epr3',
       'avg_epr4',
       'status1',
       'status2',
       'status3',
       'status4',
       'result'
  ];

  public function c45()
	{
		return $this->belongsTo(C45::class, 'no_peg','no_peg');
  }

}