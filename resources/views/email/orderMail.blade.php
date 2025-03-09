<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px 15px;
        }
        .header {
            text-align: center;
            padding: 20px 15px;
            background-color: #f8f9fa;
        }
        .order-details {
            margin: 20px 0;
            padding: 20px 15px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .product-table th,
        .product-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }
        .total-row {
            font-weight: bold;
        }
        .customer-info {
            margin-top: 20px;
            padding: 20px 15px;
            background-color: #f8f9fa;
        }
        .footer {
            text-align: center;
            padding: 20px 15px;
            font-size: 12px;
            color: #666666;
        }

        @media (max-width: 767px) {
            .customer-info .customer-info-inner {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank you for your purchase, {{ $orderData['order']->first_name }}!</h1>
            <p>Your order has been successfully placed.</p>
        </div>

        <div class="order-details">
            <h2>Order #{{ $orderData['order']->id }}</h2>
            <p><strong>Order Date:</strong> {{ $orderData['order']->created_at->format('d M, y') }}</p>
            <p><strong>Status:</strong> {{ $orderData['order']->status }}</p>
            <p><strong>Payment Status:</strong> {{ $orderData['order']->payment_status }}</p>

            <div>
                <p><strong>Sub Total:</strong> ${{ $orderData['order']->subtotal }}</p>
                <p><strong>Shipping:</strong> ${{ $orderData['order']->shipping }}</p>
                <p class="total-row"><strong>Total:</strong> ${{ $orderData['order']->grand_total }}</p>
            </div>
        </div>

        <div class="customer-info">
            <div class="customer-info-inner" style="display: flex; justify-content: space-between; gap:40px;">
                <div>
                    <h3>Billing Address</h3>
                    <p><strong>Name: </strong>{{ $orderData['order']->first_name }} {{ $orderData['order']->last_name }}</p>
                    <p><strong>Address: </strong>{{ $orderData['order']->address }}</p>
                    <p><strong>Eamil: </strong>{{ $orderData['order']->email }}</p>
                </div>
                <div>
                    <h3>Shipping Address</h3>
                    <p><strong>Name: </strong>{{ $orderData['order']->first_name }} {{ $orderData['order']->last_name }}</p>
                    <p><strong>Address: </strong>{{ $orderData['order']->address }}</p>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>© 2023 Your Company Name. All rights reserved.</p>
            <p>Contact us: support@company.com | (555) 123-4567</p>
        </div>
    </div>
</body>
</html>