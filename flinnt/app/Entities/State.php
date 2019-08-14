<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $table = 'state';
    protected $primaryKey = 'state_id';

    public $fillable = [
    	'name',
    	'country_id',
    ];

    /**
     * Get the state record associated with the vendor.
     */
    public function vendor()
    {
        return $this->hasMany('App\Entities\Vendor');
    }

    /**
     * Get the state record associated with the institution.
     */
    public function institution()
    {
        return $this->hasMany('App\Entities\Institution');
    }
}
