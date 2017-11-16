<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'as' => 'api.v1.', 'middleware' => ['throttle:2500,10', 'auth:api', 'permission']], function () {

    /**
     * ===================================
     * Settings
     * ===================================
     */
    Route::get('/points/getpoints', [
        'as' => 'api.v1.settings.getpoints',
        'uses' => 'SettingsController@getpoints'
    ]);

    /**
     * ===================================
     * Assets
     * ===================================
     */
    //Verified
    Route::get('/assets/setverified', [
        'as' => 'api.v1.assets.setverified',
        'uses' => 'AssetsController@setVerified'
    ]);
    //Global Assets
    Route::resource('assets', 'AssetsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));


    /**
     * ===================================
     * Banks
     * ===================================
     */
    //Global Banks
    Route::resource('banks', 'BanksController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Academics
     * ===================================
     */
    //GET academics by years
    Route::get('/academics/getacademicsbyyear/year/{idyear}', [
        'as' => 'api.v1.academics.getacademicsbyyear',
        'uses' => 'AcademicsController@getacademicsbyyear'
    ]);
    //Academics
    Route::resource('academics', 'AcademicsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Acls
     * ===================================
     */
    //Acls
    Route::resource('acls', 'AclsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Attendances
     * ===================================
     */
    //Get Attendances Amount By Date
    Route::get('/attendances/getattendancesamountbydate', [
        'as' => 'api.v1.attendances.getattendancesamountbydate',
        'uses' => 'AttendancesController@getAttendancesAmountByDate'
    ]);
    //Global Attendances
    Route::resource('attendances', 'AttendancesController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Contracts
     * ===================================
     */
    //Get Contracts By years and periods
    Route::get('/contracts/getcontractsbyyearandperiod', [
        'as' => 'api.v1.contracts.getcontractsbyyearandperiod',
        'uses' => 'ContractsController@getcontractsbyyearandperiod'
    ]);

    //Get Contracts By params
    Route::get('/contracts/getcontractsbyparams', [
        'as' => 'api.v1.contracts.getcontractsbyparams',
        'uses' => 'ContractsController@getContractsByParams'
    ]);

    //Global Contracts
    Route::resource('contracts', 'ContractsController', array('only' => array('index', 'show', 'store', 'update')));

    /**
     * ===================================
     * Group Directors
     * ===================================
     */

    //GET Group Director By Year or Group
    Route::get('/groupdirectors/getgroupdirectorsbyyear', [
        'as' => 'api.v1.groupdirectors.getgroupdirectorsbyyear',
        'uses' => 'GroupdirectorsController@getgroupdirectorsbyyear'
    ]);

    //Group Directors
    Route::resource('groupdirectors', 'GroupdirectorsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    //Consents
    Route::resource('consents', 'ConsentsController', array('only' => array('index', 'store', 'update', 'destroy')));

    //Consenttypes
    Route::resource('consenttypes', 'ConsenttypesController', array('only' => array('index')));


    //Requests
    Route::resource('requests', 'RequestsController', array('only' => array('store', 'update', 'destroy')));

    /**
     * ===================================
     * Area Managers
     * ===================================
     */

    //GET Area Manager By Year or Group
    Route::get('/areamanagers/getareamanagersbyyear', [
        'as' => 'api.v1.areamanagers.getareamanagersbyyear',
        'uses' => 'AreamanagersController@getareamanagersbyyear'
    ]);

    //Area Managers
    Route::resource('areamanagers', 'AreamanagersController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Areas
     * ===================================
     */

    //GET Areas By Year
    Route::get('/areas/getareasbyyear', [
        'as' => 'api.v1.areas.getareasbyyear',
        'uses' => 'AreasController@getareasbyyear'
    ]);

    //Academic Area
    Route::resource('areas', 'AreasController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Achievement
     * ===================================
     */
    //Get Achievements
    Route::get('/achievements/getachievementsbygroup', [
        'as' => 'api.v1.achievements.getachievementsbygroup',
        'uses' => 'AchievementsController@getAchievements'
    ]);
    //Achievements
    Route::resource('achievements', 'AchievementsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Categories
     * ===================================
     */
    //Category
    Route::resource('categories', 'CategoriesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Countries
     * ===================================
     */
    //Country
    Route::resource('countries', 'CountriesController', array('only' => array('index', 'show')));


    /**
     * ===================================
     * Costcenters Module
     * ===================================
     */
    Route::get('/costcenters/getcostcenterbystudent', [
        'as' => 'api.v1.costcenters.getcostcenterbystudent',
        'uses' => 'CostcentersController@getCostcenterByStudent'
    ]);


    /**
     * ===================================
     * Departments
     * ===================================
     */
    //Departments
    Route::resource('departments', 'DepartmentsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Enrollment
     * ===================================
     */
    //Get Enrollments
    Route::get('/academics/getperiodsbyyear/year/{idyear}', [
        'as' => 'api.v1.academics.getperiodsbyyear',
        'uses' => 'AcademicsController@getperiodsbyyear'
    ]);

    /**
     * ===================================
     * Enrollment
     * ===================================
     */
    //Get Enrollments
    Route::get('/enrollments/getenrollments/year/{idyear}/group/{idgroup}', [
        'as' => 'api.v1.enrollments.getenrollments',
        'uses' => 'EnrollmentsController@getenrollments'
    ]);
    //Get Student By Status
    Route::get('/enrollments/getenrollmentsbystatus', [
        'as' => 'api.v1.enrollments.getenrollmentsbystatus',
        'uses' => 'EnrollmentsController@getEnrollmentsByStatus'
    ]);
    //Get Enrollments With Attendances
    Route::get('/enrollments/getenrollmentswithattendance/year/{idyear}/period/{idperiod}/group/{idgroup}/subject/{idsubject}/nivel/{idnivel}', [
        'as' => 'api.v1.enrollments.getenrollmentswithattendance',
        'uses' => 'EnrollmentsController@getEnrollmentsWithAttendance'
    ]);
    //Get Enrollments With Data
    Route::get('/enrollments/getenrollmentswithdata/year/{idyear}/period/{idperiod}/group/{idgroup}/subject/{idsubject}/nivel/{idnivel}', [
        'as' => 'api.v1.enrollments.getenrollmentswithdata',
        'uses' => 'EnrollmentsController@getEnrollmentsWithData'
    ]);
    //Get Enrollments With Partial
    Route::get('/enrollments/getenrollmentswithpartial/year/{idyear}/period/{idperiod}/group/{idgroup}/subject/{idsubject}/nivel/{idnivel}', [
        'as' => 'api.v1.enrollments.getenrollmentswithpartial',
        'uses' => 'EnrollmentsController@getEnrollmentsWithPartial'
    ]);
    //Get Enrollments With Descriptivereport
    Route::get('/enrollments/getenrollmentswithdescriptivereport/year/{idyear}/period/{idperiod}/group/{idgroup}/subject/{idsubject}/nivel/{idnivel}', [
        'as' => 'api.v1.enrollments.getenrollmentswithdescriptivereport',
        'uses' => 'EnrollmentsController@getEnrollmentsWithDescriptivereport'
    ]);
    //Get Enrollments With Grades
    Route::get('/enrollments/getenrollmentswithgrades/year/{idyear}/period/{idperiod}/group/{idgroup}/subject/{idsubject}/nivel/{idnivel}', [
        'as' => 'api.v1.enrollments.getenrollmentswithgrades',
        'uses' => 'EnrollmentsController@getEnrollmentsWithGrades'
    ]);
    //Get Enrollments With Observers
    Route::get('/enrollments/getenrollmentswithobservers/year/{idyear}/group/{idgroup}', [
        'as' => 'api.v1.enrollments.getenrollmentswithobservers',
        'uses' => 'EnrollmentsController@getEnrollmentsWithObservers'
    ]);
    //Get Enrollments To Attendances Lists
    Route::get('/enrollments/getenrollmentsatendanccesslist/year/{idyear}/group/{idgroup}', [
        'as' => 'api.v1.enrollments.getenrollmentsatendanccesslist',
        'uses' => 'EnrollmentsController@getenrollmentsAtendanccesslist'
    ]);

    //Get Enrollments By Student
    Route::get('/enrollments/getenrollmentsbystudent', [
        'as' => 'api.v1.enrollments.getenrollmentsbystudent',
        'uses' => 'EnrollmentsController@getEnrollmentsByStudent'
    ]);
    //Get Enrollments By Student With Cost
    Route::get('/enrollments/getenrollmentslatestbystudentwithcost', [
        'as' => 'api.v1.enrollments.getenrollmentslatestbystudentwithcost',
        'uses' => 'EnrollmentsController@getEnrollmentsLatestByStudentWithCost'
    ]);
    //Get Enrollments By Student
    Route::get('/enrollments/getenrollmentslatestbystudent', [
        'as' => 'api.v1.enrollments.getenrollmentslatestbystudent',
        'uses' => 'EnrollmentsController@getEnrollmentsLatestByStudent'
    ]);

    //Global Enrollment
    Route::resource('enrollments', 'EnrollmentsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    //Get Enrollments To Attendances Lists
    Route::get('/attendancecontrols', [
        'as' => 'api.v1.attendancecontrols.index',
        'uses' => 'AttendancecontrolsController@index'
    ]);

    //Global Attendance Controls
    Route::resource('attendancecontrols', 'AttendancecontrolsController', array('only' => array('index', 'show', 'store', 'update')));

    /**
     * ===================================
     * Ethnic Groups
     * ===================================
     */
    //Ethnic group
    Route::resource('ethnicgroups', 'EthnicgroupsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Genders
     * ===================================
     */
    //Gender
    Route::resource('genders', 'GendersController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Indicators
     * ===================================
     */
    //Get Indicators By Group
    Route::get('/indicators/getindicatorsbygroup', [
        'as' => 'api.v1.indicators.getindicatorsbygroup',
        'uses' => 'IndicatorsController@getindicatorsbygroup'
    ]);
    //Get Indicators
    Route::get('/indicators/getindicators', [
        'as' => 'api.v1.indicators.getindicators',
        'uses' => 'IndicatorsController@getindicators'
    ]);
    //Get Indicators Pending By Teacher
    Route::get('/indicators/getindicatorspendingbyteacher', [
        'as' => 'api.v1.indicators.getindicatorspendingbyteacher',
        'uses' => 'IndicatorsController@getIndicatorsPendingByTeacher'
    ]);
    //Global Indicators
    Route::resource('indicators', 'IndicatorsController', array('only' => array('index', 'show', 'store', 'update')));

    /**
     * ===================================
     * Indicatortypes
     * ===================================
     */
    //Indicadortypes
    Route::resource('indicatortypes', 'IndicatortypesController', array('only' => array('index', 'show')));


    /**
     * ===================================
     * Grades
     * ===================================
     */
    //Academic Grade
    Route::resource('grades', 'GradesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Groups
     * ===================================
     */
    //Get Groups By Year AND Period
    Route::get('/groups/getgroupsbyyearandperiod', [
        'as' => 'api.v1.groups.getgroupsbyyearandperiod',
        'uses' => 'GroupsController@getGroupsForObservator'
    ]);
    Route::get('/groups/getgroupsforobservator', [
        'as' => 'api.v1.groups.getgroupsbyyearandperiod',
        'uses' => 'GroupsController@getGroupsForObservator'
    ]);
    Route::resource('groups', 'GroupsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Maritalstatuses
     * ===================================
     */
    //Maritalstatuses
    Route::resource('maritalstatuses', 'MaritalstatusesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Years
     * ===================================
     */
    //Get Current Year
    Route::get('/years/getcurrentyear', [
        'as' => 'api.v1.years.getcurrentyear',
        'uses' => 'YearsController@getcurrentyear'
    ]);
    //Academic Years
    Route::resource('years', 'YearsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Monitoring Categories
     * ===================================
     */
    //Global Monitoring Categories
    Route::resource('monitoringcategories', 'MonitoringcategoriesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Monitoring Categories by years
     * ===================================
     */
    //Get Monitoring Categories by Years and Subject
    Route::get('/monitoringcategorybyyears/getmonitoringcategoriesbyyearandsubject/year/{idyear}/subject/{idsubject}', [
        'as' => 'api.v1.monitoringcategorybyyears.getmonitoringcategoriesbyyearandsubject',
        'uses' => 'MonitoringcategorybyyearsController@getmonitoringcategoriesbyyearandsubject'
    ]);

    //Get Monitoring Categories by Years Detail
    Route::get('/monitoringcategorybyyears/getmonitoringcategorybyyeardetail', [
        'as' => 'api.v1.monitoringcategorybyyears.getmonitoringcategorybyyeardetail',
        'uses' => 'MonitoringcategorybyyearsController@getmonitoringcategorybyyeardetail'
    ]);

    //Global Monitoring Category by Years
    Route::resource('monitoringcategorybyyears', 'MonitoringcategorybyyearsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Monitoring Types
     * ===================================
     */
    //Get Monitoring Types
    Route::get('/monitoringtypes/getmonitoringtypesbygroup', [
        'as' => 'api.v1.monitoringtypes.getmonitoringtypesbygroup',
        'uses' => 'MonitoringtypesController@getmonitoringtypesbygroup'
    ]);
    //Get Monitoring Types With Chart
    Route::get('/monitoringtypes/getmonitoringtypesbygroupchart', [
        'as' => 'api.v1.monitoringtypes.getmonitoringtypesbygroupchart',
        'uses' => 'MonitoringtypesController@getmonitoringtypesbygroupchart'
    ]);
    //Get Monitoring Categories
    Route::get('/monitoringtypes/getmonitoringtypesbycategory', [
        'as' => 'api.v1.monitoringtypes.getmonitoringtypesbycategory',
        'uses' => 'MonitoringtypesController@getmonitoringtypesbycategory'
    ]);
    //Global Monitoring types
    Route::resource('monitoringtypes', 'MonitoringtypesController', array('only' => array('index', 'show', 'store', 'destroy')));

    /**
     * ===================================
     * Monitoringtypeindicators
     * ===================================
     */
    //Global Monitorings
    Route::resource('monitoringtypeindicators', 'MonitoringtypeindicatorsController', array('only' => array('index', 'show', 'store', 'destroy')));

    /**
     * ===================================
     * Monitorings
     * ===================================
     */
    //Get Monitorings By User
    Route::get('/monitorings/getmonitoringsbyuser', [
        'as' => 'api.v1.monitorings.getmonitoringsbyuser',
        'uses' => 'MonitoringsController@getMonitoringsByUser'
    ]);
    Route::get('/monitorings/getglobalperformances', [
        'as' => 'api.v1.monitorings.getglobalperformances',
        'uses' => 'MonitoringsController@getGlobalPerformances'
    ]);

    Route::get('/monitorings/getmonitoringsbyuserforparents', [
        'as' => 'api.v1.monitorings.getmonitoringsbyuserforparents',
        'uses' => 'MonitoringsController@getMonitoringsForParents'
    ]);
    //Get Teacher Without Monitoring in Curren Week
    Route::get('/monitorings/getmonitoringsincurrentweek', [
        'as' => 'api.v1.monitorings.getmonitoringsincurrentweek',
        'uses' => 'MonitoringsController@getMonitoringsInCurrentWeek'
    ]);

    //Get Monitorings Pendings By Students
    Route::get('/monitorings/getstudentspendigsbymonitoring', [
        'as' => 'api.v1.monitorings.getstudentspendigsbymonitoring',
        'uses' => 'MonitoringsController@getstudentspendigsbymonitoring'
    ]);

    //Global Monitorings
    Route::resource('monitorings', 'MonitoringsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Nivels
     * ===================================
     */
    //Get Nivels By Year AND Period And Groups and Subject
    Route::get('/nivels/getnivelsbyyearandperiodandgroupandsubject', [
        'as' => 'api.v1.nivels.getnivelsbyyearandperiodandgroupandsubject',
        'uses' => 'NivelsController@getnivelsbyyearandperiodandgroupandsubject'
    ]);

    //Get Nivels By Subject
    Route::get('/nivels/{idsubject}/getnivelsbysubject', [
        'as' => 'api.v1.nivels.getnivelsbysubject',
        'uses' => 'NivelsController@getnivelsbysubject'
    ]);
    //Academic Nivel
    Route::resource('nivels', 'NivelsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Periods
     * ===================================
     */
    //Get Periods By Year
    Route::get('/periods/getperiodsbyyear', [
        'as' => 'api.v1.periods.getperiodsbyyear',
        'uses' => 'PeriodsController@getperiodsbyyear'
    ]);
    //Get Current Period
    Route::get('/periods/getcurrentperiod', [
        'as' => 'api.v1.periods.getcurrentperiod',
        'uses' => 'PeriodsController@getcurrentperiod'
    ]);
    //Academic Periods
    Route::resource('periods', 'PeriodsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Provenances
     * ===================================
     */
    //Provenances
    Route::resource('provenances', 'ProvenancesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Religions
     * ===================================
     */
    //Religions
    Route::resource('religions', 'ReligionsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Calendars
     * ===================================
     */
    //Calendars
    Route::resource('calendars', 'CalendarsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Statuses
     * ===================================
     */
    //Statuses
    Route::resource('statuses', 'StatusesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Statusschooltypes
     * ===================================
     */
    //Statusschooltypes
    Route::resource('statusschooltypes', 'StatusschooltypesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Stratus
     * ===================================
     */
    //Stratus
    Route::resource('stratuses', 'StratusesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Subjects
     * ===================================
     */
    //Get Subjects By Year AND Period And Groups
    Route::get('/subjects/getsubjectsbyyearandperiodandgroup', [
        'as' => 'api.v1.subjects.getsubjectsbyyearandperiodandgroup',
        'uses' => 'SubjectsController@getsubjectsbyyearandperiodandgroup'
    ]);

    //GET Subjects By Year
    Route::get('/subjects/getsubjectsbyyear', [
        'as' => 'api.v1.subjects.getsubjectsbyyear',
        'uses' => 'SubjectsController@getsubjectsbyyear'
    ]);

    //GET Subjects By Year
    Route::get('/subjects/getsubjectwithareasandnivels', [
        'as' => 'api.v1.subjects.getsubjectwithareasandnivels',
        'uses' => 'SubjectsController@getsubjectwithareasandnivels'
    ]);
    //Academic Subjects
    Route::resource('subjects', 'SubjectsController', array('only' => array('index', 'show')));


    /**
     * ===================================
     * Statistics
     * ===================================
     */
    //Global Performannce
    Route::get('/statistics/globalperformances', [
        'as' => 'api.v1.statistics.globalperformances',
        'uses' => 'StatisticsController@globalPerformances'
    ]);
    //Groups With Performances
    Route::get('/statistics/globalperformancebygroup', [
        'as' => 'api.v1.statistics.globalperformancebygroup',
        'uses' => 'StatisticsController@globalPerformanceByGroup'
    ]);
    //Subjects With Performances
    Route::get('/statistics/globalperformancebysubject', [
        'as' => 'api.v1.statistics.globalperformancebysubject',
        'uses' => 'StatisticsController@globalPerformanceBySubject'
    ]);
    //Areas With Performances
    Route::get('/statistics/globalperformancebyarea', [
        'as' => 'api.v1.statistics.globalperformancebyarea',
        'uses' => 'StatisticsController@globalPerformanceByArea'
    ]);

    /**
     * ===================================
     * Towns
     * ===================================
     */
    //Town
    Route::resource('towns', 'TownsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Users
     * ===================================
     */
    //Get Latest Users
    Route::get('/users/getlatest', [
        'as' => 'api.v1.users.getlatest',
        'uses' => 'UsersController@getLatest'
    ]);

    //Get All Personal Academic
    Route::get('/users/getpersonalacademic', [
        'as' => 'api.v1.users.getpersonalacademic',
        'uses' => 'UsersController@getPersonalAcademic'
    ]);
    //Get All Students In School
    Route::get('/users/getallstudents', [
        'as' => 'api.v1.users.getallstudents',
        'uses' => 'UsersController@getallstudents'
    ]);

    //Get Latest Code
    Route::get('/users/getlatestcode', [
        'as' => 'api.v1.users.getlatestcode',
        'uses' => 'UsersController@getLatestCode'
    ]);
    //Verify Celular
    Route::post('/users/verifycelular', [
        'as' => 'api.v1.users.verifycelular',
        'uses' => 'UsersController@verifyCelular'
    ]);
    //Verify Celular Message
    Route::post('/users/verifycelularmessage', [
        'as' => 'api.v1.users.verifycelularmessage',
        'uses' => 'UsersController@verifyCelularMessage'
    ]);
    //Save Celular By Passcode
    Route::post('/users/savecelularbypasscode', [
        'as' => 'api.v1.users.savecelularbypasscode',
        'uses' => 'UsersController@saveCelularByPasscode'
    ]);
    //Save Celular By Certification
    Route::post('/users/savecelularbycertification', [
        'as' => 'api.v1.users.savecelularbycertification',
        'uses' => 'UsersController@saveCelularByCertification'
    ]);
    //Verify Email
    Route::post('/users/verifyemail', [
        'as' => 'api.v1.users.verifyemail',
        'uses' => 'UsersController@verifyEmail'
    ]);
    //Verify Email Message
    Route::post('/users/verifyemailmessage', [
        'as' => 'api.v1.users.verifyemailmessage',
        'uses' => 'UsersController@verifyEmailMessage'
    ]);
    //Save Email By Passcode
    Route::post('/users/saveemailbypasscode', [
        'as' => 'api.v1.users.saveemailbypasscode',
        'uses' => 'UsersController@saveEmailByPasscode'
    ]);
    //Save Email By Certification
    Route::post('/users/saveemailbycertification', [
        'as' => 'api.v1.users.saveemailbycertification',
        'uses' => 'UsersController@saveEmailByCertification'
    ]);
    //User
    Route::resource('users', 'UsersController', array('only' => array('index', 'show', 'store', 'update')));

    /**
     * ===================================
     * Families
     * ===================================
     */
    //Search Family by name
    Route::get('/families/searchfamilybyname', [
        'as' => 'api.v1.families.searchfamilybyname',
        'uses' => 'FamiliesController@searchfamilybyname'
    ]);
    //Search Families By Year
    Route::get('/families/searchfamilies', [
        'as' => 'api.v1.families.searchfamilies',
        'uses' => 'FamiliesController@searchFamilies'
    ]);
    //Family
    Route::resource('families', 'FamiliesController', array('only' => array('index', 'show', 'store')));


    /**
     * ===================================
     * Userfamilies
     * ===================================
     */
    //Get Users By Family
    Route::get('/userfamilies/getusersbyfamily', [
        'as' => 'api.v1.userfamilies.getusersbyfamily',
        'uses' => 'UserfamiliesController@getusersbyfamily'
    ]);
    //Userfamily
    Route::resource('userfamilies', 'UserfamiliesController', array('only' => array('index', 'show')));


    /**
     * ===================================
     * Quantitativerecoveries
     * ===================================
     */
    //Get Recovery By User
    Route::get('/quantitativerecoveries/getrecoverybyuser', [
        'as' => 'api.v1.quantitativerecoveries.getrecoverybyuser',
        'uses' => 'QuantitativerecoveriesController@getrecoverybyuser'
    ]);
    //Quantitativerecovery
    Route::resource('quantitativerecoveries', 'QuantitativerecoveriesController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));


    /**
     * ===================================
     * Partialratings
     * ===================================
     */
    //Partialrating
    Route::resource('partialratings', 'PartialratingsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Descriptivereports
     * ===================================
     */
    //Descriptivereports
    Route::resource('descriptivereports', 'DescriptivereportsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Preregistrations
     * ===================================
     */
    //Get Preregistration By User
    Route::get('/preregistrations/getpreregistrationbyuser', [
        'as' => 'api.v1.preregistrations.getpreregistrationbyuser',
        'uses' => 'PreregistrationsController@getpreregistrationbyuser'
    ]);
    //Preregistration
    Route::resource('preregistrations', 'PreregistrationsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Identificationtypes
     * ===================================
     */
    //Identificationtypes
    Route::resource('identificationtypes', 'IdentificationtypesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Medicalinsurances
     * ===================================
     */
    //Medicalinsurances
    Route::resource('medicalinsurances', 'MedicalinsurancesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Prepaidmedicals
     * ===================================
     */
    //Prepaidmedicals
    Route::resource('prepaidmedicals', 'PrepaidmedicalsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Bloodtypes
     * ===================================
     */
    //Bloodtypes
    Route::resource('bloodtypes', 'BloodtypesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Payments
     * ===================================
     */
    //Get Payments By User
    Route::get('/payments/getpaymentsbyuser', [
        'as' => 'api.v1.payments.getpaymentsbyuser',
        'uses' => 'PaymentsController@getPaymentsByUser'
    ]);
    //Get Payments By User With Transactions
    Route::get('/payments/{student}/getpaymentsbyuserwithtransactions', [
        'as' => 'api.v1.payments.getpaymentsbyuserwithtransactions',
        'uses' => 'PaymentsController@getPaymentsByUserWithTransactions'
    ]);
    //Set Payment Method
    Route::get('/payments/setpaymentmethod', [
        'as' => 'api.v1.payments.setpaymentmethod',
        'uses' => 'PaymentsController@setPaymentMethod'
    ]);
    //Set Payment Agreement
    Route::get('/payments/setpaymentagreement', [
        'as' => 'api.v1.payments.setpaymentagreement',
        'uses' => 'PaymentsController@setPaymentAgreement'
    ]);
    //Set Payment Individual
    Route::post('/payments/setpaymentindividual', [
        'as' => 'api.v1.payments.setpaymentindividual',
        'uses' => 'PaymentsController@setPaymentIndividual'
    ]);
    //Set Payment Individual NEW
    Route::post('/payments/setpaymentindividualnew', [
        'as' => 'api.v1.payments.setpaymentindividualnew',
        'uses' => 'PaymentsController@setPaymentIndividualNew'
    ]);
    //Set Payment Massive
    Route::post('/payments/setpaymentmassive', [
        'as' => 'api.v1.payments.setpaymentmassive',
        'uses' => 'PaymentsController@setPaymentMassive'
    ]);
    //Verify Payment pending
    Route::post('/payments/verifypaymentpending', [
        'as' => 'api.v1.payments.verifypaymentpending',
        'uses' => 'PaymentsController@verifyPaymentPending'
    ]);
    //Update Payment Short
    Route::post('/payments/updatepaymentshort', [
        'as' => 'api.v1.payments.updatepaymentshort',
        'uses' => 'PaymentsController@updatePaymentShort'
    ]);
    //Get Payments Pendings
    Route::get('/payments/getpaymentspendings', [
        'as' => 'api.v1.payments.getpaymentspendings',
        'uses' => 'PaymentsController@getPaymentsPendings'
    ]);
    //Payments
    Route::resource('payments', 'PaymentsController', array('only' => array('index', 'show', 'update')));


    /**
     * ===================================
     * Product Category
     * ===================================
     */
    //Product Category
    Route::resource('productcategories', 'ProductcategoriesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Product
     * ===================================
     */
    //Search By Code
    Route::get('/products/searchbycode', [
        'as' => 'api.v1.products.searchbycode',
        'uses' => 'ProductsController@searchbycode'
    ]);
    //Products
    Route::resource('products', 'ProductsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Provider
     * ===================================
     */
    //Providers
    Route::resource('providers', 'ProvidersController', array('only' => array('index', 'show', 'update')));


    /**
     * ===================================
     * Status Purchase
     * ===================================
     */
    //Status Purchases
    Route::resource('statuspurchases', 'StatuspurchasesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Detail
     * ===================================
     */
    //Details
    Route::resource('details', 'DetailsController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Evaluation Purchase
     * ===================================
     */
    //Generate Code
    Route::get('/purchases/generatecode', [
        'as' => 'api.v1.purchases.generatecode',
        'uses' => 'PurchasesController@generatecode'
    ]);
    //Get Discounts
    Route::get('/purchases/getdiscount', [
        'as' => 'api.v1.purchases.getdiscount',
        'uses' => 'PurchasesController@getdiscount'
    ]);
    //Status Update
    Route::post('/purchases/statusupdate', [
        'as' => 'api.v1.purchases.statusupdate',
        'uses' => 'PurchasesController@statusUpdate'
    ]);

    /**
     * ===================================
     * Purchases
     * ===================================
     */
    //Purchases
    Route::resource('purchases', 'PurchasesController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Evaluationpurchases
     * ===================================
     */
    //Status Update
    Route::get('/evaluationpurchases/getevaluationbypurchase', [
        'as' => 'api.v1.evaluationpurchases.getevaluationbypurchase',
        'uses' => 'EvaluationpurchasesController@getEvaluationByPurchase'
    ]);
    //Evaluationpurchases
    Route::resource('evaluationpurchases', 'EvaluationpurchasesController', array('only' => array('show', 'store')));

    /**
     * ===================================
     * Observer Types
     * ===================================
     */
    //Observertypes
    Route::resource('observertypes', 'ObservertypesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Observers
     * ===================================
     */
    //Get Observers By Users
    Route::get('/observers/getobservers', [
        'as' => 'api.v1.observers.getobservers',
        'uses' => 'ObserversController@getObservers'
    ]);
    //Observers
    Route::resource('observers', 'ObserversController', array('only' => array('index', 'show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Task types
     * ===================================
     */
    //Task types
    Route::resource('tasktypes', 'TasktypesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Tasks
     * ===================================
     */
    //Set Tasks Approved
    Route::get('/tasks/setapproved', [
        'as' => 'api.v1.tasks.setapproved',
        'uses' => 'TasksController@setApproved'
    ]);
    //Get Tasks By Year
    Route::get('/tasks/gettasks', [
        'as' => 'api.v1.tasks.gettasks',
        'uses' => 'TasksController@getTasks'
    ]);
    //Get Tasks By user
    Route::get('/tasks/gettasksbyuser', [
        'as' => 'api.v1.tasks.gettasksbyuser',
        'uses' => 'TasksController@getTasksByUser'
    ]);
    //Tasks
    Route::resource('tasks', 'TasksController', array('only' => array('show', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Task Files
     * ===================================
     */
    //Task Files
    Route::resource('taskfiles', 'TaskfilesController', array('only' => array('index', 'show')));

    //Global Quantitativerecoveryfinalareas
    Route::resource('quantitativerecoveryfinalareas', 'QuantitativerecoveryfinalareasController', array('only' => array('store', 'update', 'destroy')));

    //Global Qualitativerecoveryfinalareas
    Route::resource('qualitativerecoveryfinalareas', 'QualitativerecoveryfinalareasController', array('only' => array('store', 'update', 'destroy')));


    /**
     * ===================================
     * Routes By Users
     * ===================================
     */
    //Routes By Users
    Route::resource('routebyusers', 'RoutebyusersController', array('only' => array('store', 'update', 'destroy')));

    /**
     * ===================================
     * Routes
     * ===================================
     */
    //Routes
    Route::resource('routes', 'RoutesController', array('only' => array('index', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Convenyors
     * ===================================
     */
    //Convenyors
    Route::resource('conveyors', 'ConveyorsController', array('only' => array('index', 'store', 'update', 'destroy')));

    /**
     * ===================================
     * Vehicles
     * ===================================
     */
    //Vehicles
    Route::resource('vehicles', 'VehiclesController', array('only' => array('index', 'store', 'update', 'destroy')));


    /**
     * ===================================
     * Ubications
     * ===================================
     */
    //Get Ubications
    Route::get('/ubications/getubications', [
        'as' => 'api.v1.ubications.getubications',
        'uses' => 'UbicationsController@getUbications'
    ]);
    //Ubications
    Route::resource('ubications', 'UbicationsController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Inventory Types
     * ===================================
     */
    //Inventorytypes
    Route::resource('inventorytypes', 'InventorytypesController', array('only' => array('index', 'show')));

    /**
     * ===================================
     * Visitortypes
     * ===================================
     */
    //Visitortypes
    Route::resource('visitortypes', 'VisitortypesController', array('only' => array('index', 'show')));


    /**
     * ===================================
     * Visitors
     * ===================================
     */
    //Generate Code
    Route::get('/visitors/generatecode', [
        'as' => 'api.v1.visitors.generatecode',
        'uses' => 'VisitorsController@generatecode'
    ]);
    //Checkin
    Route::get('/visitors/checkin', [
        'as' => 'api.v1.visitors.checkin',
        'uses' => 'VisitorsController@checkin'
    ]);
    //Checkout
    Route::get('/visitors/checkout', [
        'as' => 'api.v1.visitors.checkout',
        'uses' => 'VisitorsController@checkout'
    ]);
    //Get Visitors Today
    Route::get('/visitors/getvisitorsnow', [
        'as' => 'api.v1.visitors.getvisitorsnow',
        'uses' => 'VisitorsController@getVisitorsNow'
    ]);
    //Visitors
    Route::resource('visitors', 'VisitorsController', array('only' => array('index', 'show', 'update', 'store')));

    /**
     * ===================================
     * Voucherconsecutive Module
     * ===================================
     */
    Route::get('/voucherconsecutives/getvoucherconsecutivebycode', [
        'as' => 'api.v1.voucherconsecutives.getvoucherconsecutivebycode',
        'uses' => 'VoucherconsecutivesController@getVoucherConsecutiveByCode'
    ]);


    /**
     * ===================================
     * Weeklyevaluations
     * ===================================
     */
    //Get Evaluations By Year
    Route::get('/weeklyevaluations/getevaluations', [
        'as' => 'api.v1.weeklyevaluations.getevaluations',
        'uses' => 'WeeklyevaluationsController@getEvaluations'
    ]);
    //Weeklyevaluations
    Route::resource('weeklyevaluations', 'WeeklyevaluationsController', array('only' => array('index', 'show', 'store', 'update')));


    /**
     * ===================================
     * Exports To File (pdf,excel,cvs)
     * ===================================
     */
    Route::get('/exports/students/enrollments', [
        'as' => 'api.v1.exports.students.enrollments',
        'uses' => 'ExportsController@exportStudentEnrollments'
    ]);
    Route::get('/exports/payments/reports', [
        'as' => 'api.v1.exports.payments.reports',
        'uses' => 'ExportsController@exportPaymentsReports'
    ]);
    Route::get('/exports/reports/partials', [
        'as' => 'api.v1.exports.reports.partials',
        'uses' => 'ExportsController@exportReportsPartials'
    ]);


    /**
     * ===================================
     * Permissions
     * ===================================
     */
    //Permission
    Route::resource('permissions', 'PermissionsController', array('only' => array('index', 'show', 'store', 'update')));

    /**
     * ===================================
     * Attendance By Employees
     * ===================================
     */
    //Attendance By Employees
    Route::resource('attendancebyemployees', 'AttendancebyemployeesController', array('only' => array('index', 'show', 'store', 'update')));


    /**
     * ===================================
     * Responsibleparents Module
     * ===================================
     */
    Route::get('/responsibleparents/getresponsibleparentbystudent', [
        'as' => 'api.v1.responsibleparents.getresponsibleparentbystudent',
        'uses' => 'ResponsibleparentsController@getResponsibleparentByStudent'
    ]);


    /**
     * ===================================
     * Transactions
     * ===================================
     */
    //Get Evaluations By Year
    Route::get('/transactions/gettransactionsbypayment', [
        'as' => 'api.v1.transactions.gettransactionsbypayment',
        'uses' => 'TransactionsController@getTransactionsByPayment'
    ]);
    //Find Voucher In Transactions With Payment
    Route::get('/transactions/findvoucherintransactions', [
        'as' => 'api.v1.transactions.findvoucherintransactions',
        'uses' => 'TransactionsController@findVoucherInTransactions'
    ]);
    //Transactions
    Route::resource('transactions', 'TransactionsController', array('only' => array('store', 'update', 'destroy')));

    /**
     * ===================================
     * Transactions Types
     * ===================================
     */
    //Transactiontypes
    Route::resource('transactiontypes', 'TransactiontypesController', array('only' => array('index', 'show', 'store', 'update')));

});

Route::group(['prefix' => 'v2', 'as' => 'api.v2.', 'middleware' => ['throttle:2500,10', 'auth:api', 'permission']], function () {


    /**
     * User Login
     */
    Route::post('/users/login', ['as' => 'api.v2.users.login', function (\Illuminate\Http\Request $request) {
        if (Auth::attempt(['email' => $request["email"], 'password' => $request["password"]])) {
            return Response::json([
                'sigeturbo' => [
                    'login_successful' => true,
                    'data' => Auth::user()
                ]
            ]);
        } else {
            return Response::json([
                'sigeturbo' => [
                    'login_successful' => false,
                    'data' => []
                ]
            ]);
        }

    }]);

    /**
     * Get Member By Family
     */
    Route::get('/families/getmembers/{user}', ['as' => 'api.v2.families.getmembers', function ($user) {

        //Find Family
        $family = new SigeTurbo\Repositories\Userfamily\UserfamilyRepository();
        return Response::json([
            'sigeturbo' => [
                'family' => $family->getFamilyName($user)->family,
                'data' => $family->getUsersByFamily(['user' => $user])
            ]
        ]);

    }]);

    //Get Tasks By user
    Route::get('/tasks/gettasksbyuser/{user}', ['as' => 'api.v2.tasks.gettasksbyuser', function ($user) {

        //Find Tasks
        $task = new SigeTurbo\Repositories\Task\TaskRepository();
        return Response::json([
            'sigeturbo' => [
                'group' => \SigeTurbo\Repositories\Group\GroupRepository::getLatestGroupByStudent($user)->name,
                'data' => $task->getTasksByUser($user)
            ]
        ]);

    }]);

    //Get Monitorings By user
    Route::get('/monitorings/getmonitoringsbyuser/{user}', ['as' => 'api.v2.monitorings.getmonitoringsbyuser', function ($user) {

        //Find Monitorings
        return Response::json([
            'sigeturbo' => [
                'group' => "Primero-A",
                'data' => Monitorings::getMonitoringsForParents(2015, 2, 11, $user)
            ]
        ]);

    }]);

    Route::get('/monitorings/getmonitoringsdetailsbyuser/{idyear}/{idperiod}/{idgroup}/{idsubject}/{idnivel}/{iduser}',
        ['as' => 'api.v2.monitorings.getmonitoringsdetailsbyuser', function ($idyear, $idperiod, $idgroup, $idsubject, $idnivel, $iduser) {
            //Find Monitorings
            $monitoring = new SigeTurbo\Repositories\Monitoring\MonitoringRepository();
            $monitorings = $monitoring->getMonitoringsDetailForParents($idyear, $idperiod, $idgroup, $idsubject, $idnivel, $iduser);
            $i = 0;
            foreach ($monitorings as $monitoring) {
                $monitorings[$i]["details"] = json_decode(str_replace("\\", "", $monitorings[$i]["details"]), true);
                $i++;
            }
            return Response::json([
                'sigeturbo' => [
                    'data' => $monitorings
                ]
            ]);

        }]);


    /**
     * ===================================
     * Years
     * ===================================
     */
    //Get Current Year
    Route::get('/years/getcurrentyear/', [
        'as' => 'api.v2.years.getcurrentyear',
        'uses' => 'YearsController@getcurrentyear'
    ]);
    //Academic Years
    Route::resource('years', 'YearsController', array('only' => array('index')));

    /**
     * ===================================
     * Groups
     * ===================================
     */
    //Get Groups By Year AND Period
    Route::get('/groups/getgroups', [
        'as' => 'api.v2.groups.getgroups',
        'uses' => 'GroupsController@getGroupForGuest'
    ]);
    Route::resource('groups', 'GroupsController', array('only' => array('index', 'show')));


    /**
     * ===================================
     * Visitors
     * ===================================
     */
    //Get Visitors Today
    Route::get('/visitors/getvisitorsnow', [
        'as' => 'api.v2.visitors.getvisitorsnow',
        'uses' => 'VisitorsController@getVisitorsNowForDisplay'
    ]);

    /**
     * ===================================
     * Families
     * ===================================
     */
    //Search Family by name
    Route::get('/families/searchfamilybyname', [
        'as' => 'api.v2.families.searchfamilybyname',
        'uses' => 'FamiliesController@searchfamilybyname'
    ]);


});