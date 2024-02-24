<?php
session_start();
require_once(__DIR__ . '/fonctions.php');
session_unset();
session_destroy();
redirectToUrl('index.php');