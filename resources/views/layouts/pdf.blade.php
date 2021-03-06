<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
            size: landscape;
            margin: 5px;
            size: 'A4';
            padding-bottom: 40px;
            margin: 10px 14px 0px 14px;
        }

        @media print {

            html,
            body {
                /* width: 210mm;
                height: 297mm; */
                width: 100%;
                height: 100%;
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
            height: 230px;
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
            background-color: #ffffff;
            color: #000000;
        }

        main {
            position: relative;
            top: 230px;
            left: 0px;
            right: 0px;
            width: 100%;
        }

        table {
            border-collapse: collapse !important;
        }

        td,
        th {
            vertical-align: middle !important;
        }

    </style>
</head>

<body>
    @yield('content')
    @php
        if (isset($pdf)) {
        $x = 250;
        $y = 10;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 14;
        $color = array(255,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
    @endphp
</body>

</html>
