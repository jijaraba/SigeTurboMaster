<?php
$categoryOld = '';
$categoryNew = '';
?>
<?php $first = true; ?>
@foreach($users as $user)
<?php
    $categoryOld = $categoryNew;
    $categoryNew = $user->idcategory;
    ?>
    @if(!$first && $categoryOld != $categoryNew )
        <h4>{{  $user->category }}</h4>
    @elseif($first)
        <h4>{{  $user->category }}</h4>
        <?php $first = false; ?>
    @endif
    <ul id="student-list-normal">
        <li>
            <a href="{{ URL::route('admissions.students.edit',['user' => $user->iduser,'search' => json_encode($search), 'view' => $view, 'page' => $users->currentPage()]) }}">
                <div class="user" id="user" data-user-id="{{ $user->iduser }}">
                    <div class="body" id="user_{{$user->iduser}}">
                        <div class="image {{ statusPhoto($user->status) }}">
                            <img src="{{env('ASSETS_SERVER')}}/img/users/{{$user->photo}}"
                                 alt="{{ $user->lastname }}"
                                 title="{{ $user->lastname ." ". $user->firstname }}"/>
                        </div>
                    </div>
                    <div class="lead">
                        {{ $user->firstname }}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </li>
    </ul>
@endforeach