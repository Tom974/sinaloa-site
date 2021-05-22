<?php
session_start();
session_unset();
session_destroy();

header('location: https://tom974.dev/sinaloa');
exit();