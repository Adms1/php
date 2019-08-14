<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PublisherValidator.
 *
 * @package namespace App\Validators;
 */
class PublisherValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'publisher_name' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'publisher_name' => 'required'
        ],
    ];
}
