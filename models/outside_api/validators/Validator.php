<?php

namespace models\outside_api\validators;


/**
 * Interface Validator
 * @package models\enum\outside_api\validators
 */
interface Validator
{
    public function validate($forValidate, $validator): bool;
}
