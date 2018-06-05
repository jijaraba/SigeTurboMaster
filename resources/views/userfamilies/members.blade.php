@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Parents"))
@section("title", Lang::get("sige.Parents"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('parents.partials.helper')
    @endif
@stop
@section("dashboard")
    <section class="grid-100">

        <section class="sige-contained">
            <section class="sige-payments-create-form">
                <a href="{{ URL::route('parents.dashboard',[])}}"
                   class="btn btn-transparent margin-bottom-20"><i
                            class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                <h4>{{ Lang::get('sige.FamilyMembers') }}</h4>
                <section class="sige-options-container">
                    <article>
                        <header>
                            <h2>{{ Lang::get('sige.FamilyMemberSelect') }}</h2>
                        </header>
                        <section>
                            <h2>

                            </h2>
                            <p class="observation"></p>
                            @if(count($users)>0)
                                <sigeturbo-family-members
                                        :members="{{ json_encode($users,true) }}"></sigeturbo-family-members>
                            @else
                                <?php // TODO: Without Family Members. ?>
                            @endif
                        </section>
                        <footer>
                            <div>{{ mb_strtoupper(config('app.company')) }}</div>
                        </footer>
                    </article>
                </section>
            </section>
        </section>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('/js/vendor/vendor.js')) !!}
    {!! HTML::script(mix('/js/Utils.js')) !!}
@stop
@section("script")
    {!! HTML::script(mix('js/' . getCurrentRoute() . '/' . getCurrentApp() .  '.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
@stop