<?php
// Datenstrom Yellow, https://github.com/datenstrom/yellow

require __DIR__ . '/vendor/autoload.php';

require("system/extensions/core.php");

if (PHP_SAPI!="cli") {
    $yellow = new YellowCore();
    $yellow->load();
    $yellow->request();
} else {
    $yellow = new YellowCore();
    $yellow->load();
    exit($yellow->command());
}
