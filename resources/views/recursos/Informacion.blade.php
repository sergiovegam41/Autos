@extends('crudbooster::admin_template')
@section('content')


    @php
        $safe = $_SERVER['HTTPS']?'https':'http';
        $host = $safe.'://'.$_SERVER['HTTP_HOST'].'/';
    @endphp
    <html>

    <head>

        <link rel="stylesheet" href="./../css/All.css">
        <link rel="stylesheet" href="./css/All.css">
    </head>


    <body id="body">
    <div class="head">

        <span class="Titulo-P">Recursos {{" - #".Request()->page}}</span>

        <div class="searchBox">
            <div class="shadow"></div>
            <input type="text" id="buscar" value="{{Request()->buscar}}" placeholder="¿Que Deceas Buscar?">

            <ion-icon name="search-outline" class="search-outline" onclick="addParameterInUrl('buscar', document.getElementById('buscar').value )"></ion-icon>
        </div>

        <div class="input-group" style="border-radius: 100px; margin-left: 10px; flex: 1">
            <select id="limit"  onchange="addParameterInUrl('limit', document.getElementById('limit').value);" name="limit" style="flex: 1;width: 100px;height: 50px; border-radius: 100px; background: rgba(0,0,0,0);border:transparent " class="form-control input-sm">
                <option style="background: lightskyblue" selected value="{{Request()->limit}}" >{{Request()->limit}}</option>
                <option value="10" >10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>
        </div>

    </div>




    <div class="padre">
        <section class="cabezera">

        </section>

        <section class="contain">

            @if (count($recursos) == 0 && count($generales) == 0)

                @php
                   $mensaje = "`(*>﹏<*)′ No se encontro ningun Recurso en la pagina #".Request()->page." para la busqueda: ". " '".Request()->buscar."'";

                @endphp
{{--                <p style="font-size: 40px;font-weight: bold;margin: 60px"></p>--}}
                <span style="margin: 50px;--j:{{strlen($mensaje) - 4 }}ch; --i:{{strlen($mensaje) - 4}}" class="typingText">{{$mensaje}}</span>

            @endif

            @if (count($generales) > 0)
            <form class="seccion-product" name="calc" style="overflow-x: auto!important;">
            <p class="value" style="width: 100%; font-size: 25px">Generales</p>
            @foreach ($generales as $item)


                  <span class="item"  onclick="window.location.replace('{{$host.$item->file}}')">
                      @if ($item->picture != null)
                         <img  src="{{$host.$item->picture}}" alt="" class="imgContent">
                      @endif
                         <p class="titulo" style="font-size: 20px; font-weight: bold">{{$item->Asunto}}</p>
                         <p class="sub-titulo">{{$item2->Descripcion}}</p>
                      @if ($item->file != null)

                         <buttom id="dowloadBuscar">
                           <p>
                               <a href="{{$host.$item->file}}" class="button"><i class="fa fa-download"></i> Descargar Archivo</a>
                           </p>
                         </buttom>
                      @endif
                  </span>
            @endforeach
            </form>
            @endif


            @foreach ($recursos as $item)


                    <form class="seccion-product" style=" overflow-x: auto!important;" name="calc">
{{--                        <input type="text" class="value" readonly name="txt"></input>--}}

                        <p class="value" style="width: 100%;font-size: 25px">{{$item->name.' - '.$item->type }}</p>



                        @foreach ($item->recursosInfo as $item2)

                            <span class="item"  onclick="window.location.replace('{{$host.$item2->file}}')">


                                     @if ($item2->picture != null)
                                         <img  src="{{$host.$item2->picture}}" alt="" class="imgContent">
                                     @endif

                                     <p class="titulo" style="font-size: 20px; font-weight: bold">{{$item2->Asunto}}</p>
                                     <p class="sub-titulo">{{$item2->Descripcion}}</p>

                                     @if ($item2->file != null)

                                         <buttom id="dowloadBuscar">
                                             <p>
                                                 <a href="{{$host.$item2->file}}" class="button"><i class="fa fa-download"></i> Descargar Archivo</a>
                                             </p>
                                         </buttom>

                                     @endif



                            </span>

                        @endforeach


                    </form>


            @endforeach

                <div class="flex justify-between flex-1 sm:hidden" style="margin-left: 60px; position:relative; bottom: 0;">
                    <div onclick="addParameterInUrl('page', {{Request()->page}} - 1 )" class="btn btn-sm btn-default" style="border-radius: 15px 0px 0px 15px !important; margin:3px; ">
                        « Previous
                    </div><p class="btn btn-sm btn-default" style="border-radius: 0 !important; margin-left:5px">{{Request()->page}}</p>

                    <div class="btn btn-sm btn-default" onclick="addParameterInUrl('page', {{Request()->page}} + 1 )" style="border-radius: 0px 15px 15px 0px !important; margin:3px; ">
                        Next »
                    </div>
                </div>



        </section>

    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    </body>

    <style>
        option
        {
            margin: 5px;
            font-size: 18px;
            transition: 1s;
            background: #ECF0F5;
            border-radius: 100px;

        }


        .input-group{
            background: linear-gradient(#D9DCE1,#ECF0F5);
            box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.05),
            15px 15px 15px rgba(0, 0, 0, 0.01),
            20px 20px 15px rgba(0, 0, 0, 0.01),
            30px 30px 15px rgba(0, 0, 0, 0.01),
            inset 1px 1px 2px #fff;
            transition: 1s;
        }

        .input-group:hover
        {
            border-radius: 100px;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.04),
            15px 15px 15px rgba(0, 0, 0, 0.01),
            20px 20px 15px rgba(0, 0, 0, 0.01),
            30px 30px 15px rgba(0, 0, 0, 0.01);
            transition: 1s;
            transform: scale(1.02);
            transition: 1s;
        }

        .typingText{

            display: block;
            font-family: monospace;
            white-space: nowrap;
            border-right:  4px solid;
            width: var(--j);
            animation: typing 2s steps(var(--i)) , blink .5s infinite step-end alternate;
            overflow: hidden;
            font-size: 20px;
            color: #1F1F1F;
            font-weight: lighter ;
        }




        @keyframes typing {
            from { width: 0; }
        }

        @keyframes blink {
            50% { border-color: transparent;}
        }
    </style>

    <style>

        .head{
            /*width: 100%;*/
            display: flex;
            margin: 25px;
        }

        .Titulo-P{
            flex: 8;
            font-size: 35px;
            font-weight: bold;
        }

    </style>

    <style>


        .contain{
            position: relative;
            min-width: 300px;
            min-height: 400px;


        }


        .seccion-product{
            position: relative;
            display: grid;
            padding: 50px;
            margin: 25px;
        }

        .seccion-product .value{
            position: relative;
            grid-column: span 3;
            height: 100px;
            width:  50%;
            border:none;
            outline: none;
        }

        @media (max-width: 800px) {
            .seccion-product .value{
                grid-column: span 1;
                width:  100px;

            }

        }

        .seccion-product .item
        {
            position: relative;
            display: grid;
            place-items: center;
            border-radius: 0px;
            margin: 8px;
            min-width: 800px;
            background-color: #DEE1E6;
            box-shadow: 0 3px 3px rgba(0, 0, 0, .1);
            padding: 30px;
            transition: 1s;
            z-index: 1;
        }

        .item:hover
        {
            background-color: white;
            transform: perspective(1500px)  scale(1.03) translateY(-30px) rotateZ(0);
            box-shadow: 0 20px 20px rgba(0, 0, 0, .1);
            cursor: pointer;
            transition: 1s;
            z-index: 2;
        }

        .seccion-product .item img
        {
            /*position: relative;*/
            display: block;
            width: 100%;
            height: 200px;
            object-fit: cover;

            border-radius: 0px;
            margin: 20px;
            transition: 2s;
        }

        .seccion-product .item p
        {
            /*position: relative;*/
           margin-left: 30px;
           display: block;
           margin-right: 30px;
        }

        .button
        {
           display: block;
           margin: 20px;
           padding: 10px;
           backdrop-filter: blur(2);
           background: rgba(0,0,0,0.1);
            color: #000;
        }



    </style>

    <style>
        .searchBox{
            flex: 4;
            position: relative;
            width: 400px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
            transition: 1s;
        }


        .shadow{
            position: absolute;
            top:20px;
            left: -16px;
            width: calc(93% + 50px);
            height: 300px;
            transform-origin: top;
            transform: skew(45deg) rotateZ(-5deg);
            pointer-events: none;
            z-index: 0;
            background: linear-gradient( 180deg, transparent,transparent,transparent);
            transition: 1s;
        }


        .searchBox input {
            position: relative;
            width: 100%;
            height: 100%;
            border: none;
            padding: 10px 25px;
            outline: none;
            font-size: 1.1em;
            color: #555;
            background: linear-gradient(#D9DCE1,#ECF0F5);
            box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.05),
            15px 15px 15px rgba(0, 0, 0, 0.01),
            20px 20px 15px rgba(0, 0, 0, 0.01),
            30px 30px 15px rgba(0, 0, 0, 0.01),
            inset 1px 1px 2px #fff;
            border-radius: 100px;
            transition: 1s;
        }

        .searchBox:hover .shadow
        {
            background: linear-gradient( rgba(0,0,0,0.01),transparent,transparent);
            transition: 1s;
        }

        .searchBox:hover
        {
            border-radius: 100px;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.04),
            15px 15px 15px rgba(0, 0, 0, 0.01),
            20px 20px 15px rgba(0, 0, 0, 0.01),
            30px 30px 15px rgba(0, 0, 0, 0.01);
            transition: 1s;
            transform: scale(1.02);
        }

        .search-outline{
            position: absolute;
            right: 20px;
            color: #555;
            font-size: 1.5em;
            cursor: pointer;
            /*margin: 30px;*/
            /*margin-right: -300px;*/
            flex: 1;
            z-index: 0;
            transition: 1s;
        }

    </style>



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
    </style>




    <script>


        $("#buscar").keyup(function(event){

            console.log("Hola");
            if(event.keyCode == 13){
                $("#buscar").click();
            }
        });

        function addParameterInUrl( name , value ){
            var href = window.location.href;

            console.log(href);

            if(isFirst(href)){

                window.location.href = window.location.href+'?'+name+'='+value;

            }else{

                console.log(value);

                if(getAllUrlParams(href)[name] != '' && getAllUrlParams(href)[name] != null ){

                    window.location.href = window.location.href.replaceAll(getAllUrlParams(href)[name] ,value);
                }else{
                    console.log('es nuevo');
                    window.location.href = window.location.href+"&"+name+"="+value;
                }

            }

        }
        function isFirst(href){
            if(Object.entries(getAllUrlParams(href)).length == 0){
                return true;
            }else{
                return false
            }
        }

        function getAllUrlParams(url) {
            var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
            var obj = {};
            if (queryString) {
                queryString = queryString.split('#')[0];
                var arr = queryString.split('&');
                for (var i = 0; i < arr.length; i++) {
                    var a = arr[i].split('=');
                    var paramName = a[0];
                    var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];
                    paramName = paramName.toLowerCase();
                    if (typeof paramValue === 'string') paramValue = paramValue;
                    if (paramName.match(/\[(\d+)?\]$/)) {
                        var key = paramName.replace(/\[(\d+)?\]/, '');
                        if (!obj[key]) obj[key] = [];
                        if (paramName.match(/\[\d+\]$/)) {
                            var index = /\[(\d+)\]/.exec(paramName)[1];
                            obj[key][index] = paramValue;
                        } else {
                            obj[key].push(paramValue);
                        }
                    } else {
                        if (!obj[paramName]) {
                            obj[paramName] = paramValue;
                        } else if (obj[paramName] && typeof obj[paramName] === 'string'){
                            obj[paramName] = [obj[paramName]];
                            obj[paramName].push(paramValue);
                        } else {
                            obj[paramName].push(paramValue);
                        }
                    }
                }
            }

            return obj;
        }
    </script>


    <script>

        var elInput = document.getElementById('buscar');
        elInput.addEventListener('keyup', function(e) {
            var keycode = e.keyCode || e.which;
            if (keycode == 13) {
                addParameterInUrl('buscar', document.getElementById('buscar').value )
            }
        });

    </script>

    </html>




@endsection
