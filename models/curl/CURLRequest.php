<?php

namespace models\curl;


/**
 * Class CURLRequest
 * @package models\curl
 */
class CURLRequest
{
    /**
     * @param string $url
     * @param array $params
     * @param array $additionalCurlOpt
     * @return array
     * @throws \Exception
     */
    public static function get(
        string $url,
        array $params = [],
        array $additionalCurlOpt = []
    ): array
    {
        $encoded = '';
        foreach($params as $name => $value) {
            $encoded .= urlencode($name).'='.urlencode($value).'&';
        }
        $encoded = substr($encoded, -1);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, (bool)$encoded);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt_array($curl, $additionalCurlOpt);
        $response = curl_exec($curl);
        if (!$response) {
            throw new \Exception('curl error: ' . curl_error($curl));
        }
        curl_close($curl);

        return [
            'result' => $response,
        ];
    }
}
