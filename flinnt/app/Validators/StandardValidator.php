<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StandardValidator.
 *
 * @package namespace App\Validators;
 */
class StandardValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'standard_name' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'standard_name' => 'required'
        ],
    ];
}
