<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Course extends Model 
{

    /* The table associated with the model.
    *
    * @var string
    */
   protected $table = 'course';
   protected $primaryKey = "courseId";
   const CREATED_AT = 'dateCreated';
   const UPDATED_AT = 'dateModified';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'courseName', 'courseDescription', 'status'
    ];

}
