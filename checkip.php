<?php
echo 'SERVER_ADDR: ' . $_SERVER['SERVER_ADDR'].'<br>';

echo 'REMOTE_ADDR: ' . $_SERVER['REMOTE_ADDR'].'<br>';

echo file_get_contents('https://api.ipify.org').'<br>';

echo file_get_contents('https://checkip.amazonaws.com');