<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class VendorValidator.
 *
 * @package namespace App\Validators;
 */
class VendorValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'vendor_name' => 'required|max:500',
            'email' => 'required',
            'vendor_address1' => 'required|max:255',
            'vendor_address2' => 'required|max:255',
            'vendor_city' => 'required|max:75',
            'vendor_state_id' => 'required',
            'vendor_country_id' => 'required',
            'vendor_pin' => 'required|max:15',
            'vendor_status_id' => 'required',
            'vendor_gst_number' => 'required|max:100',
            'flint_charge' => 'required|max:11',
            'vendor_phone' => 'required|max:15',
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'vendor_name' => 'required|max:500',
            'email' => 'required',
            'vendor_address1' => 'required|max:255',
            'vendor_address2' => 'required|max:255',
            'vendor_city' => 'required|max:75',
            'vendor_state_id' => 'required',
            'vendor_country_id' => 'required',
            'vendor_pin' => 'required|max:15',
            'vendor_status_id' => 'required',
            'vendor_gst_number' => 'required|max:100',
            'flint_charge' => 'required|max:11',
            'vendor_phone' => 'required|max:15',
        ],
    ];
}
