<?php
$ip = $_REQUEST['ip'];
$relay = $_REQUEST['relay'];
$state = $_REQUEST['state'];

$cmd = '/usr/bin/python /var/www/relay.py -i ' . $ip . ' -r ' . $relay . ' -s ' . $state; 
ob_start();
passthru($cmd);
echo ob_get_clean();
?>
