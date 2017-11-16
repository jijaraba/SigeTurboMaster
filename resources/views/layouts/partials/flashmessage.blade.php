@if(Session::has('error'))
    <ul class="flash">
        <li class="flash-error">{{ Session::get('error') }}</li>
    </ul>
@elseif (Session::has('success'))
    <ul class="flash">
        <li class="flash-success">{{ Session::get('success') }}</li>
    </ul>
@elseif (Session::has('notice'))
    <ul class="flash">
        <li class="flash-notice">{{ Session::get('notice') }}</li>
    </ul>
@elseif (Session::has('status'))
    <ul class="flash">
        <li class="flash-success">{{ Session::get('status') }}</li>
    </ul>
@elseif (Session::has('warning'))
    <ul class="flash">
        <li class="flash-warning">{{ Session::get('warning') }}</li>
    </ul>
@endif
