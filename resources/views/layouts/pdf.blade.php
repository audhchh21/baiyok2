<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ storage_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ storage_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ storage_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        @page {
            size: 'A4';
            padding: 10px;
            margin: 10px 0px 0px 0px;
        }

        @media print {
            html,
            body {
                width: 210mm;
                height: 297mm;
            }
        }

        body {
            font-family: 'THSarabunNew' !important;
            font-size: 16px;

        }

        header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            height: 200px;
            text-align: center;
            line-height: 1.5px;
        }

        footer {
            position: fixed;
            padding: 0px 15px 10px 0px;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 28px;
            background-color: #06693a;
            color: #ffffff;
        }

        main {
            position: relative;
            top:200px;
            left: 0px;
            right: 0px;
        }

        .tb-td {
            vertical-align: middle !important;
        }

        .page-number:before {
            color: #ffffff;
            content: "Page " counter(page);
        }
    </style>
</head>

<body>
    @yield('content')
    <script type="text/php">
        if (isset($pdf)) {
            $text = "หน้า {PAGE_NUM} / {PAGE_COUNT}";
            $size = 12;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 25;
            $color = array(255,255,255);
            $pdf->page_text($x, $y, $text, $font, $size, $color);
        }
    </script>
</body>
</html>
