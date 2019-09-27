<!DOCTYPE html>
<html>
<head>
    <title>Invoice_{{$pdf_data['paymentTransaction']['PaymentOrderID']}}</title>
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon" />
    <style type="text/css">
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 13px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    .invoice-box table {
        width: 100%;
        text-align: left;
    }
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    .invoice-box table tr.heading th {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    .invoice-box table tr.total td{
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    .text-left{
        text-align: left !important;
    }
    .text-right{
        text-align: right !important;
    }
    .text-center{
        text-align: center;
    }
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('images/logo.png') }}" stylelogo_pdf="max-width:300px;">
                            </td>
                            
                            <td>
                                <b>Order Number:</b>{{$pdf_data['paymentTransaction']['PaymentOrderID']}}<br>
                                <b>Order Date:</b>
                                {{date('Y-m-d h:i:s a', strtotime($pdf_data['paymentTransaction']['PaymentDate']))}}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
                <td>
                    <b>Office Address:</b><br>
                    {{'Testcraft Edutech pvt ltd'}}<br>
                    {{'12, Kalyanam Bunglow, Laxmi Nivas Society,'}}<br>
                    {{'Nr Paldi Bus Stand, Paldi,'}}<br>
                    {{'Ahmedabad, Gujarat, India, 380006'}}<br>
                </td>
                
                <td>
                    <b>Student Name:</b><br>
                    @if(!empty($pdf_data['student']))
                    {{$pdf_data['student']['full_name']}}<br>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <b>PAN No:</b>XXX-PAN-XXX
                </td>
                
                <td rowspan="2">
                </td>
            </tr>
            <tr>
                <td>
                    <b>GST Registration No:</b>24AAHCT3357M1ZZ
                </td>
            </tr>
        </table>
        <table>
            <tr class="heading text-center">
                <th>No</th>
                <th>Description</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <!-- <th>Net Amount</th> -->
                <!-- <th>Tax Rate</th>
                <th>Tax Type</th>
                <th>Tax Amount</th> -->
                <th>Amount</th>
            </tr>
            
            @foreach ($pdf_data['invoiceDetail'] as $key => $pdf)
            <tr class="details item">
                <td class="text-center">{{++$key}}</td>
                <td class="text-left">{{$pdf['testPackage']['TestPackageName']}}</td>
                <td class="text-right">{{$pdf['TestPackageSalePrice']}}</td>
                <td class="text-right">{{$pdf['Quantity']}}</td>
                <!-- <td class="text-right">{{$pdf['final_price']}}</td> -->
                <!-- <td class="text-right">0%</td>
                <td>IGST</td>
                <td class="text-right">0%</td> -->
                <td class="text-right">{{$pdf['Amount']}}</td>
            </tr>
            @endforeach

            <tr class="total">  
                <td colspan="4" class="text-left">Total</td>
                <td class="text-right">{{ array_sum($pdf_data['invoiceDetail']->pluck('Amount')->toArray()) }}
                </td>
            </tr>
            <tr class="total">
                <td colspan="1" class="text-left">Amount in Words:</td>
                <td colspan="4" class="text-left">{{$pdf_data['in_word']}}</td>
            </tr>
            <tr class="total">
                <td colspan="5" class="text-right">
                <br>
                <br>
                For, Testcraft Edutech Private Limited<br>
                <br>
                <br>
                Authorized Signatory</td>
            </tr>
            <tr>
                <td colspan="5" class="text-center">
                <br>
                This is computer generated invoice signature not required</td>
            </tr>
        </table>
    </div>
</body>
</html>