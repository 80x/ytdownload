<?php

$host="localhost"; /*name server*/
$user="test";/*username*/
$password="12345";/*password*/
$db="youtube";/*database*/

mysql_connect($host, $user, $password); /*Connect */
mysql_select_db($db); /*Connect*/

mysql_error($_SESSION); /*error $_SESSION mysql */

?>
<!-- Created by Sasha Puzikov (www.puzikov.org) -->
