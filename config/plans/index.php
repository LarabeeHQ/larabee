<?php

require_once('dev.php');
require_once('prod.php');

return config('app.env') == 'local' ? $plansDev : $plansProd;
