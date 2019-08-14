<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class AttributeValidator.
 *
 * @package namespace App\Validators;
 */
class AttributeValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'attribute_name' => 'required',
        	'product_type' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'attribute_name' => 'required',
        	'product_type' => 'required'
        ],
    ];
}
