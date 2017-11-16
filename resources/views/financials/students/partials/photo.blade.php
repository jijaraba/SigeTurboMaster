<?php
$groupOld = '';
$groupNew = '';
?>
<?php $first = true; ?>
@foreach($students as $student)
    <?php
    $groupOld = $groupNew;
    $groupNew = $student->idgroup;
    ?>
    @if(!$first && $groupOld != $groupNew )
        <h4>{{  $student->group }}</h4>
    @elseif($first)
        <h4>{{  $student->group }}</h4>
        <?php $first = false; ?>
    @endif
    <ul id="student-list-normal">
        <li>
            <a href="{{ URL::route('financials.students.transactions',['student' => $student->iduser, 'year' => $year, 'search' => json_encode($search), 'view' => $view, 'sort' => $sort, 'order' => $order, 'page' => $students->currentPage()]) }}">
                <div class="student" id="student" data-student-id="{{ $student->iduser }}">
                    <div class="body" id="student_{{$student->iduser}}">
                        <div class="image {{ statusPhoto($student->status) }}">
                            <img src="{{env('ASSETS_SERVER')}}/img/users/{{$student->photo}}"
                                 alt="{{ $student->lastname }}"
                                 title="{{ $student->lastname ." ". $student->firstname }}"/>
                        </div>
                    </div>
                    <div class="lead">
                        {{ $student->firstname }}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </li>
    </ul>
@endforeach