<?php

namespace models\outside_api\cryptonator;


use models\outside_api\validators\Validator;

/**
 * Class CryptonatorValidator
 * @package models\outside_api\cryptonator
 */
class CryptonatorValidator implements Validator
{
    public const ARRAY = 'array';
    public const ARRAYS = 'arrays';

    /**
     * @param $forValidate
     * @param $validator
     * @return bool
     */
    public function validate(
        $forValidate,
        $validator
    ): bool
    {
        if (is_bool($forValidate['success'])) {
            $validator = $validator[$forValidate['success']];
            $validateResult = $this->checkByValidator($forValidate, $validator);
        } else {
            $validateResult = false;
        }

        return $validateResult;
    }

    /**
     * @param array $forValidate
     * @param array $validator
     * @return bool
     */
    private function checkByValidator(
        array $forValidate,
        array $validator
    ): bool
    {
        $validateResult = true;
        if (!is_array($forValidate) && !is_array($validator)) {
            $validateResult = false;
        } else {
            foreach ($validator as $key => $value) {
                if (is_string($key) && is_array($value)) {
                    $validateResult = array_key_exists($key, $forValidate);
                    if (!$validateResult) break;
                    switch ($value['type']) {
                        case self::ARRAY:
                            $validateResult = $this->checkByValidator($forValidate[$key], $value['values']);
                            break;
                        case self::ARRAYS:
                            foreach ($forValidate[$key] as $item) {
                                $validateResult = $this->checkByValidator($item, $value['values']);
                                if (!$validateResult) break;
                            }
                            break;
                    }
                    if (!$validateResult) break;
                } elseif (is_int($key) && is_string($value)) {
                    $validateResult = array_key_exists($value, $forValidate);
                    if (!$validateResult) break;
                } else {
                    $validateResult = false;
                    break;
                }
            }
        }

        return $validateResult;
    }
}
