<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    protected $table = 'status';
    protected $primaryKey = 'status_id';

    public $fillable = [
    	'status_id',
    	'status_name',
    	'is_active',
    ];

    /**
     * Get the status record associated with the vendor.
     */
    public function vendor()
    {
        return $this->hasMany('App\Entities\Vendor');
    }

    /**
     * Get the status record associated with the institution.
     */
    public function institution()
    {
        return $this->hasMany('App\Entities\Institution');
    }
}
