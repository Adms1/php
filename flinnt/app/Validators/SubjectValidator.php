<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class SubjectValidator.
 *
 * @package namespace App\Validators;
 */
class SubjectValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'subject_name' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'subject_name' => 'required'
        ],
    ];
}
