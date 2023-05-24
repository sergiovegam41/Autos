@extends('crudbooster::admin_template')
@section('content')

    <html>
    <link rel="stylesheet" href="./../css/All.css">
    <link rel="stylesheet" href="./css/All.css">
    <title>Wallet</title>
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        #saldo {
            color: green;
            font-weight: bold;
        }
    </style>


    <div style="width: auto; height:100vh" id="padre">

        <p>Por favor escanea el código QR.</p>
        <img src="<?php echo $img_qr ?>" alt="">
        <input type="button" value="Listo" id="done-scan-bot" onclick="location.reload()">

    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comfortaa&display=swap');
        *{
            font-family: 'Comfortaa', cursivex;
            font-weight: 500;
        }

        .user-panel{
            margin: 10px;
            padding: 10px;
            /*margin-bottom: 10px;*/
        }

        .img-circle{
            object-fit: cover !important;
            width: 40px !important;
            height: 40px !important;
            box-shadow: 0 5px 15px #a0a0a066;

        }

        #bots{
            /*background: blue;*/
            display: grid;
            grid-template-columns: repeat(2,500px);
        }

       #padre{
           /*background: red;*/
           display: flex;
           justify-content: start;
           align-items: center;
           flex-direction: column;
       }


        #done-scan-bot {
            border: none;
            background-color: green;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        #done-scan-bot:hover {
            background-color: darkgreen;
        }
    </style>

    </html>

@endsection
