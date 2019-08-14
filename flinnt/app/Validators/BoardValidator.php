<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class BoardValidator.
 *
 * @package namespace App\Validators;
 */
class BoardValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'board_name' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'board_name' => 'required'
        ],
    ];
}
