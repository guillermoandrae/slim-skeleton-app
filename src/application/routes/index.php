<?php

$app->get('/', function () use ($app) {
    $app->render('layouts/master.phtml', array(
        'partial' => 'index/index'
    ));
});
