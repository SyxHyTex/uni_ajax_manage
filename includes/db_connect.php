<?php	#Austin Schaefer
$pword='sXJNwRrMfh';
@ $db = new mysqli('localhost', 'aschaefer', $pword, 'aschaefer');
#Following code used from http://www.php.net/manual/en/mysqli.construct.php, example 1, all credit goes to the author(s).
if ($db->connect_error) {
    die('Connect Error (' . $db->connect_errno . ') '
            . $db->connect_error);
}
?>