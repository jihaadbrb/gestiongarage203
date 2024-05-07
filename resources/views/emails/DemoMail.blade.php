<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $mailData['title'] }}</title>
    <style>
        /* Email styling (optional) */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #666;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            color: #007bff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @if ($mailData['title'] === 'Repair Completed Notification')  
        <h1>Repair Completed Notification</h1>
        <p>Dear valued customer,</p>
        <p>We're pleased to inform you that the repair associated with your account has been successfully completed.</p>
        <p><strong>Repair Details:</strong></p>
        <ul>
            <li>Description: {{ $mailData['description'] }}</li>
            <li>Date Completed: {{ $mailData['dateCompleted'] }}</li>
        </ul>
        <p>We hope that you're satisfied with the service provided. If you have any feedback or queries, please don't hesitate to contact us.</p>
        <p>As a token of appreciation, we're offering a 10% discount on your next service booking. Use code REPAIR10 at checkout.</p>
        <p>Thank you for choosing our service.</p>
        <p>Best regards,</p>
        <p>reda elklie</p>
    @else
        <h1>{{ $mailData['subject'] }}</h1>
        <p>Hello ,</p>
    
        <p> {{ $mailData['message'] }}</p>
        <p>Best regards,</p>
        <p>reda elklie</p>
    @endif
</body>
</html>
    