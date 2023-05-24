@extends('crudbooster::admin_template')
@section('content')

    <style>

        /* Tiket */

        .tiket{
            justify-content: center;
            text-align: center;
            display: flex;
            position: relative;
            /*width: -;*/
            height: auto;
            padding: 30px;
            padding-top: 90px;
            padding-bottom: 90px;
            background: rgba(43, 43, 43,0.07);
            flex-direction: column;
            /*background: blue;*/
            width: 40%;
            text-align: center;

            min-width: 300px;
        }

        .tiket img{
            background: red;
            text-align: center;

            width: 200px;
            border-radius: 10px;
            transition: .25s;

        }

        .tiket::before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 24px;
            background:

                linear-gradient(-135deg ,white 12px, transparent 0% ),
                linear-gradient(135deg ,white 12px, transparent 0% );

            background-size: 24px;
        }

        .tiket::after{
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 24px;
            background:

                linear-gradient(-45deg ,white  12px, transparent 0% ),
                linear-gradient(45deg ,white  12px, transparent 0% );

            background-size: 24px;
        }
        /* Fin tiket */
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

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
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

        .primary{
            margin-top:-15%;
        }
    </style>

    <link rel="stylesheet" href="./../css/All.css">
    <link rel="stylesheet" href="./css/All.css">

    <div class="primary" style="width: auto; height:100vh">
        <div   class="tiket" >
            @if($order->is_it_billed)
                <h1 style="color: rgba(0,0,0,0.3);"> Factura </h1>

                <br>




                    <div class="campo">
                        <label for="">#Orden: {{$order->order_number}}</label>
                    </div>

                    <div class="campo">
                        <label for="">#Facturacion: {{$order->invoice_number}}</label>
                    </div>
                     <br>
                    <div style="width: 100%;" class="img">
                        <a  class="download" href="./..{{str_replace("\\","/",$order->url_invoice_picture)}}">Descargar documento  <i  class="fa fa-download" aria-hidden="true"></i></a>


                    </div>

            @else
                <P>Esta orden no ha sido facturada</P>
            @endif



        </div>

    <style>

        .download{
            color: white;
            background: black;
            padding: 10px;
            padding-left: 15px;
            padding-right: 15px;
            transition: 0.25s;
            border-radius: 100px;
        }

        .download:hover{
            color: black;
            background: white;

        }

        .primary{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
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

        .btn{
            border-radius: 15px;
            margin: 2px;
            box-shadow: 0 5px 10px #a0a0a033;
            /*padding: 2px;*/
        }
    </style>

@endsection
