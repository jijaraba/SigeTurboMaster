@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Requests"))
@section("title", Lang::get("sige.Requests"))
@section("content")
    
@stop
@section("dashboard")
    <section class="sige-student-items">
        <section class="grid-100">
		    <section class="sige-contained">
		        <section class="sige-admissions-payment-register">
		                    <a class="btn btn-green" href="">
		                        <i class="fa fa-plus-circle"></i>
		                        <span>{{ Lang::get('sige.New') }}</span>
		                    </a>
		        </section>
		        <section class="sige-student-lists" style="margin-top: 40px">
		            <h4>{{ Lang::get('sige.Request') }}</h4>
		                <div class="clearfix"></div>
		            <section class="payment-list">
		            	    <ul id="payment-list display-horizontal col-100">
        				<li class="col-100">
		                	<ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                            	@foreach($requests as $request)
                                    <li class="col-95 family">
                                        <div>{{$request->request}}</div>
                                    </li>
                                    <li class="col-5 family">  
                                        <div><a style="cursor: pointer;color:#53bbb4;" ng-click="changeItem(1)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></div>
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
    {!! HTML::script('js/' . getCurrentRoute() . '.js') !!}
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