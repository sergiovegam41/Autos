@extends('crudbooster::admin_template')
@section('content')



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="./../css/All.css">
    <link rel="stylesheet" href="./css/All.css">

</head>

<body>

<form action="UpdateAddSopport?id_inventory={{$FinalData['id']}}" method="get">

    <p style="padding-left: 70px; font-size: 20px">Añadir soporte</p>

    <div class="table_a">

        <div class="item_a">

            <div class="info_a">

                <p>VIN: {{$FinalData['id']}} ~ ref: {{$FinalData['reference']}}</p>
                <p>Sede: {{$FinalData['order']['storeName']}}</p>
                <p>Orden: N° {{$FinalData['order']['order_number']}}</p>
                <p>Asesor: {{$FinalData['order']['nameAsesor']}}</p>
                <p>Cliente: {{$FinalData['order']['nameClient']}} </p>

            </div>

            <hr>


            <div class="from">

                <div class="campo">
                    <p class="label_a">Motivo</p>

                    <div class="searchBox">

                        <textarea name="motivo" id="" ></textarea>
                    </div>
                </div>

                <div class="campo">
                    <p class="label_a">Descripcion</p>

                    <div class="searchBox">

                        <textarea name="descripcion" id="" ></textarea>
                    </div>
                </div>

                <div class="campo">
                    <p class="label_a">Estado</p>

                    <div class="searchBox">

                        <select name="status_id"  >
                            @foreach($SopportStatus as $item)
                                <option value="{{$item['id']}}">{{$item['name']}}</option>
{{--                                <option value="value2" selected>Value 2</option>--}}
{{--                                <option value="value3">Value 3</option>--}}
                            @endforeach
                        </select>
                    </div>
                </div>


            </div>

            <input id="id" name="id" type="hidden" value="{{$FinalData['id']}}">
            <br>

            <button type="submit"> Añadir Soporte </button>

            <div class="time_a">
                <p>Fecha de creacion: {{ explode( 'T', $FinalData['created_at'])[0] }} </p>
                <p>Entregado: {{ explode( 'T', $FinalData  ['delivery_date_time']??'Pendiente')[0] }}</p>
            </div>

        </div>

    </div>

</form>



</body>

<style>

    body{
        /*display: flex;*/
        /*justify-content: center;*/
        /*align-items: center;*/
        /*height: 80vh;*/
    }

    .from{
        padding: 20px;
        display: flex;
    }

    .campo{
        /*padding: 10px;*/
        /*background: transparent !important;*/
        /*background: black;*/
        display: flex;
        flex-direction: column;
        /*height: 50vh;*/
    }

    textarea{
        resize: none;
        border: none;
        outline: none;
        height: 90px;
        /*height: 90px;*/
        /*padding: 5px;*/
        /*padding-bottom: ;*/
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .2);

    }

    .label_a{
        /*background: black;*/
        height: 50px;
    }
    select{
        border: none;
        outline: none;
        width: 200px;
        height: 30px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .2);
    }
    option{
        padding: 10px;
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


<style>
    body{
/*background: red;*/
/*        display: flex;*/
/*        justify-content: center;*/
/*        align-items: center;*/
    }

    hr
    {
        border-color: white;
        margin-left: 20px;
        margin-right: 20px;

    }

    .campo
    {
        /*background-color: orange;*/
        /*height: 65px !important;*/
        /*display: flex;*/
        /*flex-direction: column;*/
        color: black;

        /* padding-top: 300px; */
        /* box-shadow: 0px 2px 5px rgba(0, 0, 0, .2); */
    }
    .label_a
    {
        font-family: roboto;
        font-weight: 300;
        padding-left: 10px;
        font-size: 15px;
        /*background: red;*/
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
        /*background: rgba(0, 0, 0, .1);*/
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
        background: white;
        cursor: pointer;
        margin: 10px;
        padding-left: 20px;
        padding-right: 10px;
        flex-direction: column;
        border-radius: 16px;
    }

    .item_a button
    {
        outline:none;
        border: none;
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
    .item_a button:hover
    {
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .5);
        background:rgba(0, 166, 90,1    );
        /* color: white; */
        transition: 0.25s;
    }
    .item_a button:active
    {
        transform: scale(1.1);
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
        background: rgba(0, 0, 0,0.2);
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
        background: rgba(0, 0, 0,0.2);
        border-radius: 0px 100px 100px 0px;

    }


</style>

</html>

@endsection
