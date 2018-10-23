<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

echo $this->render('_profile', ['profile' => $profile]);

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

    <p>"A goal without a plan is just a wish" - Antoine de Saint-Exupery</p>
    <p>"By failing to prepare, you are preparing to fail" - Benjamin Franklin</p>
    <p>"Life is what happens to us while we are making other plans" - Allen Saunders</p>
    
</div>
