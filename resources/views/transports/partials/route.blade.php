<section class="sige-turbo-pagination col-100">
    {!! $routes->appends(['search' => json_encode($search)])->render() !!}
</section>