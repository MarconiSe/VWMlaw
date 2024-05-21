<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace
    $fullname = strip_tags(trim($_POST["fullname"]));
    $fullname = str_replace(array("\r","\n"),array(" "," "),$fullname);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);

    // Check for empty fields
    if (empty($fullname) || empty($email) || empty($message)) {
        http_response_code(400);
        echo "Please fill out all required fields.";
        exit;
    }

    // Set the recipient email address
    $recipient = "maroni@vwm.com";

    // Set the email subject
    $subject = "New contact form submission from $fullname";

    // Build the email content
    $email_content = "Name: $fullname\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Phone: $phone\n\n";
    $email_content .= "Message:\n$message\n";

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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Email information
    $to = "marconi@vwm.com"; // Replace with your email address
    $subject = "New Subscription";
    $message = "Name: $name\nEmail: $email";

    // Send email
    $isSent = mail($to, $subject, $message);

    if ($isSent) {
        header("Location: thank_you.html"); // Replace with the URL of your thank you page
        exit;
    } else {
        echo "Failed to send email. Please try again later.";
    }
}
?>

?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define variables to hold form data and success message
$name = $email = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["fullname"];
    $email = $_POST["email"];

    // Email information
    $to = "marconi@vwm.com"; // Replace with your email address
    $subject = "New Subscription";
    $message = "Name: $name\nEmail: $email";

    // Additional headers
    $headers = "From: Your Name <your_email@example.com>"; // Replace with your name and email

    // Send email using SMTP
    if (mail($to, $subject, $message, $headers)) {
        // Set success message
        $success_message = "Thank you! Your subscription has been successful.";
    } else {
        // Set error message
        $success_message = "Oops! Something went wrong. Please try again later.";
    }
}
?>



