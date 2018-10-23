<?php

namespace v1\tests\api;

use \frontend\modules\v1\tests\ApiTester;

class HomeCest
{
    public function mainPage(ApiTester $I)
    {
        $I->sendGET('/v1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}
