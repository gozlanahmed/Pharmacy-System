<?php 	

require_once 'core.php';


//$valid['success'] = array('success' => false, 'messages' => array());

//$categoriesId = $_POST['categoriesId'];
$categoriesId = $_GET['id'];
if($categoriesId) { 

 $sql = "DELETE FROM categories WHERE categories_id = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";
	header('location:../categories.php');		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST