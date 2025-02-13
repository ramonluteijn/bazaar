<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            max-width: 800px;
            height: calc(100vh - 40px);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 18px;
            color: #666;
        }
        .content {
            flex-grow: 1;
            margin-bottom: 20px;
            line-height: 1.6;
            color: #333;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature .signature_name {
            font-weight: bold;
            min-width: 200px;
            margin-right: 200px;
        }
        .signature p {
            margin: 5px 0;
        }
        .signature hr {
            border: none;
            border-top: 1px solid #333;
            margin: 10px 0;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Contract</h1>
        <p>{{ $contract->title }}</p>
    </div>
    <div class="content">
        <p>{{ $contract->description }}</p>
    </div>
    <div class="signature">
        <p>Signed by: <span class="signature_name">{{ $contract->businessAdvertiser->name ?? ' '}}</span></p>
        <hr>
        <p>Date: {{ $contract->signed_at }}</p>
    </div>
    <div class="footer">
        <p>Contract ID: {{ $contract->id }}</p>
    </div>
</div>
</body>
</html>
