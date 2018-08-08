<?php

$x=5;
$y=10;

function test(){
$GLOBALS['y']=4;
}

echo $y;
