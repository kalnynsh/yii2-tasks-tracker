<?php

namespace common\models\guest;

class Guest
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
        $this->id = 1000;
        $this->first_name = 'Dear';
        $this->last_name = 'guest';
        $this->specialization = 'Greate promise';
        $this->image = '10_man.jpg';
    }
}
