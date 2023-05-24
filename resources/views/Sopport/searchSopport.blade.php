@extends('crudbooster::admin_template')
@section('content')




    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/All.css">
    <link rel="stylesheet" href="./css/All.css">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="buscador.css">

</head>
<body>

<div class="container_a">





    <div class="result">

        <form action="" method="get" id="formSarch">
        <div class="buscador" >


            <div class="campo">
                <p class="label_a">Buscador de VIN</p>

                <div class="searchBox">
                    <div class="shadow"></div>
                    <input  id="buscar" name="buscar" type="text" id="buscar" value="{{Request()->buscar}}" placeholder="Digite el VIN">
                    <ion-icon name="search-outline" class="search-outline" onclick="sendSearch();"></ion-icon>
                    <div class="tape"></div>
                </div>
            </div>


        </div>
        </form>


{{--        <hr>--}}

{{--    table--}}

        <div class="table_a">

            <?php
                $data = $FinalData['data']??[];
//                dd($data);
            ?>

                @if($data == [] && Request()->buscar)



                    <center style="padding: 50px" >
                        <p> No se encontraron resultados para <strong>{{Request()->buscar}}</strong> en la pagina {{Request()->page??1}} (*^_^*) </p>
                    </center>
                @endif

                @if($data == [] && ! Request()->buscar)
                    <center style="padding: 50px" >
                        <p> Busca por VIN o Referencia para comenzar</p>
                    </center>
                @endif

            @foreach($data as $itemG)
                    <div class="item_a" >

                        <div class="info_a">

                            @if($itemG['imei'] == Request()->buscar)
                                <p>VIN: {{ $itemG['imei']}} ~ ref: {{$itemG['reference']}}</p>
                            @else
                                <p style="color: black !important;">VIN: {{$itemG['imei']}} ~ ref: {{$itemG['reference']}}</p>
                            @endif


                            <p>Sede: {{$itemG['order']['storeName']}}</p>
                            <p>Orden: N° {{$itemG['order']['order_number']}}</p>
                            <p>Asesor: {{$itemG['order']['nameAsesor']}}</p>
                            <p>Cliente: {{$itemG['order']['nameClient']}} </p>


                        </div>

                        <hr>
                        <p style="padding-left: 20px;"><strong>Soportes</strong></p>


                        <div  class="list_items_a">

                            @if($itemG['support'] == [])
{{--                            <div class="item_list_a">--}}
                                <center style="padding: 50px" >
                                    <p> Este VIN no tiene soporte</p>
                                </center>
{{--                            </div>--}}
                            @endif


                            @foreach($itemG['support'] as $itemL)

                                <div class="item_list_a" onclick="window.location.replace('support/edit/{{$itemL['id']}}');">
                                    <p style="padding-top: 10px;padding-left: 10px;font-weight: bold;color: orange">Estado: {{$itemL['status_name']}}</p>
                                    <p style="padding-left: 10px;">Motivo: {{$itemL['Asunto']}} - Descripcion:{{$itemL['Descripcion']}} <br>fecha: {{  explode( 'T', $itemL['created_at'])[0]   }}</p>
                                </div>

                            @endforeach



                        </div>
                        <hr>

                        <a href="AddSopport?id={{ $itemG['id'] }}"> Añadir Soporte </a>

                        <div class="time_a">
                            <p>Fecha de creacion: {{ explode( 'T', $itemG['created_at'])[0] }} </p>
                            <p>Entregado: {{ explode( 'T', $itemG['delivery_date_time']??'Pendiente')[0] }}</p>
                        </div>

                    </div>

            @endforeach



                     <div class="flex justify-between flex-1 sm:hidden" style="margin-left: 60px; position:relative; bottom: 0;">

{{--                        <div onclick="addParameterInUrl('page', {{Request()->page}} - 1 )" class="btn btn-sm btn-default" style="border-radius: 15px 0px 0px 15px !important; margin:3px; ">--}}
{{--                        « Previous--}}


                         <form action="" style="display: inline">
                             <input name="buscar" type="hidden" value="{{Request()->buscar }}">
                             <input id="page" name="page" type="hidden" value="{{(Request()->page??1) + -1}}">
                             <button style="border-radius: 50px 0px 0px 50px;" name="" type="submit" class="btn btn-sm btn-default" >
                                 « Previous
                             </button>
                         </form>

                         <p class="btn btn-sm btn-default" style="border-radius: 0 !important; margin:5px;">{{Request()->page??1}}</p>

                         <form action=""  style="display: inline">
                             <input name="buscar" type="hidden" value="{{Request()->buscar }}">
                             <input id="page" name="page" type="hidden" value="{{(Request()->page??1) + 1 }}">

                             <button style="border-radius: 0 50px 50px 0;" name="" type="submit" class="btn btn-sm btn-default" >
                                Next »
                             </button>
                         </form>

                </div>

        </div>



    </div>



</div>

