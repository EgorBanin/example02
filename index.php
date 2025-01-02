<?php declare(strict_types=1);

require 'vendor/autoload.php';

$app = \application\Cli::init($argv);
$app->run();
