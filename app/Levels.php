<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Levels extends Model 
{

    /* The table associated with the model.
    *
    * @var string
    */
   protected $table = 'levels';
   protected $primaryKey = "levelId";
   const CREATED_AT = 'dateCreated';
   const UPDATED_AT = 'dateModified';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'levelId', 'levelDescription', 'levelName', 'status'
    ];

}
