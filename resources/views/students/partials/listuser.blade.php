<ul id="student-list-simple">
    @foreach($users as $user)
        <li class="col-100">
            <ul class="display-horizontal col-100 user {{ statusList($user->status) }}">
                <li class="col-10 photo">
                    <div>
                        <img src="{{env('ASSETS_SERVER')}}/img/users/{{$user->photo}}" alt="{{ $user->lastname }}" title="{{ $user->lastname ." ". $user->firstname }}"/>
                    </div>
                </li>
                <li class="col-10 code">
                    {{ $user->iduser }}
                </li>
                <li class="col-30 name">
                    {{ $user->lastname ." ". $user->firstname }}
                </li>
                <li class="col-10 edit">
                    <a href="{{ URL::route('admissions.students.edit',['user' => $user->iduser, 'search' => json_encode($search), 'view' => $view, 'page' => $students->currentPage()]) }}">Edit</a>
                </li>
            </ul>
        </li>
    @endforeach
</ul>