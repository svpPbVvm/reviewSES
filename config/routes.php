<?php

use \models\enum\ses_api\APIVersionsEnum;

return [
    '/user/create' => [
        'controller' => 'Users',
        'action' => 'createUser',
        'version' => [APIVersionsEnum::VERSION_1],
    ],
    '/user/login' => [
        'controller' => 'Users',
        'action' => 'loginUser',
        'version' => [APIVersionsEnum::VERSION_1],
    ],
    '/btcRate' => [
        'controller' => 'Rate',
        'action' => 'getBTCRate',
        'version' => [APIVersionsEnum::VERSION_1],
    ],
];