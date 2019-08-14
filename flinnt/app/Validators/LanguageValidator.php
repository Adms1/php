<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class LanguageValidator.
 *
 * @package namespace App\Validators;
 */
class LanguageValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'language_name' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'language_name' => 'required'
        ],
    ];
}
