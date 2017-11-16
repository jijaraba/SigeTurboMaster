<section class="payment-list" style="margin-top: 10px;">
    <ul id="payment-list display-horizontal col-100">
        <li class="col-100">
            <ul class="display-horizontal col-100 payment">
                <li class="col-10 photo" style="border-bottom: 1px solid #edeff0;">
                    <div style="position: relative;text-align: center;margin: 5px auto;width: 80px;height: 80px;border-radius: 50%;padding: 3px;background-color: #53bbb4;">
                        <a href="{{ URL::route('admissions.quantitativerecoveryfinalareas.getrecoveriesbyuser',['search' => json_encode(['idyear' => $search['year'],'iduser' => $iduseractual, 'page' => 1,'mostrar' => 'Pendientes']) ] ) }}">
                            <img style="border-radius: 50%;" src="{{env('ASSETS_SERVER')}}/img/users/{{$pending->photo}}" alt="{{ $pending->Student }}"
                                                        title="{{ $pending->Student }} ({{ $pending->iduser }})"/>
                        </a>
                    </div>
                </li>
                <li class="payments col-90" style="border-bottom: 1px solid #edeff0;">
                    <ul id="payment-list display-horizontal col-100">
                        <li class="col-100">
                                <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-weight: bold;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                                    <li class="col-10 family">
                                        <div><strong>Año</strong></div>
                                    </li>
                                    <li class="col-10 family">
                                        <div><strong> Grupo</strong> </div>
                                    </li>
                                    <li class="col-25 family">
                                        <div><strong>Area</strong></div>
                                    </li>
                                    <li class="col-40 family" style="text-align: center;">
                                        <div><strong>Descripción</strong></div>
                                    </li>
                                    <li class="col-10 family">
                                        <div><strong> Calificación</strong> </div>
                                    </li>
                                    <li class="col-5 family"> 
                                    </li>
                                </ul>
                        </li>
                        <li class="col-100">
                                <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                                    @foreach($pendings as $pending)
                                        @if($pending->iduser == $iduseractual)
                                            <li class="col-10 family">
                                                <div>{{$pending->Year}}</div>
                                            </li>
                                            <li class="col-10 family">
                                                <div>
                                                    {{$pending->Groups}}
                                                </div>
                                            </li>
                                            <li class="col-25 family">
                                                <div>{{$pending->Area}}</div>
                                            </li>
                                            <li class="col-40 family" style="text-align: center;">
                                                <div>{{$pending->Description}} </div>
                                            </li>
                                            <li class="col-10 family">
                                                <div  style="text-align: center;">
                                                    {{$pending->Rating}}
                                                </div>
                                            </li>
                                            <li class="col-5 family">  
                                                <div><a style="cursor: pointer;color:#53bbb4;" ng-click="changeItem(1,{{ json_encode($pending) }})"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</section>