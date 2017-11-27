@if(Session::has('error'))
    <ul class="flash margin-bottom-10">
        <li class="flash-error">{{ Session::get('error') }}</li>
    </ul>
@elseif (session()->has('success'))
    <ul class="flash margin-bottom-10">
        <li class="flash-success">{{ Session::get('success') }}</li>
    </ul>
@elseif (session()->has('notice'))
    <ul class="flash margin-bottom-10">
        <li class="flash-notice">{{ Session::get('notice') }}</li>
    </ul>
@elseif (Session::has('status'))
    <ul class="flash margin-bottom-10">
        <li class="flash-success">{{ Session::get('status') }}</li>
    </ul>
@elseif (Session::has('warning'))
    <ul class="flash margin-bottom-10">
        <li class="flash-warning">{{ Session::get('warning') }}</li>
    </ul>
@endif
