<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace
    $fullname = strip_tags(trim($_POST["fullname"]));
    $fullname = str_replace(array("\r","\n"),array(" "," "),$fullname);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    // Check for empty fields
    if (empty($fullname) || empty($email)) {
        http_response_code(400);
        echo "Please fill out all required fields.";
        exit;
    }

    // Set the recipient email address
    $recipient = "marconi@vwm.com"; // Replace with your email address

    // Set the email subject
    $subject = "New contact form submission from $fullname";

    // Build the email content
    $email_content = "Name: $fullname\n";
    $email_content .= "Email: $email\n\n";

    // Build the email headers
    $email_headers = "From: $fullname <$email>";

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
