<?php

namespace models\outside_api\validators;


/**
 * Class Validator
 * @package models\enum\outside_api
 */
class APIResponseValidator
{
    /**
     * @var Validator
     */
    private Validator $validator;

    /**
     * APIResponseValidator constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $result
     * @param $structure
     * @return bool
     */
    public function validateResponse($result, $structure): bool
    {
        return $this->validator->validate($result, $structure);
    }
}
