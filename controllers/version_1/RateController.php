<?php

namespace controllers\version_1;


use app\LoggedController;
use models\enum\outside_api\cryptonator\Currencies;
use models\outside_api\cryptonator\Cryptonator;

/**
 * Class RateController
 * @package controllers\version_1
 */
class RateController extends LoggedController
{
    /**
     * @throws \Exception
     */
    public function getBTCRate()
    {
        $this->response
            ->response(
                Cryptonator::getCurrencyRate(
                    Currencies::BITCOIN,
                    Currencies::UKRAINIAN_HRYVNIA
                )
            );
    }
}
