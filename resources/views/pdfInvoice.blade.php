<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-ZenhVNpHmPQ0oW9R7vZc6iIWkTKN9s7XnYbqpIwxiWDINCAIfwWSnjaXvRVzJqYl8" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .invoice-container {
            background-color: #f2f2f2;
            padding: 30px;
            border-radius: 5px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .company-info {
            text-align: left;
        }

        .company-info h1 {
            margin-bottom: 5px;
        }

        .company-info p {
            margin-bottom: 5px;
        }

        .customer-info {
            text-align: right;
        }

        .invoice-details {
            margin-bottom: 30px;
        }

        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-details th,
        .invoice-details td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .invoice-details thead th {
            text-align: left;
            background-color: #e8e8e8;
        }

        .invoice-summary {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .invoice-summary .summary-item {
            text-align: right;
            margin-bottom: 10px;
        }

        .invoice-summary .summary-item span.bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <div class="company-info">
            <h1>Garage Reda</h1>
            <p>Tetouan</p>
            <p>05440404</p>
            <p>garagist@contact.ma</p>
        </div>
        <div class="customer-info">
            <h2>Invoice</h2>
            <p>Client Name: {{ $invoices[0]['name'] }}</p>
            <p>Mechanic Name: {{ $invoices[0]['mechanicname'] }}</p>
            <p>Date : {{ date('Y-m-d H:i') }}</p>
        </div>
    </div>

    <div class="invoice-details">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Registration</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoices[0]['make'] }}</td>
                    <td>{{ $invoices[0]['registration'] }}</td>
                    <td>{{ $invoices[0]['startDate'] }}</td>
                    <td>{{ $invoices[0]['endDate'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="invoice-summary">
        {{-- <div class="summary-item">
            <span>Subtotal:</span> {{ $invoices[0]['Subtotal'] }}
        </div> --}}
        <div class="summary-item">
            <span>Additional Charges:</span> {{ $invoices[0]['additionalCharges'] }}
        </div>
        <div class="summary-item">
            <span>Total:</span> {{ $invoices[0]['totalAmount'] }}
        </div>
    </div>
</body>
</html>
