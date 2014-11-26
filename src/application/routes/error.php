<?php
/**
 * This file is part of the Releng Portal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$app->error(function (\Exception $e) use ($app) {
    error_log(sprintf('%s on line %d of %s', $e->getMessage(), $e->getLine(), $e->getFile()));
    $app->render('layouts/master', array(
        'partial' => 'errors/index',
        'error' => $e
    ));
});
