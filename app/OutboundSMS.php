<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutboundSMS extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'outboundSMS';
    protected $primaryKey = "outboundSMSID";
    const CREATED_AT = 'dateCreated';
    const UPDATED_AT = 'dateModified';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'outboundSMSID', 'MSISDN', 'message', 'status',
    ];

}