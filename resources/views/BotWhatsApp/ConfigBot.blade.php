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

        <div class="row">

            <div class="Campo">
                <p>Hora Inicio</p>
                <input id="InitHourAssist" value="<?php echo $bot_current_config->InitHourAssist?>" type="text">
            </div>

            <div class="Campo">
                <p>Hora Fin</p>
                <input id="EndHourAssist" value="<?php echo $bot_current_config->EndHourAssist?>" type="text">
            </div>

            <div class="Campo">
                <p>Tiempo de sessions</p>
                <input id="timeOutSessionAssist" value="<?php echo $bot_current_config->timeOutSessionAssist?>" type="text">
            </div>

        </div>
        <br>

          <input type="hidden" id="url" name="url" value="<?php echo $bot['url']?>/set-all-config">
{{--          <h2>Configuración</h2>--}}

{{--          <p>Activo: <?php echo $bot_current_config->ActiveAssist==true?"Si":"No"?></p>--}}

          <textarea id="InitProntAssist"><?php echo $bot_current_config->InitProntAssist?></textarea>

          <br>








        <div class="row">
            <input type="submit" id="done-scan-bot" value="Guardar Configuración" onclick="submitForm()">
            &nbsp;&nbsp;
            @if($bot_current_config->ActiveAssist == "true")
             <input type="submit" id="stop-scan-bot"  value="Desactivar" onclick="changueStatusBot(false)"
            @else
             <input type="submit" id="done-scan-bot" value="Activar" onclick="changueStatusBot(true)">
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>

        function submitForm(){
            // console.log("Hola Mundo")

            let InitHourAssist = document.getElementById("InitHourAssist").value;
            let EndHourAssist = document.getElementById("EndHourAssist").value;
            let InitProntAssist = document.getElementById("InitProntAssist").value;
            let timeOutSessionAssist = document.getElementById("timeOutSessionAssist").value;

            var myHeaders = new Headers();
            myHeaders.append("Accept", "application/json");
            myHeaders.append("Content-Type", "application/json");

            var raw = JSON.stringify({
                "InitHourAssist": InitHourAssist,
                "EndHourAssist": EndHourAssist,
                "InitProntAssist": InitProntAssist,
                "timeOutSessionAssist": timeOutSessionAssist
            });

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };

            let url = document.getElementById("url").value;
            fetch( url, requestOptions)
                .then(response => response.text())
                .then(result => {

                    if(result == "true"){
                        Swal.fire({
                            icon: 'success',
                            confirmButtonText: 'Ok',
                        }).then((result) => {

                        })

                    }else{
                        Swal.fire({
                            title: 'Error!',
                            text: 'Algo salio mal.',
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        })
                    }

                })
                .catch(error => console.log('error', error));

        }

        function changueStatusBot(status){
            console.log("Hola Mundo "+status)

            var myHeaders = new Headers();
            myHeaders.append("Accept", "application/json");
            myHeaders.append("Content-Type", "application/json");

            var raw = JSON.stringify({
                "ActiveAssist": status?"true":"false"
            });

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };
            let url = document.getElementById("url").value;

            console.log(url)
            fetch(url, requestOptions)
                .then(response => response.text())
                .then(result => {


                    if(result == "true"){
                        Swal.fire({
                            icon: 'success',
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                            location.reload();
                        })

                    }else{
                        Swal.fire({
                            title: 'Error!',
                            text: 'Algo salio mal.',
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        })
                    }


                })
                .catch(error => console.log('error', error));


        }

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

      #stop-scan-bot {
            border: none;
            background-color: red;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        #stop-scan-bot:hover {
            background-color: darkred;
        }


        .row{
            display: flex;
        }


        input[type="text"] {
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 16px;
            padding: 10px;
            background-color: transparent;
            transition: border-bottom-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-bottom-color: #8bc34a;
            outline: none;
        }

        textarea {
            width: 70%;
            height: 65vh;
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 16px;
            padding: 10px;
            background-color: transparent;
            transition: border-bottom-color 0.3s ease;
        }

        textarea:focus {
            border-bottom-color: #8bc34a;
            outline: none;
        }

        .Campo{
            margin:10px;
        }
    </style>

    </html>

@endsection
