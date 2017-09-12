<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * Rules for validating model attributes assignment.
     *
     * @var array
     */
    public $rules = [
        'name' => 'required|max:',
        'phoneNumber'  => 'required',
        'products'  => 'required',

        'startedWorking'  => 'required',

        'landSize'  => 'required',
        'landSizeUnit'  => 'required',
        
        'harvestAmount'  => 'required',
        'harvestAmountUnit'  => 'required',

        'locality'  => 'required',
        'latitude'  => 'required',
        'longitude'  => 'required',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phoneNumber',
        'products',

        'startedWorking',

        'landSize',
        'landSizeUnit',

        'harvestAmount',
        'harvestAmountUnit',

        'locality',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
