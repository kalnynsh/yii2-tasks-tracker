<?php
namespace frontend\tests\unit\models;

use common\models\users_profile\UsersProfile;

class UsersProfileTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    public $profile;

    protected function _before()
    {
        $this->profile = new UsersProfile();
        $this->profile->attributes =
        [
            'user_id' => 7,
            'first_name' => 'David',
            'last_name' => 'Dowton',
            'specialization' => 'Web',
            'sex' => 1,
            'birthday' => '1981-01-01',
            'phone' => '+7-986-100-10-10',
            'image' => '1_man.jpg',
            'country' => 'RU',
            'created_at' => '2018-07-05 09:51:10',
            'updated_at' => '2018-07-05 09:52:10',
        ];
    }

    protected function _after()
    {
        $this->profile = null;
    }

    // tests
    public function testAttributesValue()
    {
        $this->assertEquals($this->profile->user_id, 7);
        $this->assertEquals($this->profile->first_name, 'David');
        $this->assertEquals($this->profile->last_name, 'Dowton');
        $this->assertEquals($this->profile->specialization, 'Web');
        $this->assertEquals($this->profile->sex, 1);
        $this->assertEquals($this->profile->birthday, '1981-01-01');
        $this->assertEquals($this->profile->phone, '+7-986-100-10-10');
        $this->assertEquals($this->profile->image, '1_man.jpg');
        $this->assertEquals($this->profile->country, 'RU');
        $this->assertEquals($this->profile->created_at, '2018-07-05 09:51:10');
        $this->assertEquals($this->profile->updated_at, '2018-07-05 09:52:10');
    }
}
