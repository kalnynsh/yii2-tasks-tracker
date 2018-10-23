<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function loginSuccessfullyTest(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));

        $I->click('Login');

        $I->fillField('username', 'david');
        $I->fillField('password', 'qwerty');

        $I->click('Sign in');
        // $I->see('Hello, david');
        // $I->seeInCurrentUrl('/');
    }
}
