<?php
//$str = "password";

//$h = password_hash($str, PASSWORD_DEFAULT);
//$h2 = password_hash($str, PASSWORD_DEFAULT);

//echo "$h x $h2";

//if( password_verify($str,$h)) {echo 2;} else {echo 3;};
//echo 1111;
if( password_verify('oi@12345','$2y$10$f8R/9XKhaP4XGZg0IjbdH.9QA6h.8qsXqX0ITNPY6JG1Q7glm/S1y')) {echo 2;} else {echo 3;};

?>