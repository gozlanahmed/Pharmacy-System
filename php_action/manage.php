<?php
require_once 'core.php'; // Including core functionalities

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
    $title = $_POST['title'];
    $short_title = $_POST['short_title'];
    $footer = $_POST['footer'];
    $currency_code = $_POST['currency_code'];
    $currency_symbol = $_POST['currency_symbol'];

    // Image upload paths
    $target_dir = "./assets/uploadImage/Logo/";

    // Handling website logo upload
    $website_logo = uploadImage('website_image', $target_dir, $_POST['old_website_image']);
    // Handling login logo upload
    $login_logo = uploadImage('login_image', $target_dir, $_POST['old_login_image']);
    // Handling invoice logo upload
    $invoice_logo = uploadImage('invoice_image', $target_dir, $_POST['old_invoice_image']);
    // Handling background login image upload
    $background_login_image = uploadImage('back_login_image', $target_dir, $_POST['old_back_login_image']);

    $sql = "UPDATE `manage_website` SET 
            `title` = '$title', 
            `short_title` = '$short_title', 
            `logo` = '$website_logo', 
            `footer` = '$footer',
            `currency_code` = '$currency_code', 
            `currency_symbol` = '$currency_symbol', 
            `login_logo` = '$login_logo', 
            `invoice_logo` = '$invoice_logo', 
            `background_login_image` = '$background_login_image'";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Updated";
        header('location: manage_website.php');
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while updating the website settings";
    }

    $connect->close();

    echo json_encode($valid);
}

// Function to handle image upload
function uploadImage($input_name, $target_dir, $old_image) {
    if ($_FILES[$input_name]["tmp_name"] != '') {
        $image = $target_dir . basename($_FILES[$input_name]["name"]);
        if (move_uploaded_file($_FILES[$input_name]["tmp_name"], $image)) {
            @unlink($target_dir . $old_image);
            return basename($_FILES[$input_name]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return $old_image;
}
?>
