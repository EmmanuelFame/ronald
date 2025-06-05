<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message - Ronaldcharge</title>
    <style>
        /* Basic reset for email clients */
        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td, div {
            box-sizing: border-box;
        }
        /* Custom styles to match Ronaldcharge theme */
        .email-body {
            font-family: "Inter", sans-serif; /* Consistent font */
            background-color: #0a0a0a; /* Dark background */
            padding: 2rem;
            color: #e2e8f0; /* Light text color */
        }
        .email-container {
            background-color: #1a202c; /* Darker container background */
            border-radius: 12px; /* Rounded corners */
            padding: 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3); /* Subtle shadow */
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #2d3748; /* Subtle border */
        }
        .email-heading {
            color: #60a5fa; /* Blue accent for headings */
            font-size: 1.875rem; /* text-3xl */
            font-weight: 700; /* font-bold */
            margin-bottom: 1.5rem;
        }
        .email-paragraph {
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        .email-strong {
            color: #93c5fd; /* Lighter blue for strong text */
        }
        .email-message-box {
            background-color: #2d3748; /* Slightly lighter background for message */
            border-radius: 8px;
            padding: 1rem;
            white-space: pre-line; /* Preserve line breaks */
            border: 1px solid #4a5568;
        }
        .email-hr {
            margin-top: 2rem;
            margin-bottom: 1.5rem;
            border: 0;
            border-top: 1px solid #4a5568; /* Darker line for separator */
        }
        .email-footer-text {
            font-size: 0.875rem; /* text-sm */
            color: #a0aec0; /* Gray for footer text */
            text-align: center;
        }
    </style>
</head>
<body class="email-body">
    <div class="email-container">
        <h2 class="email-heading">📨 New Contact Form Submission</h2>

        <p class="email-paragraph"><strong class="email-strong">Name:</strong> {{ $data['name'] }}</p>
        <p class="email-paragraph"><strong class="email-strong">Email:</strong> {{ $data['email'] }}</p>
        <p class="email-paragraph"><strong class="email-strong">Message:</strong></p>
        <div class="email-message-box">
            <p>{{ $data['message'] }}</p>
        </div>

        <hr class="email-hr">
        <p class="email-footer-text">This message was sent from Ronaldcharge.</p>
    </div>
</body>
</html>


