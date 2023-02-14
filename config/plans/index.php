<?php

$plansDev = include 'dev.php';
$plansProd = include 'prod.php';

return config('app.env') == 'local' ? $plansDev : $plansProd;
