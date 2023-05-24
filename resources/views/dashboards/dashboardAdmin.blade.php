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

    <link rel="stylesheet" href="./css/All.css">
    <div style="width: auto; min-height:100vh">
        <div >

            <div class="row" style="width: 100%;justify-content: left; margin-left: 20px">


                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$counts['entregadas']}}</h3>
                        <p>Ordenes entregadas</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                </div>

                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$counts['enProceso']}}</h3>
                        <p>Ordenes en procesos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-product-hunt"></i>
                    </div>
                </div>

                <div class="small-box bg-green"  style="width: 300px">
                    <div class="inner">
                        <h3>{{$counts['cientes']}}</h3>
                        <p>Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>

                <div class="whatsApp">
                    <button type="button" onclick="location.href ='./whatsApp'"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;  WhatsApp</buttom>

                </div>

                <style>
                    .whatsApp{
                        height: 100px;
                        display: flex;
                        justify-content: start;
                        align-items: start;
                        /*background: red;*/
                        /*height: 100%;*/
                    }
                    button {
                        border: none;
                        background-color: #01a65b   ;
                        color: white;
                        padding: 10px 20px;
                        border-radius: 5px;
                        transition: background-color 0.3s ease;
                    }

                    button:hover {
                        background-color: darkgreen;
                    }
                </style>



            </div>

            <div class="row" >
                <div id="curve_chart" style="width: 70%;  margin-left: -5%; height: 400px"></div>
                <div id="piechart_3d" style="width: 30%; margin-left: 0%; height: 400px"></div>
            </div>

            <hr>

            <h3 style="padding-left: 20px;font-family: 'Source Sans Pro',sans-serif;"> Autos por entregar</h3>

            <div id="rowBox" style="margin-top: -80px">

                @if(count($porSalir) == 0)
                    <p style="padding-left: 50px">No tenemos datos disponibles</p>
                @endIf
                @foreach ($porSalir as $dato)
                    <div class="itembox">

                        <div id="box">
                            <div class="top"></div>
                            <div>
                                <span></span>
                                <span>
                                    <i class="tape"></i>
                              </span>
                                <span style=""></span>
                                <span>
                                    <i class="tape"></i>
                                </span>
                                <div class="infotape" style="display: flex;justify-content: center;align-items: center; ">
                                    <div class="infoProduct" >

                                        <h2>#{{$dato['order_number']}}</h2>
                                        <P>{{$dato['adress']}}</P>
                                        <P>${{number_format($dato['grand_total'])}}</P>
                                        <a href="./ViewOrdersDetail?id={{$dato['id']}}">Ver pedido</a>

                                    </div>
                                    </dvi>
                                </div>
                            </div>
                        </div>

    {{--                    <div class="details" style="margin-top: -50px;">--}}
    {{--                        <h1>Hola</h1>--}}
    {{--                        <p>Esta es la description</p>--}}
    {{--                    </div>--}}

                    </div>
                @endforeach





            </div>

        </div>

    </div>


    <script type="text/javascript" src="./js/Utils/googleChart.js"></script>

    <script>
        document.getElementsByClassName('content-header')[0].remove()
    </script>


    <script>

        var dataFinal = []

        console.log("Init Success")
        let data = JSON.parse( <?php var_export($data) ?> );
        data = data.meses
        keys = Object.keys(data)
        dataFinal = [
                ['Meses', ...Object.keys(data).reverse()],

        ]


        let maxDays = data[keys[0]].length

            console.log(maxDays)
       for(let i=1; i <= maxDays; i++ ){

         let item = [ `${i}`, data[keys[2]][i-1],data[keys[1]][i-1],data[keys[0]][i-1]]
           dataFinal.push(item)


       }

       if(maxDays == 0){
           dataFinal.push(["1",0,0,0])
       }


        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);



        function drawChart() {

            var data = google.visualization.arrayToDataTable(dataFinal);

            var options = {
                title: 'Ventas',
                curveType: 'function',
                legend: { position: 'bottom' },
                colors: ['D0D0D0', '727272', '3c8dbc']
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);

        }




        console.log("End Success")

    </script>




    <script>

        let data2 = JSON.parse( <?php var_export($data) ?> );
        // console.log()

        console.log(data2);


        function drawChart2() {
            console.log("drawChart2")
            var data = google.visualization.arrayToDataTable(dataAnalysis2);

            var options = {
                title: 'Ordenes',
                is3D: false,
                // colors: ['D0D0D0', '727272']
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }




        let valores = Object.values(data2.torta); // valores = ["Scott", "Negro", true, 5];
        let keys = Object.keys(data2.torta) // valores = ["Scott", "Negro", true, 5];

        if( valores[0] == 0 && valores[1] == 0 && valores[2] == 0 && valores[3] == 0 && valores[4] == 0 && valores[5] == 0 ){
            console.log("siiie")
            valores = [1]
            keys = ["Vacio"]
        }

        let finalData2 = [['Paises', '']]



        for(let i=0; i< valores.length; i++){
            finalData2.push([keys[i],valores[i]])
        }

        google.charts.load("current", {packages:["corechart"]});

        dataAnalysis2 = finalData2
        google.charts.setOnLoadCallback(drawChart2);
    </script>

    <style>
        .small-box {
            margin: 20px;
        }
        @import url('https://fonts.googleapis.com/css2?family=Comfortaa&display=swap');
        *{
            font-family: 'Comfortaa', cursivex;
            font-weight: 500;
        }

        body{
            background: white;
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

        .row{
            width: 100%;

            /*background: red;*/
            display: flex;
            justify-content: left;
            align-items: center;
        }

        @media only screen and (max-width: 600px) {
            .row {
                flex-direction: column;
            }
        }
    </style>



    <style>

        .itembox{
            /* background: black; */
            /* margin: 10px; */
            width: 300px;
            /*height: 400px;*/
            text-align: center


        }

        #box{
            position: relative;
            width: 300px;
            height: 300px;
            transform-style: preserve-3d;
            transform:  rotate(0deg) rotateX(0deg) rotateY(0deg ) translateY(0px) scaley(.4) scaleX(.4) scaleZ(.4);
            transition: 1s;
            animation: initial1 1s;
            transform: scale(.5)  rotateY(-8deg) rotateX(3deg);
        }



        #box:hover
        {

            transition: 1s;
            transform:scale(.75);
        }

        @keyframes initial1{
            0%{
                margin-left: -90px;
                transform: scale(.5) rotateX(3deg) rotateY(3deg);

            }



            100%{
                transform: scale(.5)  rotateY(-8deg) rotateX(3deg);
                margin-left: 0;
            }
        }



        #box::before{
            content: '';
            position: absolute;
            top: 0;
            left:0;
            width: 300px;
            height: 300px;
            transform: rotateX(90deg) translateZ(-220px);
            background-color: rgba(0, 0, 0, 0.25);
            filter: blur(30px);
        }

        #box div {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
        }

        #box div span{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* display: block; */
            background: black;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .infotape
        {
            transform: rotateY(0deg) translate3d(0,0,160px) scale(.7);

            border-radius: 20px;

        }

        #box div span:nth-child(1){
            transform: rotateY(0deg) translate3d(0,0,150px);
            background: #dEaa77;
        }

        #box div span:nth-child(1)::before{
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            /* background:white; */
            border-radius: 2px;
            background-size: 200px;
            background-repeat: no-repeat;
            background-position: center;
        }

        .notes{
            background-color: red;
        }

        #box div span:nth-child(2){
            transform: rotateY(90deg) translate3d(0,0,150px);
            background: #ca9864;
        }

        #box div span:nth-child(3){
            transform: rotateY(180deg) translate3d(0,0,150px);
            background: #ca9864;
        }

        #box div span:nth-child(3)::before{
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            /* background: white; */
            border-radius: 2px;
            background-size: 200px;
            background-repeat: no-repeat;
            background-position: center;
        }

        #box div span:nth-child(4){
            transform: rotateY(270deg) translate3d(0,0,150px);
            background: #ca9864;
        }

        #box .top{
            position: absolute;
            top: 0;
            left: 0;
            width: 300px;
            height: 300px;
            transform-style: preserve-3d;
            background: #e8bb84;
            display: flex;
            align-items: center;
            transform: rotateX(90deg) translateZ(150px);
            /* perspective: 500px; */
        }

        #box .top::after{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 300px;
            height: 300px;
            background: #e8bb84;
            display: flex;
            align-items: center;
            transform: rotateX(180deg) translate3d(0,0,300px);
        }

        #box .top::before{
            content: '';
            position: absolute;
            width: 100%;
            height: 60px;
            background: rgba(53, 53, 53,0.4);
            background-size: 85px;
        }

        .tape{
            position: absolute;
            top: 0px;
            left: 50%;
            transform: translateX(-50%) rotate(0deg);
            width: 60px;
            height: 90px;
            background: rgba(53, 53, 53,0.4) ;

        }


        .tape::after{
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 24px;
            background:

                linear-gradient(-45deg ,#ca9864 12px, transparent 0% ),
                linear-gradient(45deg ,#ca9864 12px, transparent 0% );

            background-size: 24px;
        }

        .infoProduct{
            background: url(./img/hoja.jpg);
            border-radius: 10px;
            color: black;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 20px;
            font-weight: 100;
            text-align: center;
            justify-content: center;
            padding: 0px;
            padding-top: 10px;
            overflow-y: auto;


        }

    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap');


        .card{
            /* background: RED; */
            width: 200px;
            height: 50px;
            margin: 10px;
            padding: 10px;
            display: flex;
            justify-content: left;
            align-items: center;
            border-radius: 10px;
            background: gainsboro;
            border-left: 5px solid aquamarine;
            font-family: 'Raleway', sans-serif;



        }

        #row{
            display: flex;
            /* background: red !important; */
            justify-content: center;
            align-items: center;


        }

        #rowBox{


            height: 400px;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            /* max-width: 100%; */
            overflow-y: auto;

        }
    </style>

@endsection
