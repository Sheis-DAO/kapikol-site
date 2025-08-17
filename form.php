<?php
/**
 * Contact Form Handler for Kapikol
 * Processes form submissions from the contact page
 */

// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set JSON response header
header('Content-Type: application/json');

// CORS headers (adjust origin as needed)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Configuration
$config = [
    'recipient_email' => 'hello@kapikol.io', // Change to your email
    'subject_prefix' => '[Kapikol Contact Form]',
    'success_message' => 'Thank you for contacting Kapikol! We\'ll get back to you soon.',
    'error_message' => 'Sorry, there was an error processing your request. Please try again.'
];

// Initialize response
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method';
    echo json_encode($response);
    exit;
}

// Get form data
$formType = isset($_POST['type']) ? $_POST['type'] : 'feedback';

// Validate and sanitize input based on form type
if ($formType === 'feedback') {
    // Contact form fields
    $name = isset($_POST['feedbackName']) ? trim($_POST['feedbackName']) : '';
    $email = isset($_POST['feedbackEmail']) ? trim($_POST['feedbackEmail']) : '';
    $subject = isset($_POST['feedbackSubject']) ? trim($_POST['feedbackSubject']) : '';
    $message = isset($_POST['feedbackMessage']) ? trim($_POST['feedbackMessage']) : '';
    
    // Validation
    if (empty($name)) {
        $response['errors']['name'] = 'Name is required';
    }
    
    if (empty($email)) {
        $response['errors']['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors']['email'] = 'Invalid email address';
    }
    
    if (empty($subject)) {
        $response['errors']['subject'] = 'Please select a subject';
    }
    
    if (empty($message)) {
        $response['errors']['message'] = 'Message is required';
    }
    
    // If validation passes, prepare email
    if (empty($response['errors'])) {
        // Map subject values to readable text
        $subjectMap = [
            'creator' => 'Creator Token Launch Inquiry',
            'brand' => 'Brand Partnership Inquiry',
            'investor' => 'Investment Opportunity Inquiry',
            'general' => 'General Inquiry'
        ];
        
        $emailSubject = $config['subject_prefix'] . ' ' . 
                       (isset($subjectMap[$subject]) ? $subjectMap[$subject] : 'Contact Form Submission');
        
        // Prepare email content
        $emailBody = "New contact form submission from Kapikol website:\n\n";
        $emailBody .= "Name: $name\n";
        $emailBody .= "Email: $email\n";
        $emailBody .= "Interest: " . (isset($subjectMap[$subject]) ? $subjectMap[$subject] : $subject) . "\n";
        $emailBody .= "Message:\n$message\n\n";
        $emailBody .= "---\n";
        $emailBody .= "Sent from: " . $_SERVER['HTTP_HOST'] . "\n";
        $emailBody .= "Time: " . date('Y-m-d H:i:s') . "\n";
        
        // Email headers
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Send email
        if (mail($config['recipient_email'], $emailSubject, $emailBody, $headers)) {
            $response['success'] = true;
            $response['message'] = $config['success_message'];
            
            // Send auto-response to user
            $autoResponseSubject = "Thank you for contacting Kapikol";
            $autoResponseBody = "Dear $name,\n\n";
            $autoResponseBody .= "Thank you for reaching out to Kapikol. We have received your message and will get back to you shortly.\n\n";
            $autoResponseBody .= "Your inquiry details:\n";
            $autoResponseBody .= "Interest: " . (isset($subjectMap[$subject]) ? $subjectMap[$subject] : $subject) . "\n";
            $autoResponseBody .= "Message: $message\n\n";
            $autoResponseBody .= "Best regards,\n";
            $autoResponseBody .= "The Kapikol Team\n\n";
            $autoResponseBody .= "---\n";
            $autoResponseBody .= "This is an automated response. Please do not reply to this email.";
            
            $autoResponseHeaders = "From: Kapikol <noreply@kapikol.io>\r\n";
            $autoResponseHeaders .= "Reply-To: hello@kapikol.io\r\n";
            
            mail($email, $autoResponseSubject, $autoResponseBody, $autoResponseHeaders);
        } else {
            $response['message'] = $config['error_message'];
        }
    } else {
        $response['message'] = 'Please fix the errors and try again';
    }
} elseif ($formType === 'newsletter') {
    // Newsletter signup
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    
    if (empty($email)) {
        $response['errors']['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors']['email'] = 'Invalid email address';
    }
    
    if (empty($response['errors'])) {
        // Process newsletter signup
        $emailSubject = $config['subject_prefix'] . ' Newsletter Signup';
        $emailBody = "New newsletter signup:\n\n";
        $emailBody .= "Email: $email\n";
        $emailBody .= "Time: " . date('Y-m-d H:i:s') . "\n";
        
        $headers = "From: Kapikol Newsletter <noreply@kapikol.io>\r\n";
        
        if (mail($config['recipient_email'], $emailSubject, $emailBody, $headers)) {
            $response['success'] = true;
            $response['message'] = 'Thank you for subscribing to Kapikol updates!';
            
            // Send welcome email
            $welcomeSubject = "Welcome to Kapikol - Early Access Confirmed";
            $welcomeBody = "Welcome to the Kapikol community!\n\n";
            $welcomeBody .= "Thank you for signing up for early access. You'll be among the first to know about:\n";
            $welcomeBody .= "- Platform launches and updates\n";
            $welcomeBody .= "- Creator success stories\n";
            $welcomeBody .= "- Exclusive events and workshops\n";
            $welcomeBody .= "- Token launch opportunities\n\n";
            $welcomeBody .= "Stay tuned for exciting updates!\n\n";
            $welcomeBody .= "Best regards,\n";
            $welcomeBody .= "The Kapikol Team";
            
            $welcomeHeaders = "From: Kapikol <hello@kapikol.io>\r\n";
            
            mail($email, $welcomeSubject, $welcomeBody, $welcomeHeaders);
        } else {
            $response['message'] = 'Sorry, there was an error. Please try again.';
        }
    } else {
        $response['message'] = 'Please enter a valid email address';
    }
} else {
    $response['message'] = 'Invalid form type';
}

// Return JSON response
echo json_encode($response);

// Optional: Log form submissions
if ($response['success']) {
    $logFile = 'form_submissions.log';
    $logEntry = date('Y-m-d H:i:s') . " - ";
    $logEntry .= "Type: $formType - ";
    if ($formType === 'feedback') {
        $logEntry .= "Name: $name, Email: $email, Subject: $subject";
    } else {
        $logEntry .= "Email: $email";
    }
    $logEntry .= "\n";
    
    // Uncomment to enable logging
    // file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}
?>