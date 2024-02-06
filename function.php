<?php
include('conn.php');
if (isset($_GET['sel']) == 1) {
	$sel = "SELECT * FROM student";
	$run = $conn->query($sel);
	while ($r = $run->fetch_object()) {
		$row[] = $r;
	}
	echo json_encode($row);
	exit();
}


if (isset($_POST['ins']) == 1) {

	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$ins = "INSERT INTO student(name,email,password)VALUES('$name','$email','$password')";
	if ($conn->query($ins)) {
		echo json_encode(['status' => 'success']);
	}
	exit();
}
if (isset($_GET['del']) == 1) {
	$id = $_GET['id'];
	$del = "DELETE  FROM student WHERE id=$id";
	if ($run = $conn->query($del)) {
		echo json_encode(["status", "success"]);
	}


	exit();
}
if (isset($_GET['eid']) == 1) {
	$id = $_GET['id'];
	$del = "SELECT *   FROM student WHERE id=$id";
	$run = $conn->query($del);
	$r = $run->fetch_object();
	echo json_encode($r);
	exit();
}
if (isset($_POST['upd']) == 1) {
	$id = $_POST['uid'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$upd = "UPDATE student SET name = '$name',email='$email',password='$password' WHERE id=$id";
	if ($conn->query($upd)) {
		echo json_encode(['status' => 'success']);
	}
	exit();
}

?>