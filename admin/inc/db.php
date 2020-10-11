<?php
$db['db_host'] = 'localhost';
$db['db_user'] = 'blungzzh';
$db['db_pass'] = '31VZD2PffZQE';
$db['db_name'] = 'blungzzh_crimereport';

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


if(! $con ) {
    die('Could not connect: ' . mysqli_error());
}
?>