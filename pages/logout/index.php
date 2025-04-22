<?php

use App\Class\Session;

Session::remove('user_id');

header("location: login");
