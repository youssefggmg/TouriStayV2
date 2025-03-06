<!DOCTYPE html>
<html>
<head>
    <title>Rental Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; margin: 0;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <tr>
            <td align="center" style="padding-bottom: 20px;">
                <h2 style="color: #333;">🏡 Rental Confirmation</h2>
            </td>
        </tr>
        <tr>
            <td>
                <p style="color: #555; font-size: 16px;">Dear <strong>{{ $details['ownerName'] }}</strong>,</p>
                <p style="color: #555; font-size: 16px;">We are delighted to inform you that your property, <strong>{{ $details['announcmentName'] }}</strong>, has been successfully rented.</p>
                
                <h3 style="color: #333;">Renter Details:</h3>
                <p><strong>Name:</strong> {{ $details['renterName'] }}</p>
                <p><strong>Email:</strong> {{ $details['renterEmail'] }}</p>
                <p><strong>Phone:</strong> {{ $details['renterPhone'] }}</p>
                
                <h3 style="color: #333;">Rental Details:</h3>
                <table width="100%" border="0" cellspacing="0" cellpadding="5" style="margin-top: 15px;">
                    <tr>
                        <td style="background: #f8f8f8; padding: 10px; font-size: 14px; font-weight: bold;">Start Date:</td>
                        <td style="background: #f8f8f8; padding: 10px;">{{ $details['startDate'] }}</td>
                    </tr>
                    <tr>
                        <td style="background: #ffffff; padding: 10px; font-size: 14px; font-weight: bold;">End Date:</td>
                        <td style="background: #ffffff; padding: 10px;">{{ $details['endDate'] }}</td>
                    </tr>
                    <tr>
                        <td style="background: #f8f8f8; padding: 10px; font-size: 14px; font-weight: bold;">Total Price:</td>
                        <td style="background: #f8f8f8; padding: 10px;">${{ $details['totale'] }}</td>
                    </tr>
                </table>
                
                <p style="color: #555; font-size: 16px; margin-top: 20px;">Thank you for trusting us with your property. We hope this rental brings you great success and happiness.</p>
                <p style="color: #555; font-size: 16px;">For any assistance, feel free to reach out.</p>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding-top: 20px;">
                <a href="#" style="display: inline-block; background-color: #28a745; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 16px;">View Rental Details</a>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding-top: 20px; font-size: 12px; color: #999;">
                © 2025 Your Company Name. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
