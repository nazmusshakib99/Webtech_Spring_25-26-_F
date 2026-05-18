<?php 

$name="John";

print $name;

echo is_string($name)."<br>";
//  ? "Yes, it's a string" : "No, it's not a string";

function greet(){
    global $name;
    echo " Hello, $name!" ."<br>";
    $age = 30;
    echo " you are $age years old.";

}
greet();
?>