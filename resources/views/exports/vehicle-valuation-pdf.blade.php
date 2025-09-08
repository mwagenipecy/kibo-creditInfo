<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Valuation Report - {{ $generatedAt }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .vehicle-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .vehicle-details h2 {
            color: #495057;
            margin-top: 0;
        }
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }
        .detail-item {
            padding: 10px;
            background: white;
            border-radius: 4px;
            border-left: 4px solid #007bff;
        }
        .detail-label {
            font-weight: bold;
            color: #495057;
            font-size: 14px;
        }
        .detail-value {
            font-size: 16px;
            color: #212529;
        }
        .valuation-results {
            margin-top: 30px;
        }
        .valuation-results h2 {
            color: #28a745;
            border-bottom: 2px solid #28a745;
            padding-bottom: 10px;
        }
        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .result-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .result-label {
            font-weight: bold;
            color: #495057;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .result-value {
            font-size: 18px;
            color: #212529;
        }
        .total-value {
            background: #d1ecf1 !important;
            border-color: #bee5eb !important;
        }
        .total-value .result-value {
            color: #0c5460;
            font-weight: bold;
            font-size: 20px;
        }
        .summary {
            margin-top: 30px;
            padding: 20px;
            background: #e8f5e8;
            border-radius: 8px;
            border: 2px solid #28a745;
        }
        .summary h3 {
            color: #155724;
            margin-top: 0;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }
        .summary-item {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border: 1px solid #c3e6cb;
        }
        .summary-label {
            font-size: 14px;
            color: #155724;
            font-weight: bold;
        }
        .summary-value {
            font-size: 24px;
            color: #155724;
            font-weight: bold;
            margin-top: 5px;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            color: #6c757d;
            font-size: 12px;
        }
        .disclaimer {
            margin-top: 30px;
            padding: 15px;
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
        }
        .disclaimer h4 {
            color: #856404;
            margin-top: 0;
        }
        .disclaimer ul {
            color: #856404;
            margin: 10px 0;
        }
        @media print {
            body { margin: 0; }
            .header { page-break-after: avoid; }
            .valuation-results { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Tanzania Vehicle Valuation Report</h1>
        <p>Official Vehicle Tax Calculation from Tanzania Revenue Authority (TRA)</p>
        <p>Generated on: {{ $generatedAt }}</p>
        <p>Powered by KiboAuto</p>
    </div>

    <div class="vehicle-details">
        <h2>Vehicle Information</h2>
        <div class="details-grid">
            <div class="detail-item">
                <div class="detail-label">Make</div>
                <div class="detail-value">{{ $selectedMake }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Model</div>
                <div class="detail-value">{{ $selectedModel }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Year of Manufacture</div>
                <div class="detail-value">{{ $selectedYear }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Country of Origin</div>
                <div class="detail-value">{{ $selectedCountry }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Fuel Type</div>
                <div class="detail-value">{{ $selectedFuelType }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Engine Capacity</div>
                <div class="detail-value">{{ $selectedEngine }}</div>
            </div>
        </div>
    </div>

    <div class="valuation-results">
        <h2>Valuation Results</h2>
        <div class="results-grid">
            @foreach($valuationResult as $label => $value)
                <div class="result-item {{ str_contains(strtolower($label), 'total') ? 'total-value' : '' }}">
                    <div class="result-label">{{ $label }}</div>
                    <div class="result-value">{{ $value }}</div>
                </div>
            @endforeach
        </div>
    </div>

    @if(isset($valuationResult['Customs Value CIF (USD)']) || isset($valuationResult['TOTAL TAXES (TSHS)']))
        <div class="summary">
            <h3>Summary</h3>
            <div class="summary-grid">
                @if(isset($valuationResult['Customs Value CIF (USD)']))
                    <div class="summary-item">
                        <div class="summary-label">Vehicle Value</div>
                        <div class="summary-value">${{ $valuationResult['Customs Value CIF (USD)'] }}</div>
                    </div>
                @endif

                @if(isset($valuationResult['Total Import Taxes (USD)']))
                    <div class="summary-item">
                        <div class="summary-label">Import Taxes</div>
                        <div class="summary-value">${{ $valuationResult['Total Import Taxes (USD)'] }}</div>
                    </div>
                @endif

                @if(isset($valuationResult['TOTAL TAXES (TSHS)']))
                    <div class="summary-item">
                        <div class="summary-label">Total Taxes (TSHS)</div>
                        <div class="summary-value">{{ $valuationResult['TOTAL TAXES (TSHS)'] }}</div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="disclaimer">
        <h4>Important Disclaimer</h4>
        <ul>
            <li>This valuation is generated from the Tanzania Revenue Authority (TRA) official system</li>
            <li>All tax calculations are based on current TRA rates and regulations</li>
            <li>Values are provided in both USD and Tanzanian Shillings (TSHS)</li>
            <li>Results include import duty, VAT, excise duty, and other applicable fees</li>
            <li>For official documentation and final clearance, please visit TRA offices</li>
            <li>This report is for informational purposes and should be verified with TRA</li>
        </ul>
    </div>

    <div class="footer">
        <p>This report was generated by KiboAuto Vehicle Valuation System</p>
        <p>For more information, visit our website or contact our support team</p>
        <p>© {{ date('Y') }} KiboAuto. All rights reserved.</p>
    </div>
</body>
</html>
