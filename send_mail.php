<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'thisarujayawickrama@gmail.com'; 
        $mail->Password   = 'uwbeivvkmrcsgqcr'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($email,);
        $mail->addAddress('thisarujayawickrama@gmail.com', 'The Gallery Café'); // Replace with your receiving email

        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Submission';
        $mail->Body    = "<p><strong>Email:</strong> $email</p>
                          <p><strong>Message:</strong><br>$message</p>";

        $mail->send();
        echo "<script>
              alert('Message sent successfully.');
              window.location.href = 'index.php';
              </script>";
            } catch (Exception $e) {
                echo "<script>
                    alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                    window.location.href = 'index.php';
                </script>";
            }
            
} else {
    echo "Invalid request method.";
}
?>
