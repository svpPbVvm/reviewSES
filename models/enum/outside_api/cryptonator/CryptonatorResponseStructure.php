<?php

namespace models\enum\outside_api\cryptonator;


use models\enum\Enum;
use models\outside_api\cryptonator\CryptonatorValidator;

/**
 * Class StructureByMethod
 * @package models\enum\outside_api\cryptonator
 */
class CryptonatorResponseStructure extends Enum
{
    public const STRUCTURE_BY_METHOD_AND_SUCCESS = [
        Methods::SIMPLE_TICKER => [
            true => [
                'ticker' => [
                    'type' => CryptonatorValidator::ARRAY,
                    'values' => [
                        'base',
                        'target',
                        'price',
                        'volume',
                        'change',
                    ]
                ],
                'timestamp',
                'success',
                'error',
            ],
            false => [
                'success',
                'error',
            ],
        ],
        Methods::COMPLETE_TICKER => [
            true => [
                'ticker' => [
                    'type' => CryptonatorValidator::ARRAY,
                    'values' => [
                        'base',
                        'target',
                        'price',
                        'volume',
                        'change',
                        'markets' => [
                            'type' => CryptonatorValidator::ARRAYS,
                            'values' => [
                                'market',
                                'price',
                                'volume',
                            ]
                        ],
                    ],
                ],
                'timestamp',
                'success',
                'error',
            ],
            false => [
                'success',
                'error',
            ],
        ],
    ];
}
