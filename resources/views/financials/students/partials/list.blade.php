<ul id="student-list-simple">
    @foreach($students as $student)
        <li class="col-100">
            <ul class="display-horizontal col-100 student {{ statusList($student->status) }}">
                <li class="col-10 photo">
                    <div>
                        <img src="{{env('ASSETS_SERVER')}}/img/users/{{$student->photo}}" alt="{{ $student->lastname }}" title="{{ $student->lastname ." ". $student->firstname }}"/>
                    </div>
                </li>
                <li class="col-10 code">
                    {{ $student->iduser }}
                </li>
                <li class="col-30 name">
                    {{ $student->lastname ." ". $student->firstname }}
                </li>

                <li class="col-15 group">
                    {{ $student->group  }}
                </li>
                <li class="col-15 register">
                    {{ $student->register  }}
                </li>
                <li class="col-10 status">
                    {{ $student->statusName  }}
                </li>
                <li class="col-10 edit">
                    <a href="{{ URL::route('financials.students.transactions',['student' => $student->iduser, 'year' => $year, 'search' => json_encode($search), 'view' => $view, 'sort' => $sort, 'order' => $order, 'page' => $students->currentPage()]) }}">Edit</a>
                </li>
            </ul>
        </li>
    @endforeach
</ul>