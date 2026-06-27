<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    
</head>
<body>
    <div class="header">
        <h2>Lexoria Diamond</h2>
        <p>Enterprise Management Intelligence</p>
        <p><strong>{{ $title }}</strong></p>
        <p>Generated on: {{ date('M d, Y h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                @foreach($columns as $col)
                    <th class="{{ in_array($col, ['Amount', 'Revenue', 'Spent', 'Tax Amount', 'Profit', 'Selling Price', 'Unit Cost']) ? 'text-end' : '' }}">{{ $col }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                @foreach($columns as $col)
                    @php
                        $val = '';
                        if ($reportType == 'sales') {
                            if ($col == 'Date') $val = $row->created_at->format('Y-m-d');
                            elseif ($col == 'Order #') $val = $row->order_number;
                            elseif ($col == 'Customer') $val = $row->first_name . ' ' . $row->last_name;
                            elseif ($col == 'Amount') $val = '$' . number_format($row->total_amount, 2);
                            elseif ($col == 'Status') $val = strtoupper($row->status);
                        } elseif ($reportType == 'products') {
                            if ($col == 'Product') $val = $row->product_name;
                            elseif ($col == 'Quantity') $val = $row->total_quantity;
                            elseif ($col == 'Revenue') $val = '$' . number_format($row->total_revenue, 2);
                        } elseif ($reportType == 'customers') {
                            if ($col == 'Customer') $val = $row->name;
                            elseif ($col == 'Email') $val = $row->email;
                            elseif ($col == 'Spent') $val = '$' . number_format($row->total_spent, 2);
                        } elseif ($reportType == 'tax') {
                            if ($col == 'Date') $val = $row->created_at->format('Y-m-d');
                            elseif ($col == 'Order #') $val = $row->order_number;
                            elseif ($col == 'Amount') $val = '$' . number_format($row->total_amount, 2);
                            elseif ($col == 'Tax Amount') $val = '$' . number_format($row->tax_amount, 2);
                        } elseif ($reportType == 'profit_loss') {
                            if ($col == 'Product') $val = $row->product_name;
                            elseif ($col == 'Quantity') $val = $row->quantity;
                            elseif ($col == 'Selling Price') $val = '$' . number_format($row->selling_price, 2);
                            elseif ($col == 'Unit Cost') $val = '$' . number_format($row->unit_cost, 2);
                            elseif ($col == 'Profit') $val = '$' . number_format($row->profit, 2);
                        }
                    @endphp
                    <td class="{{ in_array($col, ['Amount', 'Revenue', 'Spent', 'Tax Amount', 'Profit', 'Selling Price', 'Unit Cost']) ? 'text-end' : '' }}">{{ $val }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Lexoria Diamond. Confidential Document.</p>
    </div>
</body>
</html>
