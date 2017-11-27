<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * ===================================
 * Pages Controller
 * ===================================
 */

/**
 * Pages Controller
 */
Route::get('/portal', [
    'as' => 'portal',
    'uses' => 'PagesController@index'
]);
Route::resource('pages', 'PagesController');

/**
 * ===================================
 * Authentication Module
 * ===================================
 */
Auth::routes();
Route::get('/logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout',
]);


/**
 * ===================================
 * Guest Module
 * ===================================
 */
//Tasks
Route::get('/tasks', [
    'as' => 'guest.tasks.index',
    'uses' => 'TasksController@index'
]);
Route::post('/tasks', [
    'as' => 'guest.tasks.index',
    'uses' => 'TasksController@index'
]);
Route::get('/tasks/{taskID}', [
    'as' => 'guest.tasks.gettask',
    'uses' => 'TasksController@gettask'
]);
Route::get('/tasks/gettasks', [
    'as' => 'guest.tasks.gettasks',
    'uses' => 'TasksController@getTasks'
]);
//Homeworks
Route::get('/homeworks', [
    'as' => 'guest.tasks.index',
    'uses' => 'TasksController@index'
]);
Route::post('/homeworks', [
    'as' => 'guest.tasks.index',
    'uses' => 'TasksController@index'
]);
Route::get('/homeworks/{taskID}', [
    'as' => 'guest.tasks.gettask',
    'uses' => 'TasksController@gettask'
]);
Route::get('/homeworks/gettasks', [
    'as' => 'guest.tasks.gettasks',
    'uses' => 'TasksController@getTasks'
]);
Route::get('/homeworks/detail/{task}/', [
    'as' => 'guest.tasks.detail',
    'uses' => 'TasksController@getDetail'
]);

//Payments
Route::get('/payments/', [
    'as' => 'guest.payments.guest',
    'uses' => 'PaymentsController@guest'
]);

//Lists Attendancess
Route::get('/homeworks/detail/{task}/', [
    'as' => 'guest.tasks.detail',
    'uses' => 'TasksController@getDetail'
]);


/**
 * ===================================
 *  Views By Roles
 * ===================================
 */
Route::group(['prefix' => 'view', 'as' => 'view.', 'middleware' => ['auth']], function () {

    /* --- GroupdirectorViewController ---*/
    Route::get('/groupdirector', [
        'as' => 'groupdirector.dashboard',
        'uses' => 'GroupdirectorViewController@index'
    ]);
    Route::get('/groupdirector/student/{student}', [
        'as' => 'groupdirector.student',
        'uses' => 'GroupdirectorViewController@student'
    ]);

});

