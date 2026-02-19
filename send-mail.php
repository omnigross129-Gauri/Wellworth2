<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';


$fullName    = $_POST['fullName'];
$email   = $_POST['email'];
$phone   = $_POST['phone'];
$message = $_POST['message'];
$formType = $_POST['service'];
// $service =$_POST['service'];

// ===============================
// ADMIN EMAIL CONFIG
// ===============================
$adminEmail = "connect@wellworthfm.com"; // admin mail
$smtpHost   = "smtp.hostinger.com";
$smtpUser   = "connect@wellworthfm.com"; // SMTP email
$smtpPass   = "C0nnecT@"; // Gmail App Password
$smtpPort   = 587;



$mail = new PHPMailer(true);

try {
    // SMTP SETTINGS
    $mail->isSMTP();
    $mail->Host       = "smtp.hostinger.com";
    $mail->SMTPAuth   = true;
    $mail->Username   = "connect@wellworthfm.com";
    $mail->Password   = "C0nnecT@";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $smtpPort;
// ===============================
    // 1️⃣ MAIL TO USER (AUTO REPLY)
    // ===============================

    $mail->clearAllRecipients();
    $mail->setFrom("connect@wellworthfm.com", "Wellworth Facilities Pvt Ltd");
    $mail->addAddress($email, $fullName);
    $mail->addReplyTo("connect@wellworthfm.com", "Wellworth Facilities");

    $mail->isHTML(true);
    $mail->Subject = "We’ve Received Your Request – Wellworth Facilities";

   $mail->Body = "
<div style='margin:0;padding:0;background:#f2f4f8;font-family:Segoe UI,Arial,sans-serif;'>

  <table width='100%' cellpadding='0' cellspacing='0'
    style='max-width:650px;margin:30px auto;background:#ffffff;
    border-radius:10px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.08);'>

    <!-- HEADER -->
    <tr>
      <td style='background:#0b1c39;padding:28px;text-align:center;color:#ffffff;'>
        <h2 style='margin:0;font-size:20px;'>Wellworth Facilities Pvt Ltd</h2>
        <p style='margin:6px 0 0;font-size:13px;color:#cfd6e3;'>
          Compliance-Driven Facility & Workforce Management
        </p>
      </td>
    </tr>

    <!-- BODY -->
    <tr>
      <td style='padding:30px;'>

        <p style='font-size:15px;color:#333;'>Dear <strong>$fullName</strong>,</p>

        <p style='font-size:14px;color:#555;line-height:1.6;'>
          Thank you for contacting <strong>Wellworth Facilities Pvt Ltd</strong>.
          We have successfully received your request.
        </p>

        <!-- DETAILS CARD -->
        <div style='background:#f7f9fc;border-left:4px solid #0b1c39;
          padding:20px;margin:25px 0;border-radius:6px;'>

          <h4 style='margin-top:0;color:#0b1c39;'>Your Submitted Details</h4>

          <p><strong>Full Name:</strong> $fullName</p>
          <p><strong>Email:</strong> $email</p>
          <p><strong>Phone:</strong> $phone</p>
          <p><strong>Service Selected:</strong> $service</p>
          <p><strong>Request Type:</strong> $formType</p>

          <p><strong>Requirement:</strong><br>
          ".nl2br($message)."</p>

        </div>

        <p style='font-size:14px;color:#555;'>
          Our team will connect with you within
          <strong>24 business hours</strong>.
        </p>

        <p style='margin-top:25px;font-size:14px;color:#555;'>
          Regards,<br>
          <strong>Wellworth Facilities Pvt Ltd</strong><br>
          Compliance & Workforce Experts
        </p>

      </td>
    </tr>

    <!-- FOOTER -->
    <tr>
      <td style='background:#f0f2f5;padding:15px;text-align:center;
        font-size:12px;color:#777;'>
        © ".date('Y')." Wellworth Facilities Pvt Ltd
      </td>
    </tr>

  </table>
</div>
";



    $mail->send();



    // ===============================
    // 2️⃣ MAIL TO ADMIN (LEAD ALERT)
    // ===============================

    $mail->clearAllRecipients();
    $mail->setFrom("connect@wellworthfm.com", "Website Lead Alert");
    $mail->addAddress($adminEmail);
    $mail->addReplyTo($email, $fullName);

    $mail->Subject = "New Website Lead – $formType";

   $mail->Body = "
<div style='margin:0;padding:0;background:#f2f4f8;font-family:Segoe UI,Arial,sans-serif;'>

  <table width='100%' cellpadding='0' cellspacing='0'
    style='max-width:650px;margin:30px auto;background:#ffffff;
    border-radius:10px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.08);'>

    <!-- HEADER -->
    <tr>
      <td style='background:#0b1c39;padding:28px;text-align:center;color:#ffffff;'>
        <h2 style='margin:0;font-size:20px;'>New Website Lead</h2>
        <p style='margin:6px 0 0;font-size:13px;color:#cfd6e3;'>
          Wellworth Facilities Pvt Ltd
        </p>
      </td>
    </tr>

    <!-- BODY -->
    <tr>
      <td style='padding:30px;'>

        <div style='background:#f7f9fc;border-left:4px solid #0b1c39;
          padding:18px;margin-bottom:25px;border-radius:6px;'>

          <h4 style='margin-top:0;color:#0b1c39;'>Lead Details</h4>

          <p><strong>Form Type:</strong> $formType</p>
          <p><strong>Name:</strong> $fullName</p>
          <p><strong>Email:</strong> $email</p>
          <p><strong>Phone:</strong> $phone</p>
          <p><strong>Service:</strong> $service</p>
        </div>

        <div style='background:#ffffff;border:1px solid #e3e6ed;
          padding:18px;border-radius:6px;'>

          <h4 style='margin-top:0;color:#0b1c39;'>Client Requirement</h4>
          <p style='margin:0;'>".nl2br($message)."</p>

        </div>

        <p style='margin-top:25px;font-size:13px;color:#777;'>
          This lead was generated from the Wellworth Facilities website.
        </p>

      </td>
    </tr>

    <!-- FOOTER -->
    <tr>
      <td style='background:#f0f2f5;padding:15px;text-align:center;
        font-size:12px;color:#777;'>
        © ".date('Y')." Wellworth Facilities Pvt Ltd
      </td>
    </tr>

  </table>
</div>
";

    $mail->send();


    // ===============================
    // REDIRECT
    // ===============================
    header("Location: thank-you.html");
    exit();

} catch (Exception $e) {
    echo "Mail Error: {$mail->ErrorInfo}";
}

