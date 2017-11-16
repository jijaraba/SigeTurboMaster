<section class="grid-100">
    <section class="sige-contained">
        <section class="sige-admissions-payment-register">
                    <a class="btn btn-green" href="">
                        <i class="fa fa-plus-circle"></i>
                        <span>{{ Lang::get('sige.New') }}</span>
                    </a>
        </section>
        <section class="sige-student-lists" style="margin-top: 40px">
            <h4>{{ Lang::get('sige.Quantitativerecoveryfinalareas') }}</h4>
            {!! Form::open(['autocomplete' => 'off']) !!}
            <section class="search-container">
                <ul class="display-horizontal col-100">
                    <li class="col-100 gutter-5">
                        <sige-turbo-admission-search-student search="search" result="result"></sige-turbo-admission-search-student>
                        <input name="search" ng-model="result" ng-value="result" type="hidden" value="{{json_encode($search)}}" />
                    </li>
                </ul>
            </section>
            
                {!! Form::close() !!}
                <div class="clearfix"></div>
            <section class="payment-list">
                    <ul id="payment-list display-horizontal col-100">
                        <li class="col-100">
                                @include('quantitativerecoveryfinalareas.partials.recoveries')
                        </li>
                    </ul>
            </section>
            <section class="sige-turbo-pagination col-100">
                    {!! $pendings->appends(['search' => json_encode($search)])->render() !!}
            </section>
        </section>
    </section>
</section>