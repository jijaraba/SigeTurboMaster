@extends("layouts.exports")
@section("title", "Tareas")
@section("styles")
    <style type="text/css">
        @font-face {
            font-family: 'Gotham Rounded Book';
            src: url('http://assets.thenewschool.edu.co/assets/fonts/GothamRoundedBook.ttf')  format('truetype')
        }
        body {
            width: 100%;
            display: block;
            font-family: 'Gotham Rounded Book', Helvetica Neue, Helvetica, sans-serif;
            font-size: 1em;
            font-weight: 100;
            letter-spacing: -1px;
            color: #384047;
            margin: 0px;
        }
        .sige-contained-export {
            border-radius: 5px;
            box-shadow: 1px 1px 1px rgba(0,0,0,0.8);
            position: relative;
            width: 100%;
        }
        .display-horizontal {
            display: inline-block;
        }
        .display-horizontal > li {
            display: inline-block;
            float: left;
        }
        .col-100 {
            width:100%;
        }
        .col-90 {
            width:90%;
        }
        .col-80 {
            width:80%;
        }
        .col-75 {
            width:75%;
        }
        .col-70 {
            width:70%;
        }
        .col-65 {
            width:65%;
        }
        .col-60 {
            width:60%;
        }
        .col-55 {
            width:55%;
        }
        .col-30 {
            width:30%;
        }
        .col-20 {
            width:20%;
        }
        .col-15 {
            width:15%;
        }
        .col-10 {
            width:10%;
        }
        .col-05 {
            width:5%;
        }
        .tasks {
            font-size: 11px;
            margin-top: 5px;
            border-bottom: 1px solid #ccc;
            width: 100%;
            color:#657380;
            padding: 0px;
        }
        .tasks > .photo  {
        }
        .tasks > .photo > div  {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            padding: 3px;
            background-color: #53BBB4;
        }
        .tasks > .photo > div > img  {
            border-radius: 50%;
            width: 48px;
        }
        .tasks > .description {
            padding: 10px;
        }
        .tasks > .ends {
            line-height: 40px;
        }
        .tasks > .checkin {
            line-height: 10px;

        }
        .tasks > .checkin > input {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            border: 1px solid #555;
            background-color: #fff;
        }
        input {
            margin-top: 50px;
            position: relative;
            display: block;
        }
    </style>
@stop
@section("content")
    <div id="contained" class="sige-contained-export">
        <div style="position:absolute;float:right;width: 100%;text-align: right;padding: 20px;margin-right: 30px">
            <img src="http://assets.thenewschool.edu.co/assets/SigeTurbo.png" alt="SigeTurbo" style="width:40px">
        </div>
        <div style="position:relative;top:20px;color:#53BBB4;width:100%;text-align: center;font-size: 2em;margin-top: 20px">The New School</div>
        <p style="position:relative;top:10px;color:#657380;width:100%;text-align: center;font-size: 1.1em;margin-top: 5px">Cronograma de Tareas</p>
        <ul class="display-horizontal col-100">
            <li class="col-100">
                @foreach($tasks as $task)
                <ul class="col-100 display-horizontal tasks">
                    <li class="col-10 photo">
                        <div>
                            <img src="http://assets.thenewschool.edu.co/img/users/{{$task->photo}}"/>
                        </div>
                    </li>
                    <li class="col-10 ends">
                        {{ $task->ends }}
                    </li>
                    <li class="col-65 description">
                        <div style="margin-top:5px">{{ $task->subject . ": " . $task->nivel }}</div>
                        <div><strong>{{ $task->name }}</strong></div>
                    </li>
                    <li class="col-15 checkin">
                        <input type="text" value="">
                    </li>
                </ul>
                <div style="clear: both;"></div>
                @endforeach
            </li>
        </ul>
        <span style="color:#53BBB4">Ver detalle de las tareas en http://sigeturbo.thenewschool.edu.co/tasks </span>
    </div>
@stop