<?php

namespace Sentinel\Service\Validation;

use Illuminate\Validation\Factory;

abstract class AbstractLaravelValidator implements ValidableInterface
{

    /**
     * Validator
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    /**
     * Custom Validation Messages
     *
     * @var Array
     */
    protected $messages = array();

    public function __construct(Factory $validator)
    {
        $this->validator = $validator;

        // Retrieve Custom Validation Messages & Pass them to the validator.
        $this->messages = array_dot(trans('Sentinel::validation.custom'));
    }

    // ...
}
