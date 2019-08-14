<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class AuthorValidator.
 *
 * @package namespace App\Validators;
 */
class AuthorValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'author_name' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'author_name' => 'required'
        ],
    ];
}
