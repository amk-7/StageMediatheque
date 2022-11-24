@extends("layout.template.base")

@section("content")
    <script src="https://reeteshghimire.com.np/wp-content/uploads/2021/05/html5-qrcode.min_.js"></script>
    <style>
        .result{
            background-color: green;
            color:#fff;
            padding:20px;
        }
        .row{
            display:flex;
        }
    </style>


    <div class="row">
        <div class="col">
            <div style="width:500px;" id="reader"></div>
        </div>
        <div class="col" style="padding:30px;">
            <h4>SCAN RESULT</h4>
            <div id="result">Result Here</div>
        </div>
    </div>


    <script type="text/javascript" async>
        function onScanSuccess(qrCodeMessage) {
            document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
        }

        function onScanError(errorMessage) {
            //handle scan error
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
@stop
@section("js")

@stop
