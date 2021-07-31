<?php

namespace controllers\version_1;


use app\Application;
use app\BaseController;
use models\enum\response\ResponseNeededParams;
use models\enum\ses_api\users\CreateUserParams;
use models\enum\ses_api\users\LoginUserParams;
use models\exception\ValidationException;
use models\fileDB\FileManager;
use models\ses_api\Login;
use models\ses_api\Validator;
use models\users\User;
use models\users\Users;

/**
 * Class UsersController
 * @package controllers\version_1
 */
class UsersController extends BaseController
{
    /**
     * @throws \Exception
     */
    public function createUser()
    {
        $requestParams = $this->validateFields(CreateUserParams::class, $_REQUEST);
        Users::addUser(new User(
            $requestParams[CreateUserParams::EMAIL],
            md5($requestParams[CreateUserParams::PASSWORD])
        ));

        $this->response
            ->response([
                ResponseNeededParams::SUCCESS => true,
                ResponseNeededParams::ERROR => '',
            ]);
    }

    /**
     * @throws \Exception
     */
    public function loginUser()
    {
        if (!Application::isLogged()) {
            $requestParams = $this->validateFields(LoginUserParams::class, $_REQUEST);
            (new Login(
                $requestParams[LoginUserParams::EMAIL],
                md5($requestParams[LoginUserParams::PASSWORD])
            ))->login();
        }

        $this->response
            ->response([
                ResponseNeededParams::SUCCESS => true,
                ResponseNeededParams::ERROR => '',
            ]);
    }

    /**
     * @param $neededRequestParamsClass
     * @param array $params
     * @throws \Exception
     */
    private function checkParams(
        $neededRequestParamsClass,
        array $params
    ): void
    {
        foreach ($neededRequestParamsClass::getConstants() as $neededParam) {
            if (!array_key_exists($neededParam, $params))
                $this->response
                    ->setResponseCode(500)
                    ->response([
                        ResponseNeededParams::SUCCESS => false,
                        ResponseNeededParams::ERROR => "Request param \"$neededParam\" is undefined!",
                    ]);
        }
    }

    /**
     * @param $neededRequestParamsClass
     * @param array $params
     * @return array
     * @throws \Exception
     */
    private function validateFields($neededRequestParamsClass, array $params): array
    {
        $this->checkParams($neededRequestParamsClass, $params);
        foreach ($neededRequestParamsClass::getParamsValidatorByTitleList() as $title => $validator) {
            $params[$title] = Validator::validate($validator, $params[$title]);
        }

        return $params;
    }
}
