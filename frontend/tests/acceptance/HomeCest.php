<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        // $I->amOnPage(Url::toRoute('/site/index'));
        $I->amOnPage('/site/index');
        $I->see('D`task tracker');
        $I->see('Wellcome to D`task tracker!');

        $I->seeInPageSource(
            [
                'css' =>
                    '<div class="pull-left image"><img src="/img/users/10_man.jpg" class="img-circle" alt="User Image"></div>',
            ]
        );
        $I->seeInPageSource(
            '<div class="pull-left info">
                <p>Guest</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>'
        );

        $I->seeInPageSource(
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">                       
                <img src="/img/users/10_man.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs">Guest</span>
            </a>'
        );

        $I->dontSeeElement(['css' => 'ul.dropdown-menu']);

        $I->see('Guest', '/html/body/div[1]/header/nav/div/ul/li[4]/a/span');
        // $I->click('body > div.wrapper > header > nav > div > ul > li.dropdown.user.user-menu > a');
        $I->click(['css' => 'header > nav > div > ul > li.dropdown.user.user-menu > a']);
        // $I->click('/html/body/div[1]/header/nav/div/ul/li[4]/a');
        $I->wait(3);

        $I->canSee('/html/body/div[1]/header/nav/div/ul/li[4]/ul/li[1]/img');
        $I->canSee('/html/body/div[1]/header/nav/div/ul/li[4]/ul/li[1]/p/text("Guest")');
        $I->seeLink('Signup', '/html/body/div[1]/header/nav/div/ul/li[4]/ul/li[2]/div[1]/a');
        $I->seeLink('Login', '/html/body/div[1]/header/nav/div/ul/li[4]/ul/li[2]/div[2]/a');

        $I->click('/html/body/div[1]/header/nav/div/ul/li[4]/a');
        $I-canSeeElement(['css' => 'ul.dropdown-menu']);
        $I->cantSee('Signup', '/html/body/div[1]/header/nav/div/ul/li[4]/ul/li[2]/div[1]/a');
        $I->cantSee('Login', '/html/body/div[1]/header/nav/div/ul/li[4]/ul/li[2]/div[2]/a');
        $I->wait(3);

        $I->seeLink('About');
        $I->click('About');
        $I->wait(3); // wait for page to be opened

        $I->see('About');
    }
}
