@extends("layouts.default", [ 'ngmodule' => 'dashboard','cssprefered' => 'dashboard'   ])
@section("ModuleName", Lang::get("sige.Consent"))
@section("title", Lang::get("sige.Consent"))
@section("content")

@stop
@section("dashboard")
    <section class="sige-student-items" ng-controller="ConsentsController">
        <section class="grid-100">
		    <section class="sige-contained">
		        <section class="sige-admissions-payment-register">
		          <a class="btn btn-green" ng-click="dialogsforms( {{ json_encode($search)}} );">
		              <i class="fa fa-plus-circle"></i>
		              <span>{{ Lang::get('sige.New') }}</span>
		          </a>
		        </section>
		        <section class="sige-student-lists" style="margin-top: 40px">
		            <h4>{{ Lang::get('sige.Consent') }}</h4>
		                <div class="clearfix"></div>
		            <section class="payment-list">
		            	    <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                                <li class="col-30 family">
                                    <div>Usuario</div>
                                </li>
                                <li class="col-20 family">
                                    <div>Tipo de Consentimiento</div>
                                </li>
                                <li class="col-35 family">
                                    <div>Fecha de Creación de Registro</div>
                                </li>
                                <li class="col-15 family">
                                    <div>Acciones</div>
                                </li>
                            </ul>
        				<li class="col-100">
		                	<ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                            	@foreach($consents as $consent)
                                    <li class="col-30 family">
                                        <div>{{$consent->user}}</div>
                                    </li>
                                    <li class="col-20 family">
                                        <div>{{$consent->consenttype}}</div>
                                    </li>
                                     <li class="col-35 family">
                                        <div>{{$consent->datestring}}</div>
                                    </li>
                                    <li class="col-10 family">
                                        <div>
                                            <a target="_blank" href="{{env('ASSETS_SERVER')}}/consent/{{$consent->path}}">Download</a>
                                        </div>
                                    </li>
                                    <li class="col-5 family">  
                                        <div><a style="cursor: pointer;color:#53bbb4;" ng-click="dialogsforms( {{ json_encode($consent)}} );"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></div>
                                    </li>
                            	@endforeach
                        	</ul>
                    	</li>
		            </section>
		            <section class="sige-turbo-pagination col-100">

		            </section>
		        </section>
		    </section>
		</section>
    </section>
@stop
@section("script")
    {!! HTML::script('js/dashboard.js') !!}
@stop
@section("vendor")
    {!! HTML::script('js/vendor/vendor.js') !!}
@stop
@section("socket")
    {!! HTML::script('js/vendor/socket.io.js') !!}
@stop
@section("sigeturbo")
    {!! HTML::script('js/SigeTurbo.js') !!}
    {!! HTML::script('js/Stream.js') !!}
@stop