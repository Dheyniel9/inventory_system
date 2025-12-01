<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - {{ $sale->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
            width: 80mm;
            padding: 10px;
            background: white;
        }
        .receipt {
            width: 100%;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #000;
        }
        .store-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .store-info {
            font-size: 10px;
            color: #333;
        }
        .invoice-info {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #000;
        }
        .invoice-info p {
            display: flex;
            justify-content: space-between;
        }
        .items {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #000;
        }
        .item {
            margin-bottom: 8px;
        }
        .item-name {
            font-weight: bold;
        }
        .item-details {
            display: flex;
            justify-content: space-between;
            padding-left: 10px;
        }
        .totals {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #000;
        }
        .totals p {
            display: flex;
            justify-content: space-between;
        }
        .totals .grand-total {
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
            padding-top: 5px;
            border-top: 1px solid #000;
        }
        .payment-info {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #000;
        }
        .payment-info p {
            display: flex;
            justify-content: space-between;
        }
        .customer-info {
            margin-bottom: 10px;
            font-size: 11px;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 15px;
        }
        .footer p {
            margin-bottom: 3px;
        }
        .cancelled {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: red;
            border: 2px solid red;
            padding: 5px;
            margin-bottom: 10px;
        }
        @media print {
            body {
                width: 80mm;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <div class="store-name">{{ config('app.name', 'Inventory System') }}</div>
            <div class="store-info">
                <p>123 Business Street</p>
                <p>City, State 12345</p>
                <p>Tel: (123) 456-7890</p>
            </div>
        </div>

        @if($sale->is_cancelled)
        <div class="cancelled">*** CANCELLED ***</div>
        @endif

        <div class="invoice-info">
            <p><span>Invoice:</span><span>{{ $sale->invoice_number }}</span></p>
            <p><span>Date:</span><span>{{ $sale->sale_date->format('M d, Y H:i') }}</span></p>
            <p><span>Cashier:</span><span>{{ $sale->user->name }}</span></p>
        </div>

        @if($sale->customer_name)
        <div class="customer-info">
            <p><strong>Customer:</strong> {{ $sale->customer_name }}</p>
            @if($sale->customer_phone)
            <p><strong>Phone:</strong> {{ $sale->customer_phone }}</p>
            @endif
        </div>
        @endif

        <div class="items">
            @foreach($sale->items as $item)
            <div class="item">
                <div class="item-name">{{ $item->product_name }}</div>
                <div class="item-details">
                    <span>{{ $item->quantity }} x ${{ number_format($item->unit_price, 2) }}</span>
                    <span>${{ number_format($item->total, 2) }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="totals">
            <p><span>Subtotal:</span><span>${{ number_format($sale->subtotal, 2) }}</span></p>
            @if($sale->discount_amount > 0)
            <p>
                <span>Discount{{ $sale->discount_type === 'percentage' ? ' ('.$sale->discount_value.'%)' : '' }}:</span>
                <span>-${{ number_format($sale->discount_amount, 2) }}</span>
            </p>
            @endif
            @if($sale->tax_amount > 0)
            <p><span>Tax ({{ $sale->tax_rate }}%):</span><span>${{ number_format($sale->tax_amount, 2) }}</span></p>
            @endif
            <p class="grand-total"><span>TOTAL:</span><span>${{ number_format($sale->total, 2) }}</span></p>
        </div>

        <div class="payment-info">
            <p><span>Payment Method:</span><span>{{ $sale->payment_method_label }}</span></p>
            <p><span>Amount Paid:</span><span>${{ number_format($sale->amount_paid, 2) }}</span></p>
            @if($sale->change_amount > 0)
            <p><span>Change:</span><span>${{ number_format($sale->change_amount, 2) }}</span></p>
            @endif
        </div>

        <div class="footer">
            <p>Items Sold: {{ $sale->items->sum('quantity') }}</p>
            <p>--------------------------------</p>
            <p>Thank you for your purchase!</p>
            <p>Please come again</p>
            <p>--------------------------------</p>
            <p>{{ now()->format('M d, Y H:i:s') }}</p>
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px; padding: 20px;">
        <button onclick="window.print()" style="padding: 10px 30px; font-size: 14px; cursor: pointer; background: #4F46E5; color: white; border: none; border-radius: 5px;">
            Print Receipt
        </button>
        <button onclick="window.close()" style="padding: 10px 30px; font-size: 14px; cursor: pointer; background: #6B7280; color: white; border: none; border-radius: 5px; margin-left: 10px;">
            Close
        </button>
    </div>
</body>
</html>
