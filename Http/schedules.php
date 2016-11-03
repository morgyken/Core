<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$schedule->command('backup:clean')->daily();
$schedule->command('backup:run --only-db')->daily();
