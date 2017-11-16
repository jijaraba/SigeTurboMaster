{!! Form::open(array('route' => array('admissions.responsibleparents.update',$student->responsibleparent->idresponsibleparent),'method' => 'PUT')) !!}
<section class="sige-members">
    <ul id="member-list">
        @foreach(\SigeTurbo\Repositories\Userfamily\UserfamilyRepository::findByFamily($student->userfamily[0]->idfamily,$student->iduser) as $member)
            @if($member->idcategory <> 13)
                <li class="col-20 gutter-5">
                    <a  onclick="getElementById('responsible').value='{{ $member->iduser }}'">
                        <div class="member" id="member" data-member-id="{{ $member->iduser }}">
                            <div class="body" id="member_{{$member->iduser}}">
                                <div class="image normal-background">
                                    <img src="{{env('ASSETS_SERVER')}}/img/users/{{$member->photo}}" alt="{{ $member->lastname }}" title="{{ $member->lastname ." ". $member->firstname }}"/>
                                </div>
                            </div>
                            <div class="lead first"> {{ $member->firstname }} </div>
                            <div class="lead last"> {{ $member->category }} <div class="clearfix"></div>
                        </div>
                    </a>
                </li>
            @endif
        @endforeach
        <li class="col-30 gutter-5" style="padding: 5%;">
            <input type="text" id="responsible" name="responsible" value="{{ $student->responsibleparent->responsible }}" placeholder="{{ Lang::get('sige.ResponsibleparentNew') }}">
        </li>
        <li class="col-10 gutter-5" style="padding: 5%;">
            <button id="search" type="submit" class="btn btn-aquamarine">{{ Lang::get('sige.Save') }}</button>
        </li>
    </ul> 
</section>
<input type="hidden" id="responsibleparent_user" name="responsibleparent_user" value="{{ $student->iduser }}">
{!! Form::close() !!}