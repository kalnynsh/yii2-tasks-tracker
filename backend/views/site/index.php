<?php

/* @var $this yii\web\View */
$this->params['profile']['fullName']
    = $profile->first_name . ' ' . $profile->last_name;

$this->params['profile']['image'] = $profile->image ?: '10_man.jpg';
$this->params['profile']['spec'] = $profile->specialization ?: 'Web developer';
$this->params['profile']['id'] = $profile->id ?: 'Not set';

$this->title = 'Dtask tracker';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Wellcome to <b>D</b>task tracker!</h1>

        <p class="lead">You have successfully reached to the Planning</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Life is a gift</h2>

                <p>
                When we embrace all that life has to offer,
                we can achieve success ​in both personally and professionally.
                </p>

            </div>
            <div class="col-lg-4">
                <h2>Don’t give up</h2>

                <p>
                Don’t give up. The beginning is always the hardest. Life rewards those who work hard at it.
                </p>

            </div>
            <div class="col-lg-4">
                <h2>Hard work spotlights</h2>

                <p>
                Hard work spotlights the character of people: some turn up their sleeves,
                some turn up their noses, and some don’t turn up at all.
                </p>

            </div>
        </div>

    </div>
</div>
