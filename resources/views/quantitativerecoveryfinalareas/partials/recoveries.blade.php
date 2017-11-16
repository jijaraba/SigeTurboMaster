<?php if(count($pendings) > 0) :?>
<section class="sige-student-family ng-scope">
    <ul class="display-horizontal col-100">
       <li class="col-100">
            <section class="sige-members">
                <?php $i = 0; ?>
                @foreach($pendings as $index => $pending)
                    @if($i == 0)
                        <div>
                           <h5 style="float: right;width: 90%;">{{ $pending->Student }} ({{ $pending->iduser }}  )</h5>
                           <div style="float: left;text-align: center;margin: 0;border-bottom: 1px solid #eee;background: #f5f5f5;border-top-left-radius: 5px;border-top-right-radius: 5px;width: 10%;">
                                <div style="position: relative;top: 40%;text-align: center;margin: 5px auto;width: 50px;height: 50px;border-radius: 50%;padding: 3px;background-color: #53bbb4;">
                                    <img style="border-radius: 50%;" src="{{env('ASSETS_SERVER')}}/img/users/{{$pending->photo}}" alt="{{ $pending->photo }}"
                                                                title="{{ $pending->photo }} ({{ $pending->Student }})"/>
                                </div>
                           </div>
                        </div>
                    @endif
                     <?php $i++; ?>
                @endforeach 
                <sige-turbo-admissions-recovery-final search="{{json_encode($search)}}" recovery="@{{newrecovery}}" ng-show="show1290"></sige-turbo-admissions-recovery-final>                          
                <sige-turbo-admissions-recovery-final-qualitative search="{{json_encode($search)}}" recoveryquali="@{{newrecovery}}" ng-show="show0230"></sige-turbo-admissions-recovery-final-qualitative> 
            </section>
        </li>
    </ul>
</section>
<section class="payment-list" style="margin-top: 10px;">
    <ul id="payment-list display-horizontal col-100">
        <li class="col-100">
            <ul class="display-horizontal col-100 payment">
                <li class="payments col-100">
                    <ul id="payment-list display-horizontal col-100">
                        <li class="col-100">
                                <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-weight: bold;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                                    <li class="col-65 gutter-5" style="border-right: 1px solid #edeff0">
                                        <div style="text-align: center;">Definitiva por Año Académico Grupo y Area</div>
                                    </li>                                   
                                    <li class="col-35 gutter-5">
                                        <div style="text-align: center;">Recuperaciones por Grupo y Area</div>
                                    </li>
                                </ul>
                                <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-weight: bold;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                                    <li class="col-65 gutter-5" style="border-right: 1px solid #edeff0">
                                        <ul id="payment-list display-horizontal col-100">
                                            <li class="col-100">
                                                <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-weight: bold;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                                                    <li class="col-15 gutter-5">
                                                        Año
                                                    </li>                                   
                                                    <li class="col-20 gutter-5">
                                                        Grupo
                                                    </li>
                                                    <li class="col-15 gutter-5">
                                                        Proveniencia
                                                    </li>
                                                    <li class="col-35 gutter-5">
                                                       Area
                                                    </li>
                                                    <li class="col-15 gutter-5">
                                                        Nota
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="col-35 gutter-5">
                                        <ul id="payment-list display-horizontal col-100">
                                            <li class="col-100">
                                                <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-weight: bold;font-size: 15px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;text-align: center;">
                                                    <li class="col-15 gutter-5">
                                                        Año
                                                    </li>
                                                    <li class="col-20 gutter-5">
                                                        Nota
                                                    </li>
                                                    <li class="col-15 gutter-5">
                                                        Acta
                                                    </li>
                                                    <li class="col-25 gutter-5">
                                                        Fecha
                                                    </li>
                                                    <li class="col-15 gutter-5">
                                                        Profesor
                                                    </li>
                                                    <li class="col-10 gutter-5">

                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                        </li>
                        <li class="col-100">
                                <ul style="font-family: 'Gotham Rounded Book',Helvetica Neue,Helvetica,sans-serif;font-size: 14px;display: -ms-flexbox;display: flex;-ms-flex-direction: row;flex-direction: row;-ms-flex-pack: start;justify-content: flex-start;-ms-flex-flow: row wrap;flex-flow: row wrap;">
                                    @foreach($pendings as $pending)
                                        <?php  
                                            $countrecoveries = $pending->amountrecoveries;
                                            if($countrecoveries > 0){
                                                $recoveries = json_decode(json_decode(json_encode($pending),true)['amountrecoveriesdescription'], true); 
                                            }else{
                                                $recoveries = array('tablesource' => $pending->tablesource,"idprovenance" => $pending->idprovenance ,"idarea" => $pending->idarea ,"idgroup" => $pending->idgroup,"iduser" => $pending->iduser);
                                            }
                                        ?>
                                        @include('quantitativerecoveryfinalareas.partials.definitveyeargrouparea', ['pending' => $pending,'recoveries' => $recoveries,'countrecoveries' => $countrecoveries])
                                    @endforeach
                                </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</section>
<?php endif ?>