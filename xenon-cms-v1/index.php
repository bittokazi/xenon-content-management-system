<?php
ob_start();
//initialize core
require('frndzk.php');
include('xenon-core.php');
incliude_directory_root();
include('xenon-rpc.php');
execute_xenon_addons();
execute_xenon_themef();
xenon_search_action();
call_theme();
ob_flush();
?>