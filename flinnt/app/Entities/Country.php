<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $table = 'country';
    protected $primaryKey = 'country_id';

    public $fillable = [
    	'sortname',
    	'name',
    	'phonecode',
    ];

    /**
     * Get the country record associated with the vendor.
     */
    public function vendor()
    {
        return $this->hasMany('App\Entities\Vendor');
    }

    /**
     * Get the country record associated with the institution.
     */
    public function institution()
    {
        return $this->hasMany('App\Entities\Institution');
    }
}
