<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        @page {
            size:  auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }

        html {
            background-color: #FFFFFF; 
            margin: 0px;  /* this affects the margin on the html before sending to printer */
        }

        body {
            
            margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
        }
        
        table {
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h4>Nomor Nota : {{ $sale->sale_number }}</h4>
    <h4>Waktu Transaksi : {{ $sale->created_at }}</h4>
    <h4>Total : Rp. {{ $total}}</h4>
    <h4>Terbayar : Rp. {{ $paid }}</h4>
    <h4>Sisa Pembayaran : Rp. {{ $need_paid }}</h4>
    <h4>Status : 
        @if($status == true)
            <b>Lunas</b>
        @else
            <b>Belum Lunas</b>
        @endif
    </h4>
                   
    <table>
        <thead>
            <tr>
                <th>Kode Product</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->sale_details as $value)
            <tr>
                <td>{{ $value->product->code_product}}</td>
                <td>{{ $value->product->categorie->name}}</td>
                <td>Rp. {{ $value->sale_price }}</td>
                <td>{{ $value->quantity }}</td>
                <td>Rp. {{ $value->quantity * $value->sale_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
