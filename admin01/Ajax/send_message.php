<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Adjust paths to PHPMailer files
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Retrieve the JSON data from the AJAX request
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

$userId = $data['userId'];
$email = $data['email'];
$fullname = $data['fullname'];
$message = $data['message'];

// Create an instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'agrilearn05@gmail.com'; // Your Gmail address
    $mail->Password   = 'rzry suhm qove fhro'; // Your App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('agrilearn05@gmail.com', 'Agri Learn');
    $mail->addAddress($email, $fullname);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Message from Instructor Page';
    $mail->Body    = $message;

    $mail->send();
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
