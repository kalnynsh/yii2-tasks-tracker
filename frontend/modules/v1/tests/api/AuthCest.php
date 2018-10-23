<?php

namespace v1\tests\api;

use \frontend\modules\v1\tests\ApiTester;
use common\fixtures\TokenFixture;
use common\fixtures\UserFixture;

class AuthCest
{
    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'token' => [
                'class' => TokenFixture::className(),
                'dataFile' => codecept_data_dir() . 'token.php'
            ],
        ]);
    }

    public function badMethod(ApiTester $I)
    {
        $I->sendGET('v1/auth');
        $I->seeResponseCodeIs(405);
        $I->seeResponseIsJson();
    }

    public function wrongCredentials(ApiTester $I)
    {
        $I->sendPOST('v1/auth', [
            'username' => 'erau',
            'password' => 'wrong-password',
        ]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseContainsJson([
            'field' => 'password',
            'message' => 'Incorrect username or password.'
        ]);
    }

    public function success(ApiTester $I)
    {
        $I->sendPOST('v1/auth', [
            'username' => 'adlai_ludovici',
            'password' => 'adlai_ludovici',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$.token');
        $I->seeResponseJsonMatchesJsonPath('$.expired');
    }
}
