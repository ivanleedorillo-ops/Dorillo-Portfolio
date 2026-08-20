<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect input data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Check if fields are empty
    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('Please fill out all fields.'); window.history.back();</script>";
        exit;
    }

    // Recipient email (your email)
    $recipient = "ivanleedorillo@gmail.com";
    $subject = "New Portfolio Inquiry from $name";

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Success
        echo "<script>alert('Thank you! Your message has been sent successfully.'); window.location.href = 'index.html';</script>";
    } else {
        // Failure
        echo "<script>alert('Oops! Something went wrong and we couldn\'t send your message.'); window.history.back();</script>";
    }
} else {
    // Not a POST request
    header("Location: index.html");
    exit;
}
?>
