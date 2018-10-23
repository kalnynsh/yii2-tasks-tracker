<?php

namespace frontend\models\default_profile;

use Yii;
use yii\base\Model;

class DefaultProfile extends Model
{
    /**
     * @var string
     */
    public $id;
    
    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $specialization;

    /**
     * @var string
     */
    public $image;

    public function __construct()
    {
        $this->id = Yii::$app->user->getId();
        $this->first_name = 'First name not set';
        $this->last_name = 'Last name not set';
        $this->specialization = 'Specialization not set';
        $this->image = '10_man.jpg';
    }
}
