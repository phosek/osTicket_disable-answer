<?php
require('admin.inc.php');
$spojeni = mysqli_connect(DBHOST,DBUSER,DBPASS, "cis_extra"); // Konstanty převzaty ze souboru \include\ost-config.php
$spojeni_ost = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME); // Konstanty převzaty ze souboru \include\ost-config.php

$page='disable-answer.inc.php';
$nav->setTabActive('custom');/*
$ost->addExtraHeader('<meta name="tip-namespace" content="dashboard.system_logs" />',
    "$('#content').data('tipNamespace', 'dashboard.system_logs');");*/
require(STAFFINC_DIR.'header.inc.php');
require(STAFFINC_DIR.$page);
include(STAFFINC_DIR.'footer.inc.php');
?>
