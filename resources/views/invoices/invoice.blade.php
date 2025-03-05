<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .invoice-box { border: 1px solid #ddd; padding: 20px; max-width: 600px; margin: auto; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <h2>Invoice</h2>
        <p><strong>Customer:</strong> {{ $invoiceData['customer_name'] }}</p>
        <p><strong>Invoice Date:</strong> {{ $invoiceData['invoice_date'] }}</p>

        <table>
            <tr>
                <th>Product</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td>{{ $invoiceData['product_name'] }}</td>
                <td>{{ $invoiceData['startDate'] }}</td>
                <td>{{ $invoiceData['endDate'] }}</td>
                <td class="total">{{ $invoiceData['amount'] }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
