<?php

/* start session safely */

if(session_status() === PHP_SESSION_NONE){
session_start();
}


/* disable caching */

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


/* check login */

if(!isset($_SESSION['admin'])){

header("Location: login.php");
exit();

}


/* prevent back button showing cached page */

echo "
<script>

history.pushState(null, null, location.href);

window.onpopstate = function () {

history.go(1);

};

</script>
";

?>