<?php

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/auth.php';

logoutUser();
setFlash('info', 'You have been logged out.');
redirect('login.php');


