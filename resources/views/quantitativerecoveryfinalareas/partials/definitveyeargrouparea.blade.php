<?php  if($countrecoveries == 0 || $countrecoveries == null  || $countrecoveries == "" ) :?>
<li class="col-65 gutter-5" style="border-right: 1px solid #edeff0;border-bottom: 1px solid #edeff0;">
    <ul id="payment-list display-horizontal col-100">
        <li class="col-100">
            <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                <li class="col-15 gutter-5">
                    {{$pending->Year}}
                </li>
                <li class="col-20 gutter-5">
                    {{$pending->grouprecovery}}
                </li>
                <li class="col-15 gutter-5">
                    {{$pending->Provenance}}
                </li>
                <li class="col-35 gutter-5">
                    {{$pending->arearecovery}}
                </li>
                <li class="col-15 gutter-5" style="text-align: center;">
                    <div 
                        <?php  if (is_numeric($pending->RatingYear) == 1 ) { if($pending->RatingYear < 3) echo 'style="background:#da4453;"' ; }
                        else{ if ($pending->RatingYear  === 'Insuficiente' || $pending->RatingYear  === 'Deficiente')  echo 'style="background:#da4453;"'; } ?> 

                    > {{$pending->RatingYear}} </div>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="col-35 gutter-5" style="border-bottom: 1px solid #edeff0;">
    <ul id="payment-list display-horizontal col-100">
        <li class="col-100">
            <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                <li class="col-15 gutter-5">
                    {{$pending->idyear}} 
                </li>
                <li class="col-20 gutter-5" style="text-align: center;">
                    {{$pending->rating}} 
                </li>
                <li class="col-15 gutter-5" style="text-align: center;">
                    {{$pending->act}} 
                </li>
                <li class="col-25 gutter-5">
                    {{$pending->recovery_at}} 
                </li>
                <li class="col-15 photo">
                    <?php  if($pending->teacher_photo <> "" ):  ?>
                    <div style="position: relative;margin: -5% 0% 10% 30%;width: 50px;height: 50px;border-radius: 50%;padding: 3px;background-color: #53bbb4;"> 
                        <img style="border-radius: 40%;"  src="{{env('ASSETS_SERVER')}}/img/users/{{$pending->teacher_photo}}" alt="{{ $pending->teacher }}" title="{{ $pending->teacher }} ({{ $pending->idteacher }})"/>                                        
                    </div>
                    <?php endif; ?> 
                </li>
                <li class="col-10 gutter-5" style="text-align: right;">
                    <div>
                        <a style="cursor: pointer;color:#53bbb4;" 
                            <?php if($pending->RatingYear < 3 && ($pending->rating == "" || $pending->rating == null )): ?> 
                                ng-click='changeItem(1,{{  json_encode($recoveries) }})' 
                            <?php endif; ?> >
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                        </a>
                     </div>
                </li>
            </ul>
        </li>
    </ul>
</li>
<?php elseif($countrecoveries > 0)  : $style = ($countrecoveries > 1) ? "padding-top:". ($countrecoveries * 3)."%;" : "";?>
<li class="col-65 gutter-5" style="border-right: 1px solid #edeff0;border-bottom: 1px solid #edeff0;">
    <ul id="payment-list display-horizontal col-100">
        <li class="col-100">
            <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                <li class="col-15 gutter-5" style="{{$style}}">
                    {{$pending->Year}}
                </li>
                <li class="col-20 gutter-5" style="{{$style}}">
                    {{$pending->grouprecovery}}
                </li>
                <li class="col-15 gutter-5" style="{{$style}}">
                    {{$pending->Provenance}}
                </li>
                <li class="col-35 gutter-5" style="{{$style}}">
                    {{$pending->arearecovery}}
                </li>
                <li class="col-15 gutter-5" style="text-align: center;{{$style}}">
                    <div 
                        <?php  if (is_numeric($pending->RatingYear) == 1 ) { if($pending->RatingYear < 3) echo 'style="background:#da4453;"' ; }
                        else{ if ($pending->RatingYear  === 'Insuficiente' || $pending->RatingYear  === 'Deficiente')  echo 'style="background:#da4453;"'; } ?> 

                    > {{$pending->RatingYear}} </div>
                </li>
            </ul>
        </li>
    </ul>            
</li>
<?php $teacherrecoveries = json_decode(json_decode(json_encode($pending),true)['amountrecoveriesdescriptionteachers'], true); ?> 
<li class="col-35 gutter-5" style="border-bottom: 1px solid #edeff0;">
    <ul id="payment-list display-horizontal col-100">
        <li class="col-100">
            <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-weight: bold;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                @foreach($recoveries as $index => $recovery)
                        <li class="col-15 gutter-5">
                            {{$recovery['idyear']}} 
                        </li>
                            <?php 
                                $sizefont = '0.6';
                                if(isset($recovery['idassessment'])){
                                    $sizefont = '0.48';
                                    switch ($recovery['idassessment']) {
                                        case 1 : $pending->ratingstring = "Excelente";break;
                                        case 2 : $pending->ratingstring = "Sobresaliente"; break;
                                        case 3: $pending->ratingstring = "Aceptable"; break;
                                        case 4: $pending->ratingstring = "Insuficiente"; break;
                                        case 5:  $pending->ratingstring = "Deficiente"; break;
                                    }
                                }else $pending->ratingstring = $recovery['rating'];
                            ?>
                        <li class="col-20 gutter-5" style="text-align: center; font-size: {{$sizefont}}vw !important;">
                            {{$pending->ratingstring}} 
                        </li>
                        <li class="col-15 gutter-5" style="text-align: center;">
                            {{$recovery['act']}} 
                        </li>
                        <li class="col-25 gutter-5" style="text-align: center; font-size: {{$sizefont}}vw !important;">
                            {{$recovery['recovery_at']}} 
                        </li>
                        <li class="col-15 photo">
                            <?php  if($teacherrecoveries[$index]['teacher_photo'] <> "" ):  ?>
                            <div style="position: relative;margin: -5% 0% 10% 30%;width: 50px;height: 50px;border-radius: 50%;padding: 3px;background-color: #53bbb4;"> 
                                <img style="border-radius: 40%;"  src="{{env('ASSETS_SERVER')}}/img/users/{{$teacherrecoveries[$index]['teacher_photo']}}" alt="{{ $teacherrecoveries[$index]['teacher'] }}" title="{{ $teacherrecoveries[$index]['teacher'] }} ({{ $pending->idteacher }})"/>                                        
                            </div>
                            <?php endif; ?> 
                        </li>
                        <li class="col-10 gutter-5" style="text-align: right;">
                            <div>
                                <a style="cursor: pointer;color:#53bbb4;" ng-click='changeItem(2,{{  json_encode($recovery) }})' >
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                </a>
                             </div>
                        </li>
                @endforeach
            </ul>
        </li>
    </ul>
</li>
<?php endif;?>