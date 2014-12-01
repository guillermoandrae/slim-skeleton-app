<?php

$app->error(function (\Exception $e) use ($app) {
    error_log(sprintf('%s on line %d of %s', $e->getMessage(), $e->getLine(), $e->getFile()));
    $app->render('layouts/master.phtml', array(
        'partial' => 'errors/index',
        'error' => $e
    ));
});

$app->notFound(function () use ($app) {
    $app->render('layouts/master.phtml', array(
        'partial' => 'errors/index',
        'error' => new \Exception('Page not found')
    ));
});
