@extends('crudbooster::admin_template')
@section('content')
    <link rel="stylesheet" href="../../css/All.css">

    <style>

        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #FFF;
            border-bottom-color: #0d3625;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
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

        #contacts{
            /*background: cornflowerblue;*/
            width: 100%;
            height: 100%;

            display: grid;
            grid-template-columns: repeat(4, 25%);
            /*grid-gap: 20px;*/

        }

        .item{
            /*background: rgba(0,0,0,.05);*/
            margin: 10px;
            height: 75px;
            border-radius: 10px;
            border: solid #0d3625 1px;
            box-shadow: 2px 2px 10px rgba(0,0,0,.2);

        }
        .item {
            display: flex;
            justify-content: start;
            align-items: center;
            padding: 10px;
        }
        #contacts .item img{
            border-radius: 100px;
            width: 40px;
            height: 40px;
        }

        #contacts .info{
           display: flex;
            flex-direction: column;
            padding: 10px;
            /*background: red;*/

            /*width: 400px;*/
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;

        }
        #contacts .info .span{
          font-size: 20px;
            color: green;
            font-weight: bold;

        }

        #contacts .info p{
            /*background: red;*/
            /*width: 100%;*/
            text-overflow: ellipsis;
            white-space: nowrap;

        }

    </style>

    <link rel="stylesheet" href="./css/All.css">
    <div style="width: auto; height:100vh">
        <div id="item-bot" >

            <img src="{{$HostBotWhatsApp}}/qr" alt="" width="200px">

            <div class="column">

                <h3><?php  echo $requireScan ?  "Inactivo":  "Activo" ?></h3>
                <p>Api WhatsApp</p>
                <p>host: {{$HostBotWhatsApp}} </p>


            </div>








        </div>


        <br>

        <h3>Contactos</h3>
        <hr>
        <div id="contacts">
          <span class="loader"></span>




        </div>

    </div>


    <script src="https://viewhistoryautos.onrender.com/socket.io/socket.io.js"></script>


    <script>

        document.getElementsByClassName("content-header")[0].remove();

        document.addEventListener("DOMContentLoaded", ()=>{
            const socket = io('https://viewhistoryautos.onrender.com')

            socket.on('server:refresh',(data)=>{
                console.log(data)
                console.log("refresh")
                render(data)

            })

            socket.on('server:init',(data)=>{
                console.log(data)
                console.log("init data")

                render(data)
            })

            function render(data){

                document.getElementById('contacts').innerHTML = ''

                data.forEach(element => {
                    document.getElementById('contacts').innerHTML += `  <div class="item">
                <img  src="https://thumbs.dreamstime.com/b/omita-el-icono-del-perfil-avatar-placeholder-gris-de-la-foto-99724602.jpg" alt="">

                <div class="info">
                    <div class="span">
                        +${element.from}
                    </div>
                    <p>${cortarString(element.answer)}</p>
                </div>

            </div>`
                });

            }
        });

        function cortarString(texto) {
            return texto;
        }

    </script>

    <style>

        .column{
            display: flex;
            flex-direction: column;

        }

        #item-bot{
            width: 100%;
            height: 300px;
            /*background: red;*/
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 20px;
            padding-left: 50px;
            border: solid 1.5px #3c763d;
            border-radius: 10px;
            box-shadow: 10px 0px 10px rgba(0,0,0,.2);
            background: white;

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
