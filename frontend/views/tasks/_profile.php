<?php

$this->params['profile']['fullName']
    =  $profile ? $profile->first_name . ' ' . $profile->last_name
        : 'Guest';

$this->params['profile']['image'] = $profile ? $profile->image : '10_man.jpg';
$this->params['profile']['spec'] = $profile ? $profile->specialization : 'Web developer';
$this->params['profile']['id'] = $profile ? $profile->id : 'Not set';
