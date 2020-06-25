<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan {{ $type }}</title>

<body>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            border-color: #ccc;
            width: 100%;
        }

        .tg td {
            font-family: Arial;
            font-size: 12px;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #fff;
        }

        .tg th {
            font-family: Arial;
            font-size: 14px;
            font-weight: normal;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #f0f0f0;
        }

        .tg .tg-3wr7 {
            font-weight: bold;
            font-size: 12px;
            font-family: "Arial", Helvetica, sans-serif !important;
            ;
            text-align: center
        }

        .tg .tg-ti5e {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;
            ;
            text-align: center
        }

        .tg .tg-rv4w {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;
        }

        .page-break {
            page-break-after: always;
        }
    </style>

    <table class="tg" style="width:80%;margin-left:auto;margin-right:auto">
        <thead>
            <tr>
                <th class="tg-3wr7">Supplier Name</th>
                <th class="tg-3wr7">No. Faktur</th>
                <th class="tg-3wr7">Metode Bayar</th>
                <th class="tg-3wr7">Detail Barang</th>
                <th class="tg-3wr7">Total</th>
                <th class="tg-3wr7">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $pembelian)
            <tr>
                <td>{{$pembelian->supplier->nama}}</td>
                <td>{{$pembelian->no_faktur}}</td>
                <td>{{$pembelian->total}}</td>
                <td>{{$pembelian->metode_bayar}}</td>total
                <td>
                    @foreach ($pembelian->details as $detail)
                    {{ $detail->sukucadang->nama . ": ". $detail->jumlah }}
                    @endforeach
                </td>
                <td>{{$pembelian->total}}</td>
                <td>{{$pembelian->jumlah}}</td>
            <tr>
                @endforeach
        </tbody>
    </table>
    <div class="page-break"></div>
</body>
</head>

</html>