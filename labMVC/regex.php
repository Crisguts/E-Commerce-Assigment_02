<?php

// '.' signifies the place of ONE character
echo preg_match('/H.T/','HAT') . "<br>"; //true
echo preg_match('/H.T/','HaT') . "<br>"; //true
echo preg_match('/H.T/','HaaT') . "<br>"; //false

// ^ means start with a c
echo preg_match('/^e+/','peak') . "<br>"; //true


//teacher code
echo preg_match('/H.T/', "HaT"); // ->TRUE
echo "</br>";
echo preg_match('/H.T/', "HaaT");// -> False because the dot '.' designate only one single character
echo "</br>";
echo preg_match('/^e+/', "pak");
