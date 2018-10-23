<?php
namespace frontend\tests\unit\models;

use common\fixtures\UsersProfileFixture;

class UsersProfileFixtureTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    public $profile;

    protected function _before()
    {
        $this->tester->haveFixtures(
            [
                'profile' => [
                    'class' => UsersProfileFixture::class,
                    'dataFile' => codecept_data_dir() . 'profiles.php',
                ],
            ]
        );
    }

    protected function _after()
    {
    }

    // tests
    public function testAttributesValue()
    {
        $profile = $this->tester->grabFixture('profile', 0);

        $this->assertEquals($profile->user_id, 7);
        $this->assertEquals($profile->first_name, 'David');
        $this->assertEquals($profile->last_name, 'Dowton');
        $this->assertEquals($profile->specialization, 'Web');
        $this->assertEquals($profile->sex, 1);
        $this->assertEquals($profile->birthday, '1981-01-01');
        $this->assertEquals($profile->phone, '+7-986-100-10-10');
        $this->assertEquals($profile->image, '1_man.jpg');
        $this->assertEquals($profile->country, 'RU');
        $this->assertEquals($profile->status, 10);
        $this->assertEquals($profile->created_at, '2018-07-05 09:51:10');
        $this->assertEquals($profile->updated_at, '2018-07-05 09:52:10');
    }

    public function testSomeDefaultValues()
    {
        $profile = $this->tester->grabFixture('profile', 1);

        $this->assertEquals($profile->user_id, 8);
        $this->assertEquals($profile->sex, 1);
        $this->assertEquals($profile->country, 'Russia');
        $this->assertEquals($profile->status, 10);
    }

    public function testAllDefaultValues()
    {
        $profile = $this->tester->grabFixture('profile', 2);

        $this->assertEquals($profile->user_id, 9);
        $this->assertNull($profile->first_name);
        $this->assertNull($profile->last_name);
        $this->assertNull($profile->specialization);
        $this->assertEquals($profile->sex, 1);
        $this->assertNull($profile->birthday);
        $this->assertNull($profile->phone);
        $this->assertNull($profile->image);
        $this->assertEquals($profile->country, 'Russia');
        $this->assertEquals($profile->status, 10);
        $this->assertContains($profile->created_at, '2018-07-06 09:51:10');
        $this->assertNull($profile->updated_at);
    }
}
