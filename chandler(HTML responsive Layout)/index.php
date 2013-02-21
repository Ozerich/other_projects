<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

require_once "header.php";

require_once "pages/" . $page . ".php";

require_once "footer.php";

?>