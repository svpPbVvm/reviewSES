<?php

namespace models\outside_api\cryptonator;


use models\curl\CURLRequest;
use models\enum\outside_api\cryptonator\CryptonatorResponseStructure;
use models\enum\outside_api\cryptonator\Currencies;
use models\enum\outside_api\cryptonator\Methods;
use models\outside_api\validators\APIResponseValidator;

/**
 * Class Cryptonator
 * @package models\outside_api\cryptonator
 */
class Cryptonator
{
    private const URL = 'https://api.cryptonator.com/api/';
    private const CURRENCIES_SEPARATOR = '-';

    /**
     * @param string $baseCurrency
     * @param string $targetCurrency
     * @param string $method
     * @return array
     * @throws \Exception
     */
    public static function getCurrencyRate(
        string $baseCurrency,
        string $targetCurrency,
        string $method = Methods::SIMPLE_TICKER
    ): array
    {
        if (
            Methods::isAvailableConst($method)
            && $baseCurrency != $targetCurrency
            && Currencies::isAvailableConst($baseCurrency)
            && Currencies::isAvailableConst($targetCurrency)
        ) {
            $curlResponseResult = CURLRequest::get(
                self::URL
                . $method
                . '/'
                . $baseCurrency
                . self::CURRENCIES_SEPARATOR
                . $targetCurrency
            )['result'];

            $result = json_decode($curlResponseResult, true);
            $APIResponseValidator = new APIResponseValidator(new CryptonatorValidator());
            $validateSuccess = $APIResponseValidator->validateResponse(
                $result,
                CryptonatorResponseStructure::STRUCTURE_BY_METHOD_AND_SUCCESS[$method]
            );

            if (!$validateSuccess) {
                throw new \Exception('cryptonar error: response structure has been modified');
            }
        } else {
            throw new \Exception('cryptonar error: used unavailable method or currencies');
        }

        return $result;
    }

}
