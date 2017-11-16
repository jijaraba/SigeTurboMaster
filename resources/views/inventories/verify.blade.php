@extends("layouts.inventories")
@section("title",Lang::get("sige.Ownership"))
@section("inventory")
    <section class="asset-container">
        <h4>The New School</h4>
        @if ($asset)
            <section class="asset">
                <ul class="display-horizontal col-100">
                    <li class="col-100 qr">
                        <img src="{{env('ASSETS_SERVER') . "/assets/qr_code_01.svg"}}" />
                        <div>
                            <img src="{{env('ASSETS_SERVER') . "/img/users/" . $asset->photo}}"  alt="{{ $asset->responsible }}"  title="{{ $asset->responsible }}"/>
                        </div>
                    </li>
                    <li class="col-100 code">
                        <div>{{ $asset->code }}</div>
                    </li>
                    <li class="col-100 name">
                        <div>{{ $asset->name }}</div>
                    </li>
                    <li class="col-100 ubication">
                        <div>{{ $asset->ubication }}</div>
                    </li>
                </ul>
            </section>
        @else
            <p>El código <strong>{{ $code }}</strong> no corresponde a un activo que sea propiedad de la Sociedad Civil
                El Nuevo Colegio S.A.</p>
        @endif
    </section>
@stop
