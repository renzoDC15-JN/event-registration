<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
        body {
            font-family: Arial, sans-serif;
            color: #000000;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
            background-color: #ffffff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #000000;
            margin-top: 0;
            margin-bottom: 1rem;
        }
        p {
            margin-top: 3rem;
            line-height: 2.5rem;
            color: #4a5568;
        }
        .code-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
            justify-content: center;
            margin-top: 3rem;
            min-width: 300px;
            font-size: 2.25rem;
            font-weight: bold;
            color: #2D3748;
            width:300px;
        }
        .code-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 54px;
            margin-right: 0.5rem;
        }
        .code {
            display: flex;
            align-items: center;
            justify-content: center;
            /*background-color: #FFEDD5;*/
            /*border-radius: 1.875rem;*/
            height: 66px;
            width: 66px;
        }
        .last-item {
            margin-right: 0;
        }
        .cta {
            display: inline-block;
            background-color: #3182ce;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
<section class="container">
    <h1>
        Dear {{$attendee->first_name}},
    </h1>
    <p>
        We are excited to welcome you to our upcoming event! Below, you will find your unique check-in code:
        <br />
        Check-In Code:
    </p>
    <div id="verification_code" class="code-container">
        <div class="code-item">
            <div class="code" tabindex="0" role="button">{{$attendee->attendee_code[0]}}</div>
        </div>
        <div class="code-item">
            <div class="code" tabindex="0" role="button">{{$attendee->attendee_code[1]}}</div>
        </div>
        <div class="code-item">
            <div class="code" tabindex="0" role="button">{{$attendee->attendee_code[2]}}</div>
        </div>
        <div class="code-item last-item">
            <div class="code" tabindex="0" role="button">{{$attendee->attendee_code[3]}}</div>
        </div>
    </div>
    <p>
        Please use this code to check in at the event.
        <br />
        We look forward to seeing you there!
        <br />
        Best regards,
        <br />
        <strong>Raemulan Lands Inc.</strong>
    </p>
</section>
</body>
</html>
