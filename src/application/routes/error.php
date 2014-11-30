<?php

$app->error(function (\Exception $e) use ($app) {
    error_log(sprintf('%s on line %d of %s', $e->getMessage(), $e->getLine(), $e->getFile()));
    $app->render('layouts/master', array(
        'partial' => 'errors/index',
        'error' => $e
    ));
});
