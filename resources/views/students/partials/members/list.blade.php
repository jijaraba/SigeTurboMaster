<h5>{{ $student->userfamily[0]->name }} ({{ $student->userfamily[0]->idfamily }} )</h5>
<ul id="member-list">
    @foreach(\SigeTurbo\Repositories\Userfamily\UserfamilyRepository::findByFamily($student->userfamily[0]->idfamily,$student->iduser) as $member)
        <li>
            <a href="{{ URL::route('admissions.students.edit',['student' => $member->iduser]) }}">
                <div class="member" id="member"
                     data-member-id="{{ $member->iduser }}">
                    <div class="body" id="member_{{$member->iduser}}">
                        <div class="image normal-background">
                            <img src="{{env('ASSETS_SERVER')}}/img/users/{{$member->photo}}"
                                 alt="{{ $member->lastname }}"
                                 title="{{ $member->lastname ." ". $member->firstname }}"/>
                        </div>
                    </div>
                    <div class="lead first">
                        {{ $member->firstname }}
                    </div>
                    <div class="lead last">
                        {{ $member->category }}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </li>
    @endforeach
    <li>
        <a href="{{ URL::route('admissions.students.create') }}">
            <div class="member" id="member" data-member-id="">
                <div class="body" id="member_new">
                    <div class="image normal-background">
                        <img src="{{env('ASSETS_SERVER')}}/img/users/sigeturbo.png"
                             alt="Nuevo Integrante"
                             title="Nuevo Integrante"/>
                    </div>
                </div>
                <div class="lead first">
                    Nuevo
                </div>
                <div class="lead last">
                    Familiar
                </div>
                <div class="clearfix"></div>
            </div>
        </a>
    </li>
</ul>