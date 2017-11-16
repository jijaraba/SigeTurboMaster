<section ng-controller="ReportsController" ng-init="init({{ json_encode($search) }})" id="ReportsController">
    <sige-turbo-formation>
    	<div style="width:100%">
    		<div style="width:@{{ (elementsearch.value == undefined) ? 80 : 45 }}%;float:left" >
        		<sige-turbo-academic-basic-period></sige-turbo-academic-basic-period>
    		</div>
    		<div ng-if="elementsearch.value != undefined" style="width:55%;float:right;font-size: 0.9em;min-height: 250px;background-color: #fff;border-radius: 5px;box-shadow: 0 1px 0 0 rgba(0,0,0,.1);">
    			<sige-turbo-teachers-pendings-by-rating-statistics elementsearch="elementsearch" registries="registries"></sige-turbo-teachers-pendings-by-rating-statistics>
    		</div>
            <div ng-if="elementsearch.value == undefined" style="width:20%;float:right;background-color: #fff;min-height: 250px;position: relative;border-radius: 5px;box-shadow: 0 1px 0 0 rgba(0,0,0,.1);">

                <ul class="display-horizontal col-100">
                    <li class="col-100 gutter-5" style="text-align:center">
                       <h4> Estadisticas </h4>
                    </li>
                    <li class="col-100 gutter-5">
                        Registros pendientes por calificar @{{ resumen.Registries }}
                    </li>
                    <li class="col-100 gutter-5">
                        Grupos pendientes por terminar de calificar @{{ resumen.Groups }}
                    </li>
                     <li class="col-100 gutter-5">
                        Asignaturas pendientes por terminar de calificar @{{ resumen.Subjects }}
                    </li>
                    <li class="col-100 gutter-5">
                        Estudiantes pendientes por terminar de calificar @{{ resumen.Students }}
                    </li>
                </ul>
            </div>
    	</div>
        <sige-turbo-monitoring-pendings-by-students elementsearch="elementsearch" registries="registries" resumen="resumen"></sige-turbo-monitoring-pendings-by-students>
    </sige-turbo-formation>
</section>