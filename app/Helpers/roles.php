<?php

/**
 * Name of Roles
 * @param $rol
 * @return mixed
 */
function rolName($rol){
    switch($rol){
        case 'Admin':
            return Lang::get('sige.rolAdmin');
            break;
        case 'Account':
            return Lang::get('sige.rolAccount');
            break;
        case 'Treasurer':
            return Lang::get('sige.rolTreasurer');
            break;
        case 'Teacher':
            return Lang::get('sige.rolTeacher');
            break;
        case 'AreaManager':
            return Lang::get('sige.rolAreaManager');
            break;
        case 'Parents':
            return Lang::get('sige.rolParents');
            break;
        case 'Nurse':
            return Lang::get('sige.rolNurse');
            break;
        case 'Student':
            return Lang::get('sige.rolStudent');
            break;
        case 'Discipline':
            return Lang::get('sige.rolDiscipline');
            break;
        case 'RRHH':
            return Lang::get('sige.rolRRHH');
            break;
        case 'Librarian':
            return Lang::get('sige.rolLibrarian');
            break;
        case 'Communicator':
            return Lang::get('sige.rolCommunicator');
            break;
        case 'Academic':
            return Lang::get('sige.rolAcademic');
            break;
        case 'Principal':
            return Lang::get('sige.rolPrincipal');
            break;
        case 'HelpDesk':
            return Lang::get('sige.rolHelpDesk');
            break;
        case 'Counseling':
            return Lang::get('sige.rolCounseling');
            break;
        case 'HomeroomTeacher':
            return Lang::get('sige.rolHomeroomTeacher');
            break;
        case 'Maintenance':
            return Lang::get('sige.rolMaintenance');
            break;
        case 'Admission':
            return Lang::get('sige.rolAdmission');
            break;
        default:
            return Lang::get('sige.rolGuest');
    }
}
