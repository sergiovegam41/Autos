@extends('crudbooster::admin_template')
@section('content')

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
    </style>

    <link rel="stylesheet" href="./../css/All.css">
    <link rel="stylesheet" href="./css/All.css">

    <div class="primary" style="width: auto; height:100vh">
        <center>
            <h1> Formulario Facturacion </h1>
        </center>

        <div   class="tiket" >




            <form id="facturacion-form" action="./../GuardarFacturacion" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="campo">
                    <label for="">Numero de facturacion</label> <br>
                    <input type="text" id="invoice_number" name="invoice_number" placeholder="">
                </div>
                    <div class="file-select" id="src-file1" >
                        <input type="file" id="file" name="imagen" aria-label="Archivo">
                    </div>
                <br>

                <input type="hidden" name="id" value={{$order->id}}>
                <div class="campo">
                    <button class="btn-submit" type="button" onclick="enviarForm()">Enviar</button>
                </div>
            </form>

        </div><br><br>

    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

        .btn-submit{
        /*background: red;*/
            font-weight: bold;
            border: none;
            border-radius: 100px;
            /*padding: 5px;*/
            /*padding-left: 75px;*/
            /*padding-right: 75px;*/
            width: 200px;
            height: 32px;
            transition: 0.25s;

        }

        .btn-submit:hover{
            background: white;
            color: black;
            transition: 0.25s;
        }
        #invoice_number{
            margin-top: 5px;
            height: 35px;
            border: none;
            outline: none;
            padding-left: 10px;
           width: 200px;
            border-radius: 100px;
        }

        .primary{
            /*background: red;*/
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top:-15%;
        }
        .file-select {
            position: relative;
            display: inline-block;
        }

        .file-select::before {
            background-color: #5678EF;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 3px;
            content: 'Seleccionar'; /* testo por defecto */
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }

        .file-select input[type="file"] {
            opacity: 0;
            width: 200px;
            height: 32px;
            display: inline-block;
            border-radius: 100px;

        }

        #src-file1::before {
            border-radius: 100px;
            content: 'Seleccionar Archivo';
        }

        #src-file2::before {
            content: 'Seleccionar Archivo 2';
        }

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
        .campo{
            margin: 10px;
        }

        .full:before{
            background: black;
            color: white;
            /*content: 'Seleccionado';*/
        }
    </style>
    <script>


        document.querySelector('#file').addEventListener('change', function() {

            let file = document.getElementById("file").value

            if( file ){
                document.getElementById("src-file1").className +=  " full"
            }

        });

       function enviarForm(){

           Swal.fire({
                title: '¿Seguro que desea confirmar?',
               text: "Esta acción no se puede deshacer",
               icon: 'warning',
               showCancelButton: true   ,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Confirmar'
            }).then((result) => {

                if (result.isConfirmed) {

                    let invoice_number = document.getElementById("invoice_number").value
                    let file = document.getElementById("file").value

                    console.log(invoice_number)
                    console.log(file)

                    if(  !invoice_number  || !file ){

                        Swal.fire('El formulario debe estar completo', '', 'info')

                    }else{
                        let form = document.getElementById("facturacion-form")
                        form.submit()
                    }


                }

            })

           e.preventDefault();

        }

       document.addEventListener('DOMContentLoaded', () => {
           document.querySelector('#facturacion-form').addEventListener('keypress', e => {
               if (e.keyCode == 13) {
                   e.preventDefault();
               }
           })
       })

    </script>
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

        .btn{
            border-radius: 15px;
            margin: 2px;
            box-shadow: 0 5px 10px #a0a0a033;
            /*padding: 2px;*/
        }
    </style>

@endsection
