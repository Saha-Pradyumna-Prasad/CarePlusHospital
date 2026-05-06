<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            padding: 20px;
            line-height: 1.5;
            background-color: #fff;
            color: #333;
        }
        
        /* Main container */
        .report-container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        .hospital-name {
            font-size: 22px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .hospital-tagline {
            font-size: 12px;
            color: #7f8c8d;
            margin-top: 5px;
        }
        
        .report-title {
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
            color: #3498db;
            text-align: center;
        }
        
        .patient-info {
            background: #f8f9fa;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #e9ecef;
            font-size: 14px;
        }
        
        .patient-info strong {
            display: inline-block;
            min-width: 100px;
        }
        
        .patient-info .info-row {
            margin-bottom: 5px;
        }
        
        .report-content {
            line-height: 1.6;
            margin: 20px 0;
            font-size: 14px;
            text-align: justify;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        /* Print styles */
        @media print {
            body {
                padding: 0;
                margin: 0;
                font-size: 12px;
            }
            
            .header {
                margin-bottom: 20px;
                padding-bottom: 10px;
            }
            
            .hospital-name {
                font-size: 18px;
            }
            
            .report-title {
                font-size: 16px;
                margin: 15px 0;
            }
            
            .patient-info {
                padding: 10px;
                font-size: 12px;
                background: #f8f9fa;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            
            .report-content {
                font-size: 12px;
                line-height: 1.5;
            }
            
            .footer {
                margin-top: 30px;
                font-size: 10px;
                position: fixed;
                bottom: 0;
                width: 100%;
            }
        }
        
        /* Responsive styles for screen viewing */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .hospital-name {
                font-size: 18px;
            }
            
            .report-title {
                font-size: 16px;
            }
            
            .patient-info {
                padding: 10px;
                font-size: 13px;
            }
            
            .patient-info strong {
                min-width: 85px;
            }
            
            .report-content {
                font-size: 13px;
            }
        }
        
        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            
            .hospital-name {
                font-size: 16px;
            }
            
            .hospital-tagline {
                font-size: 10px;
            }
            
            .report-title {
                font-size: 14px;
                margin: 15px 0;
            }
            
            .patient-info {
                padding: 8px;
                font-size: 12px;
            }
            
            .patient-info strong {
                min-width: 75px;
                display: block;
                margin-bottom: 2px;
            }
            
            .patient-info .info-row {
                margin-bottom: 8px;
            }
            
            .report-content {
                font-size: 12px;
                line-height: 1.5;
            }
            
            .footer {
                font-size: 9px;
                margin-top: 30px;
            }
        }
        
        /* Ensure proper break word for long content */
        .report-content p {
            margin-bottom: 10px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        /* Print optimization for tables if any in content */
        .report-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: inherit;
        }
        
        .report-content table td,
        .report-content table th {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
            word-wrap: break-word;
        }
        
        @media print {
            .report-content table td,
            .report-content table th {
                border: 1px solid #999;
            }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="header">
            <div class="hospital-name">City Care Hospital</div>
            <div class="hospital-tagline">Your Health, Our Priority</div>
        </div>
        
        <div class="report-title">{{ $report->title }}</div>
        
        <div class="patient-info">
            <div class="info-row"><strong>Patient Information:</strong></div>
            <div class="info-row"><strong>Name:</strong> {{ $patient->name }}</div>
            <div class="info-row"><strong>Age:</strong> {{ $patient->age }}</div>
            <div class="info-row"><strong>Gender:</strong> {{ ucfirst($patient->gender) }}</div>
            <div class="info-row"><strong>Report Date:</strong> {{ $report->created_at->format('F d, Y') }}</div>
        </div>
        
        <div class="report-content">
            {!! nl2br(e($report->content)) !!}
        </div>
        
        <div class="footer">
            Generated on {{ now()->format('F d, Y H:i:s') }}<br>
            This is a computer-generated report. No signature is required.
        </div>
    </div>
</body>
</html>