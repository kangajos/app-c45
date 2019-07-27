<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class C45 extends Model
{
	protected $table = "c45";
	public $timestamps = true;
	protected $primaryKey = 'id';	

	protected $fillable = [
       'no_peg',
       'year',
       'name',
       'code',
       'code_text',
       'gender',
       'persg',
       'persk',
       'ctr',
       'ctr_text',
       'birth_date',
       'age',
       'join_date',
       'position',
       'position_text',
       'epr1',
       'epr2',
       'epr3',
       'epr4'
  ];

}