/**
 * ===================================
 * Authenticated Area
 * ===================================
 */
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {


    /**
     * ===================================
     * Dashboard Module
     * ===================================
     */

    /* --- HomeController ---*/
    Route::get('/home', [
        'as' => 'home',
        'uses' => 'HomeController@dashboard'
    ]);
    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@dashboard'
    ]);
    Route::get('/dashboard', [
        'middleware' => ['auth', 'permission'],
        'as' => 'dashboard',
        'uses' => 'HomeController@dashboard'
    ]);

    /**
     * ===================================
     * Security Module
     * ===================================
     */

    /**
     * ===================================
     * Token
     * ===================================
     */
    /* --- Authentication routes ---*/
    Route::get('/gettoken', function () {
        return response()->json(array(
            'token' => \SigeTurbo\User::find(Auth::user()->iduser)->api_token,
            'user' => Auth::user()->iduser
        ));
    });

    /**
     * ===================================
     * Roles
     * ===================================
     */
    /* --- RolesController ---*/
    Route::get('/roles', [
        'as' => 'roles',
        'uses' => 'RolesController@index'
    ]);
    Route::post('/roles', [
        'as' => 'roles.store',
        'uses' => 'RolesController@store'
    ]);


    /**
     * ===================================
     * Settings Module
     * ===================================
     */
    /* --- SettingsController ---*/
    Route::get('/settings', [
        'middleware' => ['auth', 'permission'],
        'as' => 'settings',
        'uses' => 'SettingsController@index'
    ]);
    Route::get('/settings/points', [
        'middleware' => ['auth', 'permission'],
        'as' => 'settings.points',
        'uses' => 'SettingsController@index'
    ]);

    /**
     * ===================================
     * Notifications Module
     * ===================================
     */
    /* --- NotificationsController ---*/
    Route::get('/notifications/user/{user}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'notificationsbyuser',
        'uses' => 'NotificationsController@notificationsbyuser'
    ]);
    Route::resource('notifications', 'NotificationsController', ['only' => ['index', 'show']]);
    Route::resource('notificationusers', 'NotificationusersController', ['only' => ['index', 'show']]);

    /**
     * ===================================
     * Profile Module
     * ===================================
     */
    /* --- UserController ---*/
    Route::get('/profile/{user}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'profile',
        'uses' => 'UsersController@profile'
    ]);


    /**
     * ===================================
     * Payments Fails
     * ===================================
     */
    Route::get('/errors/payments', ['as' => 'payments_fails', function () {
        return view('errors.payments');
    }]);


    /**
     * ===================================
     * Uploads
     * ===================================
     */
    /* --- Upload Task File ---*/
    Route::post('/uploadtask/', [
        'middleware' => ['auth', 'permission'],
        'as' => 'uploads.tasks.upload',
        'uses' => 'UploadsController@uploadTask'
    ]);

    /* --- Delete Task File ---*/
    Route::get('/deletetask/', [
        'middleware' => ['auth', 'permission'],
        'as' => 'uploads.tasks.delete',
        'uses' => 'UploadsController@deleteTask'
    ]);

    Route::post('/uploadconsent/', [
        'middleware' => ['auth', 'permission'],
        'as' => 'uploads.consents.upload',
        'uses' => 'UploadsController@uploadConsent'
    ]);

    /* --- Delete Consent File ---*/
    Route::get('/deleteconsent/', [
        'middleware' => ['auth', 'permission'],
        'as' => 'uploads.consents.delete',
        'uses' => 'UploadsController@deleteConsent'
    ]);

    /**
     * ===================================
     * Queues
     * ===================================
     */
    /* --- Send Welcome Message ---*/
    Route::get('/push', ['middleware' => ['auth', 'permission'], 'as' => 'push', function () {
        //$users = User::whereIn('iduser', [496613])->get();
        //$users = User::whereIn('role',['Admin','Teacher','Principal','HelpDesk','Academic','Admission','Communicator','Vicerrector'])->get();
        //$users = User::where('iduser','=',3507641)->get();
        $users = User::whereIn('iduser', [1017176838])->get();
        foreach ($users as $user) {
            Queue::push('Sige\Queue\WelcomeService', $user);
        }

    }]);

    /* --- Send Features Message ---*/
    Route::get('/push/features', ['middleware' => ['auth', 'permission'], 'as' => 'push.features', function () {

        $users = \SigeTurbo\User::whereIn('iduser', [3507641, 43562235, 1035423482, 42891515, 70414611, 24538595, 43576768, 43757560, 43735663, 1129968, 70251742, 321908, 43746806, 71374881, 42683099, 1129968, 32519488, 98645190, 30028612, 1017156757, 43758533, 42683099, 43742279, 71225157, 43988784, 98549388, 71393434, 70089692, 71054642, 1088016877, 98706062, 43731819, 43023238, 1128270796, 43828759, 43985864, 43821280, 43092198, 71789320, 1214713136, 24317171, 43746806, 42795189, 42693761, 1037593489, 98671175, 43758472, 43977730, 1152448449, 71364639, 37860862, 43028771, 43079364, 98526885, 43826243, 1128271005, 1053827219, 43990114, 3399760, 1017176838, 1094902356, 43870654, 15331964, 9998635, 75076995, 43604319, 71624962, 52892811, 8125026, 15324616])
            ->where('email_confirmed', '=', '1')
            ->get();
        foreach ($users as $user) {
            Queue::push('SigeTurbo\Queue\FeaturesService', array('user' => $user));
        }
        return "OK";
    }]);

    /**
     * ===================================
     * Admissions Module
     * ===================================
     */
    /* --- AdmissionsController ---*/
    Route::get('/admissions', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.dashboard',
        'uses' => 'AdmissionsController@index'
    ]);
    //Students
    Route::get('/admissions/students', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.students.index',
        'uses' => 'StudentsController@index'
    ]);
    Route::post('/admissions/students', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.students.index',
        'uses' => 'StudentsController@index'
    ]);
    //Students
    Route::get('/admissions/users', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.users.index',
        'uses' => 'StudentsController@users'
    ]);
    //Students
    Route::post('/admissions/users', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.users.index',
        'uses' => 'StudentsController@users'
    ]);
    Route::get('/admissions/students/create', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.students.create',
        'uses' => 'StudentsController@create'
    ]);
    Route::post('/admissions/students/store', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.students.store',
        'uses' => 'StudentsController@store'
    ]);
    Route::get('/admissions/students/edit/{student}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.students.edit',
        'uses' => 'StudentsController@edit'
    ]);
    Route::put('/admissions/students/{student}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.students.update',
        'uses' => 'StudentsController@update'
    ]);
    //Transports
    Route::get('/admissions/transports', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.transports.index',
        'uses' => 'TransportsController@index'
    ]);
    Route::post('/admissions/transports', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.transports.index',
        'uses' => 'TransportsController@index'
    ]);


    //Families
    Route::get('/admissions/families', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.families.index',
        'uses' => 'FamiliesController@index'
    ]);
    Route::post('/admissions/families/store', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.families.store',
        'uses' => 'FamiliesController@store'
    ]);
    Route::post('/admissions/families/assign', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.families.assign',
        'uses' => 'UserfamiliesController@assign'
    ]);
    //Identification
    Route::post('/admissions/identifications/store', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.identifications.store',
        'uses' => 'IdentificationsController@store'
    ]);
    Route::put('/admissions/identifications/{student}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.identifications.update',
        'uses' => 'IdentificationsController@update'
    ]);
    //Healthinformation
    Route::post('/admissions/healthinformations/store', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.healthinformations.store',
        'uses' => 'HealthinformationsController@store'
    ]);
    Route::put('/admissions/healthinformations/{student}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.healthinformations.update',
        'uses' => 'HealthinformationsController@update'
    ]);
    //origeninformation
    Route::post('/admissions/origeninformations/store', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.origeninformations.store',
        'uses' => 'OrigeninformationsController@store'
    ]);
    Route::put('/admissions/origeninformations/{student}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.origeninformations.update',
        'uses' => 'OrigeninformationsController@update'
    ]);
    //Responsible Parents
    Route::post('/admissions/responsibleparents/store', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.responsibleparents.store',
        'uses' => 'ResponsibleparentsController@store'
    ]);
    Route::put('/admissions/responsibleparents/{student}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.responsibleparents.update',
        'uses' => 'ResponsibleparentsController@update'
    ]);
    //Enrollment Reason
    Route::post('/admissions/schoolinformations/store', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.schoolinformations.store',
        'uses' => 'SchoolinformationsController@store'
    ]);
    Route::put('/admissions/schoolinformations/{student}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.schoolinformations.update',
        'uses' => 'SchoolinformationsController@update'
    ]);

    /**
     * ===================================
     * Finalcials Module
     * ===================================
     */
    /* --- FinalcialsController ---*/
    Route::get('/financials', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.dashboard',
        'uses' => 'FinancialsController@index'
    ]);
    //Students
    Route::get('/financials/students', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.students.index',
        'uses' => 'StudentsController@financial'
    ]);
    Route::post('/financials/students', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.students.index',
        'uses' => 'StudentsController@financial'
    ]);
    //Transactions
    Route::get('/financials/students/{student}/transactions', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.students.transactions',
        'uses' => 'FinancialsController@transactions'
    ]);
    //Payments
    Route::get('/financials/payments', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.payments.index',
        'uses' => 'PaymentsController@index'
    ]);
    Route::post('/financials/payments', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.payments.index',
        'uses' => 'PaymentsController@index'
    ]);
    Route::get('/financials/payments/create', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.payments.create',
        'uses' => 'PaymentsController@create'
    ]);
    Route::get('/financials/payments/edit/{payment}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.payments.edit',
        'uses' => 'PaymentsController@edit'
    ]);
    Route::get('/financials/payments/convert', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.payments.convert',
        'uses' => 'PaymentsController@paymentsConvert'
    ]);
    Route::get('/financials/payments/convert/virtualreceipt', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.payments.convert.virtualreceipt',
        'uses' => 'PaymentsController@paymentsConvertVirtualReceipt'
    ]);
    Route::get('/financials/payments/convert/manualreceipt', [
        'middleware' => ['auth', 'permission'],
        'as' => 'financials.payments.convert.manualreceipt',
        'uses' => 'PaymentsController@paymentsConvertManualReceipt'
    ]);

    /**
     * ===================================
     * Formation Module
     * ===================================
     */
    /* --- FormationController ---*/
    Route::get('/formation', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.dashboard',
        'uses' => 'FormationController@index'
    ]);

    /* --- IndicatorsController ---*/
    Route::get('/formation/indicators', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.indicators.index',
        'uses' => 'IndicatorsController@index'
    ]);

    /* --- MonitoringtypesController ---*/
    Route::get('/formation/monitoringtypes', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.monitoringtypes.index',
        'uses' => 'MonitoringtypesController@index'
    ]);

    /* --- MonitoringsController ---*/
    Route::get('/formation/monitorings', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.monitorings.index',
        'uses' => 'MonitoringsController@index'
    ]);
    Route::get('/monitorings/push/parents', [
        'middleware' => ['auth', 'permission'],
        'as' => 'push.monitorings',
        'uses' => 'MonitoringsController@sendMonitoringsToParents'
    ]);

    /* --- AttendancesController ---*/
    Route::get('/formation/attendances', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.attendances.index',
        'uses' => 'AttendancesController@index'
    ]);
    Route::get('/formation/attendances/showbystudent', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.attendances.showbystudent',
        'uses' => 'AttendancesController@showByStudent'
    ]);
    Route::get('/formation/attendances/delete/{attendance}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.attendances.delete',
        'uses' => 'AttendancesController@delete'
    ]);

    /* --- ObserversController ---*/
    Route::get('/formation/observator', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.observators.index',
        'uses' => 'ObserversController@index'
    ]);

    /* --- ObserversController ---*/
    Route::get('/formation/observator/create/{year}/{group}/{student}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.observators.create',
        'uses' => 'ObserversController@create'
    ]);
    Route::get('/formation/observator/{year}/{group}/{student}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.observators.showbystudent',
        'uses' => 'ObserversController@showByStudent'
    ]);

    /* --- PartialsController ---*/
    Route::get('/formation/partials', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.partials.index',
        'uses' => 'PartialratingsController@index'
    ]);

    /* --- DescriptivereportsController ---*/
    Route::get('/formation/descriptivereports', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.descriptivereports.index',
        'uses' => 'DescriptivereportsController@index'
    ]);

    /* --- Contracts ---*/
    Route::get('/formation/contracts', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.contracts.init',
        'uses' => 'ContractsController@init'
    ]);

    Route::post('/formation/contracts', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.contracts.init',
        'uses' => 'ContractsController@init'
    ]);

    /* --- Contracts ---*/
    Route::get('/formation/monitoringcategorybyyears', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.monitoringcategorybyyears.init',
        'uses' => 'MonitoringcategorybyyearsController@init'
    ]);

    /* --- QuantitativerecoveryfinalareasController ---*/
    Route::get('/admissions/quantitativerecoveryfinalareas', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.quantitativerecoveryfinalareas.index',
        'uses' => 'QuantitativerecoveryfinalareasController@index'
    ]);

    Route::post('/admissions/quantitativerecoveryfinalareas', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.quantitativerecoveryfinalareas.index',
        'uses' => 'QuantitativerecoveryfinalareasController@index'
    ]);

    //Quantitativerecoveryfinalareas By Users
    Route::get('/admissions/getrecoveriesbyuser', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.quantitativerecoveryfinalareas.getrecoveriesbyuser',
        'uses' => 'QuantitativerecoveryfinalareasController@getrecoveriesbyuser'
    ]);

    //Quantitativerecoveryfinalareas By Users
    Route::post('/admissions/getrecoveriesbyuser', [
        'middleware' => ['auth', 'permission'],
        'as' => 'admissions.quantitativerecoveryfinalareas.getrecoveriesbyuser',
        'uses' => 'QuantitativerecoveryfinalareasController@getrecoveriesbyuser'
    ]);

    /* --- TasksController ---*/
    Route::get('/formation/tasks', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.tasks.index',
        'uses' => 'TasksController@dashboard'
    ]);
    Route::post('/formation/tasks', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.tasks.index',
        'uses' => 'TasksController@dashboard'
    ]);
    Route::get('/formation/tasks/create', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.tasks.create',
        'uses' => 'TasksController@create'
    ]);
    Route::get('/formation/tasks/edit/{task}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.tasks.edit',
        'uses' => 'TasksController@edit'
    ]);
    Route::get('/formation/tasks/update', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.tasks.update',
        'uses' => 'TasksController@update'
    ]);
    Route::get('/formation/tasks/delete/{$task}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.tasks.destroy',
        'uses' => 'TasksController@destroy'
    ]);

    /* --- StatisticsController ---*/
    Route::get('/formation/statistics', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.statistics.index',
        'uses' => 'StatisticsController@index'
    ]);
    Route::get('/formation/statistics/group', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.statistics.group',
        'uses' => 'StatisticsController@group'
    ]);
    Route::get('/formation/statistics/subject', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.statistics.subject',
        'uses' => 'StatisticsController@subject'
    ]);
    Route::get('/formation/statistics/area', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.statistics.area',
        'uses' => 'StatisticsController@area'
    ]);


    //Get Groups Directors
    Route::get('/formation/groupdirectors/init', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.groupdirectors.init',
        'uses' => 'GroupdirectorsController@init'
    ]);


    //Get  Monitoring Categories
    Route::get('/formation/monitoringcategorybyyears/init', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.monitoringcategorybyyears.init',
        'uses' => 'MonitoringcategorybyyearsController@init'
    ]);

    //Get Academics
    Route::get('/formation/academics/init', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.academics.init',
        'uses' => 'AcademicsController@init'
    ]);

    //Get Area Managers
    Route::get('/formation/areamanagers/init', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.areamanagers.init',
        'uses' => 'AreamanagersController@init'
    ]);

    //Get Areas, Subjects And Nivels
    Route::get('/formation/subjects/init', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.subjects.init',
        'uses' => 'SubjectsController@init'
    ]);

    //Get Candidates
    Route::get('/formation/votes/init', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.votes.init',
        'uses' => 'VotesController@init'
    ]);

    //Get Monitorings Pendings By Students
    Route::get('/formation/monitorings/studentspendigsbymonitoring', [
        'middleware' => ['auth', 'permission'],
        'as' => 'formation.monitorings.studentspendigsbymonitoring',
        'uses' => 'MonitoringsController@studentspendigsbymonitoring'
    ]);

    /**
     * ===================================
     * Resources Module
     * ===================================
     */
    /* --- ResourcesController ---*/
    Route::get('/resources', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.dashboard',
        'uses' => 'ResourcesController@index'
    ]);

    /* --- PurchasesController ---*/
    Route::get('/resources/purchases', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.purchases.index',
        'uses' => 'PurchasesController@index'
    ]);
    Route::post('/resources/purchases', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.purchases.index',
        'uses' => 'PurchasesController@index'
    ]);
    Route::get('/resources/purchases/create', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.purchases.create',
        'uses' => 'PurchasesController@create'
    ]);
    Route::get('/resources/purchases/edit/{purchase}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.purchases.edit',
        'uses' => 'PurchasesController@edit'
    ]);

    /* --- DetailsController ---*/
    Route::get('/resources/details/create/{purchase}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.details.create',
        'uses' => 'DetailsController@create'
    ]);

    /* --- ProvidersController ---*/
    Route::get('/resources/providers', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.providers.index',
        'uses' => 'ProvidersController@index'
    ]);
    Route::post('/resources/providers', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.providers.index',
        'uses' => 'ProvidersController@index'
    ]);
    Route::get('/resources/providers/edit/{visitor}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.providers.edit',
        'uses' => 'ProvidersController@edit'
    ]);
    Route::get('/resources/providers/create', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.providers.create',
        'uses' => 'ProvidersController@create'
    ]);

    /* --- VisitorsController ---*/
    Route::get('/resources/visitors', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.visitors.index',
        'uses' => 'VisitorsController@index'
    ]);
    Route::get('/resources/visitors/edit/{visitor}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.visitors.edit',
        'uses' => 'VisitorsController@edit'
    ]);
    Route::get('/resources/visitors/create', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.visitors.create',
        'uses' => 'VisitorsController@create'
    ]);
    Route::delete('/resources/visitors/{visitor}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.visitors.destroy',
        'uses' => 'VisitorsController@destroy'
    ]);

    /* --- AssetsController ---*/
    Route::get('/resources/assets', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.assets.index',
        'uses' => 'AssetsController@index'
    ]);
    Route::post('/resources/assets', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.assets.index',
        'uses' => 'AssetsController@index'
    ]);
    Route::get('/resources/assets/edit/{asset}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.assets.edit',
        'uses' => 'AssetsController@edit'
    ]);
    Route::get('/resources/assets/create', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.assets.create',
        'uses' => 'AssetsController@create'
    ]);
    Route::post('/resources/assets/store', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.assets.store',
        'uses' => 'AssetsController@store'
    ]);
    Route::delete('/resources/assets/{visitor}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.assets.destroy',
        'uses' => 'AssetsController@destroy'
    ]);

    /* --- InventoriesController ---*/
    Route::get('/resources/inventories', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.inventories.index',
        'uses' => 'InventoriesController@index'
    ]);
    Route::get('/resources/inventories/verify/{code}', [
        'middleware' => ['guest'],
        'as' => 'resources.inventories.verify',
        'uses' => 'InventoriesController@verify'
    ]);
    Route::post('/resources/inventories/inventory', [
        'middleware' => ['auth', 'permission'],
        'as' => 'resources.inventories.inventory',
        'uses' => 'InventoriesController@inventory'
    ]);

    /**
     * ===================================
     * Communications Module
     * ===================================
     */
    /* --- CommunicationsController ---*/
    Route::get('/communications', [
        'middleware' => ['auth', 'permission'],
        'as' => 'communications.dashboard',
        'uses' => 'CommunicationsController@index'
    ]);

    /* --- WeeklyevaluationsController ---*/
    Route::get('/communications/weeklyevaluations', [
        'middleware' => ['auth', 'permission'],
        'as' => 'communications.weeklyevaluations.index',
        'uses' => 'WeeklyevaluationsController@index'
    ]);
    Route::post('/communications/weeklyevaluations', [
        'middleware' => ['auth', 'permission'],
        'as' => 'communications.weeklyevaluations.index',
        'uses' => 'WeeklyevaluationsController@index'
    ]);
    Route::get('/communications/weeklyevaluations/edit/{weeklyevaluation}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'communications.weeklyevaluations.edit',
        'uses' => 'WeeklyevaluationsController@edit'
    ]);
    Route::get('/communications/weeklyevaluations/create', [
        'middleware' => ['auth', 'permission'],
        'as' => 'communications.weeklyevaluations.create',
        'uses' => 'WeeklyevaluationsController@create'
    ]);
    Route::delete('/communications/weeklyevaluations/{weeklyevaluation}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'communications.weeklyevaluations.destroy',
        'uses' => 'WeeklyevaluationsController@destroy'
    ]);


    /**
     * ===================================
     * Parents Module
     * ===================================
     */
    /* --- ParentsController ---*/
    Route::get('/parents', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.dashboard',
        'uses' => 'ParentsController@index'
    ]);

    /* --- UserfamiliesController ---*/
    Route::get('/parents/homeworks', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.homeworks.index',
        'uses' => 'UserfamiliesController@indexParentsByHomeworks'
    ]);
    Route::get('/parents/monitorings', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.monitoring.index',
        'uses' => 'UserfamiliesController@indexParentsByMonitorings'
    ]);
    Route::get('/parents/reports', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.reports.index',
        'uses' => 'ReportsController@getReportsByFamily'
    ]);
    Route::get('/parents/monitorings/detail/{year}/{period}/{group}/{subject}/{nivel}/{user}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.monitoring.detail',
        'uses' => 'MonitoringsController@getMonitoringsDetailForParents'
    ]);
    Route::get('/parents/updateinfo', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.updateinfo.index',
        'uses' => 'UserfamiliesController@indexParentsByUpdateInfo'
    ]);

    /* --- PaymentsController ---*/
    Route::get('/parents/payments', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.payments.index',
        'uses' => 'PaymentsController@getPaymentsByFamily'
    ]);
    Route::post('/parents/payments', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.payments.index',
        'uses' => 'PaymentsController@getPaymentsByFamily'
    ]);
    Route::get('/parents/payments/checkout/{payment}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.payments.checkout',
        'uses' => 'PaymentsController@checkout'
    ]);
    Route::get('/parents/payments/detail/{payment}', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.payments.detailpaymentbyparent',
        'uses' => 'PaymentsController@detailPaymentByParent'
    ]);
    Route::get('/parents/payments/respond', [
        'middleware' => ['auth', 'permission'],
        'as' => 'parents.payments.respond',
        'uses' => 'PaymentsController@respond'
    ]);

    /**
     * ===================================
     * Requests
     * ===================================
     */

    //GET Requests
    Route::get('/users/request', [
        'as' => 'users.request.index',
        'uses' => 'RequestsController@index'
    ]);

    /**
     * ===================================
     * Consents
     * ===================================
     */

    //GET Consents
    Route::get('/users/consent', [
        'as' => 'users.consent.index',
        'uses' => 'ConsentsController@index'
    ]);

    /**
     * ===================================
     * Export
     * ===================================
     */
    Route::get('/totxt', [
        'as' => 'totxt',
        'uses' => 'ExportsController@exportTransactionsToTxt'
    ]);

});
