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
    public static $rules = [
        'name' => 'required|max:150',
        'phoneNumber'  => ['required', 'max:30', 'regex:/^(([ \-+()]|\d)*)$/'],
        'products'  => 'required|max:150',

        'startedWorking'  => 'required|after:1901-12-13|before:tomorrow|date',

        'landSize' => 'required|numeric|min:0|max:999999999',
        'landSizeUnit'  => 'required|max:5',

        'harvestAmount' => 'required|numeric|min:0|max:999999999',
        'harvestAmountUnit'  => 'required|max:5',

        'locality'  => 'required|max:191',
        'latitude' => 'required|numeric|min:-90|max:90',
        'longitude'  => 'required|numeric|min:-180|max:180',
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
        'longitude',

        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];



    public static function getDefaulOrderBy() {
        return 'name';
    }



    public function hasColumn($column) {
        return \Schema::hasColumn($this->getTable(), $column);
    }
}