<p class="a"  href="/AddExceptionSopport" onclick="window.location.href = 'AddExceptionSopport'">Registrar excepción</p>


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>

    function sendSearch(){
        let form = document.getElementById("formSarch");
        form.submit();
    }

</script>




</body>
</html>


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


<style>
    body{
/*background: red;*/
        display: flex;
        justify-content: center;
        align-items: center;
    }

    hr
    {
        border-color: darkgrey;
        margin-left: 20px;
        margin-right: 20px;

    }

    .campo
    {
        /*background-color: orange;*/
        height: 65px !important;
        display: flex;
        flex-direction: column;
        /* padding-top: 300px; */
        /* box-shadow: 0px 2px 5px rgba(0, 0, 0, .2); */
    }
    .label_a
    {
        font-family: roboto;
        font-weight: 300;
        padding-left: 10px;
        font-size: 15px;
    }

    .container_a
    {
        /*margin: 10px;*/
        /*height: 100%;*/
        /*width: 70%;*/
        display: flex;
        /*background: red;*/
        /*justify-content: center;*/
        /*align-items: center;*/
        /*flex-direction: column;*/
        /* background-color: aliceblue; */
        /*min-height: 100%;*/
        /*height: 100vh;*/
    }


    .buscador
    {
        margin: 10px;
        /*background-color: lightskyblue;*/
        justify-content: center;
        flex-direction: column;

    }


    .result
    {
        /*margin: 10px;*/
        flex: 2;

        background-color: white;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .2);
        outline: 10ch;
        height: 100%;
        min-height: 100%;
        width: 200vh;
    }

    .table_a{
        background: rgba(0, 0, 0, .1);
        /*height: 58vh;*/
        overflow-y: auto;
        overflow-x: hidden;
    }



    /* item */

    .item_a
    {
        /* margin-left: 20px; */
        /* margin-right: 20px; */
        width: 100%;
        /* background: gainsboro; */
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size: .9em;
        transition: 1s;
        /* height: 40px; */
        transform: scale(.90);
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .2);
        background: white;
        padding: 10px;

    }

    .item_a .time_a p
    {
        opacity: 1;
        /* background: gainsboro; */
        display: inline;
        padding-left: 10px;
        /* z-index: 1; */

    }

    .item_a .info_a p:first-child
    {
        color: orange;
        font-weight: 500;
        font-size: 18px;
    }

    .item_a .time_a
    {
        padding-bottom: 10px;
    }



    .item_a .info_a p
    {
        /* background: wheat;    */
        display: inline;
        padding-left: 10px;
        z-index: 1;
    }


    .item_a .list_items_a{
        overflow-y: auto;
        /* background: red; */
        padding-top: 0;
        padding: 10px 15px 10px 20px;
        height: 200px;
    }


    .item_list_a
    {
        display: flex;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .2);
        background: white;
        cursor: pointer;
        margin: 10px;
        padding-left: 20px;
        padding-right: 10px;
        flex-direction: column;
        border-radius: 16px;
    }

    .item_a a
    {
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .2);
        text-decoration:none;
        background: rgba(0, 166, 90,.7);
        color: white;
        font-weight: 200;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px 25px 10px 30px;
        transition: 1s;
        border-radius: 10px;
    }

    .item_a a:hover
    {
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .2);
        background: rgba(0, 166, 90,1);
         color: white;
        transition: 0.25s;
    }




</style>


<style>


    .searchBox{
        /* flex: 2; */
        position: relative;
        /* margin-top: 15px; */

        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
        transition: 1s;
        margin: 0px 10px 10px 10px;
        /* transform: scale(.9); */
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
        /* position: relative; */
        width: 100%;
        height: 40px;
        border: none;
        padding: 10px 15px ;
        /* padding: 0px 0px 0px 10px; */
        outline: none;
        font-size: .9em;
        color: rgba(0, 0, 0,1);
        background: rgba(0, 0, 0,0.1);
        /* background: linear-gradient(#D9DCE1,#ECF0F5); */
        /* box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.05),
        15px 15px 15px rgba(0, 0, 0, 0.01),
        20px 20px 15px rgba(0, 0, 0, 0.01),
        30px 30px 15px rgba(0, 0, 0, 0.01),
        inset 1px 1px 2px #fff; */
         border-radius: 100px 0px 0px 100px;
        transition: 1s;
    }


    .search-outline{
        position: absolute;
        right: 20px;
        color: #555;
        font-size: 1.2em;
        cursor: pointer;
        /* margin: 30px; */
        /* margin-right: -300px; */
        flex: 1;
        z-index: 0;
        transition: 1s;
    }

    .searchBox .tape
    {

        width: 40px;
        height: 40px;
        background: rgba(0, 0, 0,0.1);
        border-radius: 0px 100px 100px 0px;

    }


    .a{
        width: 150px;
        display: block;
        margin-top: 20px;
        /*background: rebeccapurple;*/
        text-align: center;
        /*background: red;*/
    }

    .a:hover{
        cursor: pointer;
        color: blue;


    }
</style>

@endsection
