<?php

echo "Current file = " . $_SERVER['PHP_SELF'] . "<br/>\n";
echo "Current folder with leading separator = " . dirname(urldecode($_SERVER['PHP_SELF'])) . "<br/>\n";
echo "Current folder = " . basename(dirname(__FILE__)) . "<br/>\n";
echo "Real Path = " . realpath(dirname(__FILE__)) . "<br/>\n";
echo "Full path to current folder = " . dirname(__FILE__) . "<br/>\n";
echo "One level up folder = " . basename(dirname(__DIR__)) . "<br/>\n";
echo "Path to this folder = " . basename(dirname(__DIR__)) ."\\". basename(dirname(__FILE__)) . "<br/>\n";

?>