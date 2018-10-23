<?php

$this->params['profile']['fullName']
    = $profile->first_name . ' ' . $profile->last_name;

$this->params['profile']['image'] = $profile->image ?: '10_man.jpg';
$this->params['profile']['spec'] = $profile->specialization ?: 'Web developer';
$this->params['profile']['id'] = $profile->id ?: 'Not set';
