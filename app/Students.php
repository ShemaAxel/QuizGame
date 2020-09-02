<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Students extends Model 
{

    /* The table associated with the model.
    *
    * @var string
    */
   protected $table = 'students';
   protected $primaryKey = "stdId";
   const CREATED_AT = 'dateCreated';
   const UPDATED_AT = 'dateModified';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stdId', 'stdFname', 'stdLname', 'age', 'levelId', 'status'
    ];

        /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'passwordHash',
    ];

}
