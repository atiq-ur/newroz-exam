<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 75%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 3px 10px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 10px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>

</head>
<body>
<header class="clearfix">
    <div id="logo">
        {{--<img src="logo.png">--}}
        <h2><strong>Newroz Technologies Limited</strong></h2>
    </div>
    <h1>INVOICE ID: #{{ $order->order_id }}</h1>
    <div id="company" class="clearfix">
        <div>Newroz E-com</div>
        <div>451, Mirpur,<br /> Dhaka</div>
        <div>(+880) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
    </div>
    <div id="project">
        <div><span>CUSTOMER</span> {{ $order->customer_name }}</div>
        <div><span>ADDRESS</span> {{ $order->customer_delivery_address }} </div>
        <div><span>EMAIL</span> <a href="mailto:{{ $order->customer_email }}">{{ $order->customer_email }}</a></div>
        <div><span>DATE</span> {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }} </div>
    </div>
</header>
<main>
    <table>
        <thead>
        <tr>
            <th class="service">Sl</th>
            <th class="service">Product</th>
            <th>TASTE</th>
            <th>WEIGHTS</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody>
        @php
            $sub_total = 0;
        @endphp
        @foreach($order_products as $pro)
            <tr>
                <td class="service">{{ $loop->index+1 }}</td>
                <td class="desc">{{ $pro->product_name }}</td>
                <td class="unit">{{ $pro->taste_name }}</td>
                <td class="unit">{{ $pro->weights }}</td>
                <td class="unit">{{ $pro->unit_price }} </td>
                <td class="qty">{{ $pro->quantity }}</td>
                <td class="total">{{ $pro->unit_price * $pro->quantity }} Taka</td>
                @php
                    $sub_total += ($pro->quantity * $pro->unit_price);
                @endphp
            </tr>
        @endforeach
        <tr>
            <td colspan="6">SUBTOTAL</td>
            <td class="total">{{ $sub_total }} Taka</td>
        </tr>
        @php
            if ($order->delivery_area == "dhaka") $delivery_charge = 60;
            else $delivery_charge = 100;
        @endphp
        {{ $delivery_charge }} Taka
        <tr>
            <td colspan="6">DELIVERY CHARGE</td>
            <td class="total">{{ $delivery_charge }} Taka</td>
        </tr>

        <tr>
            <td colspan="6" class="grand total">GRAND TOTAL</td>
            <td class="grand total">{{ $sub_total + $delivery_charge }} Taka</td>
        </tr>

        </tbody>
    </table>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>
