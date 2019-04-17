<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ads extends Model{
    use SoftDeletes;
    protected $primaryKey='a_id';
    public $timestamps=false;
    protected $dates=['deleted_at'];
}
