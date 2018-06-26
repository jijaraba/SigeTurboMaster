<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Category;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests;
use SigeTurbo\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use SigeTurbo\Http\Requests\UserCreateRequest;
use SigeTurbo\Http\Requests\UserUpdateRequest;
use SigeTurbo\Repositories\Calendar\CalendarRepositoryInterface;
use SigeTurbo\Repositories\Category\CategoryRepositoryInterface;
use SigeTurbo\Repositories\Enrollment\EnrollmentRepositoryInterface;
use SigeTurbo\Repositories\Enrollmentreason\EnrollmentreasonRepositoryInterface;
use SigeTurbo\Repositories\Ethnicgroup\EthnicgroupRepositoryInterface;
use SigeTurbo\Repositories\Gender\GenderRepositoryInterface;
use SigeTurbo\Repositories\Grade\GradeRepositoryInterface;
use SigeTurbo\Repositories\Identificationtype\IdentificationtypeRepositoryInterface;
use SigeTurbo\Repositories\Maritalstatus\MaritalstatusRepositoryInterface;
use SigeTurbo\Repositories\Religion\ReligionRepositoryInterface;
use SigeTurbo\Repositories\Bloodtype\BloodtypeRepositoryInterface;
use SigeTurbo\Repositories\Prepaidmedical\PrepaidmedicalRepositoryInterface;
use SigeTurbo\Repositories\Medicalinsurance\MedicalinsuranceRepositoryInterface;
use SigeTurbo\Repositories\Responsibleparent\ResponsibleparentRepositoryInterface;
use SigeTurbo\Repositories\Language\LanguageRepositoryInterface;
use SigeTurbo\Repositories\Country\CountryRepositoryInterface;
use SigeTurbo\Repositories\Status\StatusRepositoryInterface;
use SigeTurbo\Repositories\Stratus\StratusRepositoryInterface;
use SigeTurbo\Repositories\Town\TownRepositoryInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Statusschooltype;

class StudentsController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var StatusRepositoryInterface
     */
    private $statusRepository;
    /**
     * @var TownRepositoryInterface
     */
    private $townRepository;
    /**
     * @var StratusRepositoryInterface
     */
    private $stratusRepository;
    /**
     * @var EthnicgroupRepositoryInterface
     */
    private $ethnicgroupRepository;
    /**
     * @var MaritalstatusRepositoryInterface
     */
    private $maritalstatusRepository;
    /**
     * @var GenderRepositoryInterface
     */
    private $genderRepository;
    /**
     * @var ReligionRepositoryInterface
     */
    private $religionRepository;
    /**
     * @var EnrollmentRepositoryInterface
     */
    private $enrollmentRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var IdentificationtypeRepositoryInterface
     */
    private $identificationtypeRepository;
    /**
     * @var EnrollmentreasonRepositoryInterface
     */
    private $enrollmentreasonRepository;
    /**
     * @var CalendarRepositoryInterface
     */
    private $calendarRepository;
    /**
     * @var GradeRepositoryInterface
     */
    private $gradeRepository;
    /**
     * @var BloodtypeRepositoryInterface
     */
    private $bloodtypeRepository;
    /**
     * @var PrepaidmedicalRepositoryInterface
     */
    private $prepaidmedicalRepository;
    /**
     * @var MedicalinsuranceRepositoryInterface
     */
    private $medicalinsuranceRepository;
    /**
     * @var LanguageRepositoryInterface
     */
    private $languageRepository;
    /**
     * @var CountryRepositoryInterface
     */
    private $countryRepository;
    /**
     * @var ResponsibleparentRepositoryInterface
     */
    private $responsibleparentRepository;

    /**
     * StudentsController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param TownRepositoryInterface $townRepository
     * @param StatusRepositoryInterface $statusRepository
     * @param StratusRepositoryInterface $stratusRepository
     * @param EthnicgroupRepositoryInterface $ethnicgroupRepository
     * @param MaritalstatusRepositoryInterface $maritalstatusRepository
     * @param GenderRepositoryInterface $genderRepository
     * @param ReligionRepositoryInterface $religionRepository
     * @param EnrollmentRepositoryInterface $enrollmentRepository
     * @param YearRepositoryInterface $yearRepository
     * @param IdentificationtypeRepositoryInterface $identificationtypeRepository
     * @param EnrollmentreasonRepositoryInterface $enrollmentreasonRepository
     * @param CalendarRepositoryInterface $calendarRepository
     * @param GradeRepositoryInterface $gradeRepository
     * @param BloodtypeRepositoryInterface $bloodtypeRepository
     * @param PrepaidmedicalRepositoryInterface $prepaidmedicalRepository
     * @param MedicalinsuranceRepositoryInterface $medicalinsuranceRepository
     * @param LanguageRepositoryInterface $languageRepository
     * @param CountryRepositoryInterface $countryRepository
     * @param ResponsibleparentRepositoryInterface $responsibleparentRepository
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                CategoryRepositoryInterface $categoryRepository,
                                TownRepositoryInterface $townRepository,
                                StatusRepositoryInterface $statusRepository,
                                StratusRepositoryInterface $stratusRepository,
                                EthnicgroupRepositoryInterface $ethnicgroupRepository,
                                MaritalstatusRepositoryInterface $maritalstatusRepository,
                                GenderRepositoryInterface $genderRepository,
                                ReligionRepositoryInterface $religionRepository,
                                EnrollmentRepositoryInterface $enrollmentRepository,
                                YearRepositoryInterface $yearRepository,
                                IdentificationtypeRepositoryInterface $identificationtypeRepository,
                                EnrollmentreasonRepositoryInterface $enrollmentreasonRepository,
                                CalendarRepositoryInterface $calendarRepository,
                                GradeRepositoryInterface $gradeRepository,
                                BloodtypeRepositoryInterface $bloodtypeRepository,
                                PrepaidmedicalRepositoryInterface $prepaidmedicalRepository,
                                MedicalinsuranceRepositoryInterface $medicalinsuranceRepository,
                                LanguageRepositoryInterface $languageRepository,
                                CountryRepositoryInterface $countryRepository,
                                ResponsibleparentRepositoryInterface $responsibleparentRepository)
    {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->statusRepository = $statusRepository;
        $this->townRepository = $townRepository;
        $this->stratusRepository = $stratusRepository;
        $this->ethnicgroupRepository = $ethnicgroupRepository;
        $this->maritalstatusRepository = $maritalstatusRepository;
        $this->genderRepository = $genderRepository;
        $this->religionRepository = $religionRepository;
        $this->enrollmentRepository = $enrollmentRepository;
        $this->yearRepository = $yearRepository;
        $this->identificationtypeRepository = $identificationtypeRepository;
        $this->enrollmentreasonRepository = $enrollmentreasonRepository;
        $this->calendarRepository = $calendarRepository;
        $this->gradeRepository = $gradeRepository;
        $this->bloodtypeRepository = $bloodtypeRepository;
        $this->prepaidmedicalRepository = $prepaidmedicalRepository;
        $this->medicalinsuranceRepository = $medicalinsuranceRepository;
        $this->languageRepository = $languageRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Year
        if (isset($request['year'])) {
            $year = $request['year'];
        } else {
            $year = $this->yearRepository->getCurrentYear()->idyear;
        }

        //Group
        $group = null;
        //Search
        $search = [
            'year' => $this->yearRepository->getCurrentYear()->idyear,
            'status' => Statusschooltype::STATUS_ACTIVE
        ];
        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
            if (isset($search["group"])) {
                $group = $search["group"];
            }

        }

        //Status
        $status = Statusschooltype::STATUSES;
        if (isset($request['status'])) {
            $status = json_decode($request['status'], true);
        }

        //Sort
        $sort = 'group';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //View
        $view = 'photo';
        if (isset($request['view'])) {
            $view = $request['view'];
        }

        //Order
        $order = 'asc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 25;
        $students = $this->enrollmentRepository->getEnrollments($search["year"], $group, [Category::STUDENT], $search["status"], $search, $sort, strtoupper($order));
        $paginator = new LengthAwarePaginator(
            $students->forPage($page, $perPage), $students->count(), $perPage, $page
        );
        $paginator->setPath('admissions/students');
        return view('students.index')
            ->withStudents($paginator)
            ->withSearch($search)
            ->withStatus($status)
            ->withView($view)
            ->withSort($sort)
            ->withYear($year)
            ->withOrder($order);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function financial(Request $request)
    {

        //Year
        if (isset($request['year'])) {
            $year = $request['year'];
        } else {
            $year = $this->yearRepository->getCurrentYear()->idyear;
        }

        //Group
        $group = null;
        //Search
        $search = [
            'year' => $this->yearRepository->getCurrentYear()->idyear,
            'status' => Statusschooltype::STATUS_ACTIVE
        ];
        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
            if (isset($search["group"])) {
                $group = $search["group"];
            }

        }

        //Status
        $status = Statusschooltype::STATUSES;
        if (isset($request['status'])) {
            $status = json_decode($request['status'], true);
        }

        //Sort
        $sort = 'group';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //View
        $view = 'photo';
        if (isset($request['view'])) {
            $view = $request['view'];
        }

        //Order
        $order = 'asc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 25;
        $students = $this->enrollmentRepository->getEnrollments($search["year"], $group, [Category::STUDENT], $search["status"], $search, $sort, strtoupper($order));
        $paginator = new LengthAwarePaginator(
            $students->forPage($page, $perPage), $students->count(), $perPage, $page
        );
        $paginator->setPath('financials/students');
        return view('financials.students.index')
            ->withStudents($paginator)
            ->withSearch($search)
            ->withStatus($status)
            ->withView($view)
            ->withSort($sort)
            ->withYear($year)
            ->withOrder($order);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //Generate Username - Email
        $username = str_random(8) . "-" . str_random(2);
        $email = $username . "@thenewschool.edu.co";
        $celular = str_random(3) . "-" . str_random(4) . "-" . str_random(2) . "-" . str_random(2);

        return view('students.create')
            ->with('categories', $this->categoryRepository->all()->pluck('name', 'idcategory'))
            ->with('statuses', $this->statusRepository->all()->pluck('name', 'idstatus'))
            ->with('towns', $this->townRepository->all()->pluck('name', 'idtown'))
            ->with('stratuses', $this->stratusRepository->all()->pluck('name', 'idstratus'))
            ->with('ethnicgroups', $this->ethnicgroupRepository->all()->pluck('name', 'idethnicgroup'))
            ->with('maritalstatuses', $this->maritalstatusRepository->all()->pluck('name', 'idmaritalstatus'))
            ->with('genders', $this->genderRepository->all()->pluck('name', 'idgender'))
            ->with('religions', $this->religionRepository->all()->pluck('name', 'idreligion'))
            ->withCredential([
                'password' => str_random(6),
                'username' => $username,
                'email' => $email,
                'celular' => $celular,
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

        //Create Student
        $student = $this->userRepository->store($request);

        $data = [];
        if ($student) {
            //Delete Cache
            Cache::forget('users');
            //Event
            event(new Stream(['description' => "ingresó el estudiante: " . $student->firstname . " " . $student->lastname]));
            return redirect()
                ->route('admissions.students.edit', ['student' => $student->iduser])
                ->withSuccess(Lang::get('sige.SuccessSaveMessage'));
        } else {
            return redirect()
                ->back()
                ->withErrors($request)
                ->withInput($request)
                ->withNotice(Lang::get('sige.ErrorSaveMessage'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $student
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($student, Request $request)
    {

        //Item
        $item = 1;
        if (isset($request['item'])) {
            $item = $request['item'];
        }

        return view('students.edit')
            ->withStudent($this->userRepository->getStudentById($student))
            ->withCategories($this->categoryRepository->all()->pluck('name', 'idcategory'))
            ->withStatuses($this->statusRepository->all()->pluck('name', 'idstatus'))
            ->withTowns($this->townRepository->all()->pluck('name', 'idtown'))
            ->withStratuses($this->stratusRepository->all()->pluck('name', 'idstratus'))
            ->withEthnicgroups($this->ethnicgroupRepository->all()->pluck('name', 'idethnicgroup'))
            ->withMaritalstatuses($this->maritalstatusRepository->all()->pluck('name', 'idmaritalstatus'))
            ->withGenders($this->genderRepository->all()->pluck('name', 'idgender'))
            ->withReligions($this->religionRepository->all()->pluck('name', 'idreligion'))
            ->withIdentificationtypes($this->identificationtypeRepository->all()->pluck('name', 'ididentificationtype'))
            ->withEnrollmentreasons($this->enrollmentreasonRepository->all()->pluck('name', 'idenrollmentreason'))
            ->withCalendars($this->calendarRepository->all()->pluck('name', 'idcalendar'))
            ->withGrades($this->gradeRepository->all()->pluck('name', 'idgrade'))
            ->withBloodtypes($this->bloodtypeRepository->all()->pluck('name', 'idbloodtype'))
            ->withPrepaidmedicals($this->prepaidmedicalRepository->all()->pluck('name', 'idprepaidmedical'))
            ->withMedicalinsurances($this->medicalinsuranceRepository->all()->pluck('name', 'idmedicalinsurance'))
            ->withLanguages($this->languageRepository->all()->pluck('name', 'idlanguage'))
            ->withCountries($this->countryRepository->all()->pluck('name', 'idcountry'))
            ->withAcademic($this->yearRepository->getCurrentYear())
            ->withYear($request['year'])
            ->withSearch($request['search'])
            ->withView($request['view'])
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page'])
            ->withItem($item);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $user
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($user, UserUpdateRequest $request)
    {
        //Update Student
        $student = $this->userRepository->update($user, $request);

        $data = [];
        if ($student) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('users');
            return redirect()
                ->back()
                ->withSuccess(Lang::get('sige.SuccessUpdateMessage'));
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
            return redirect()
                ->back()
                ->withInput($request)
                ->withErrors($request);
        }
    }


    public function users(Request $request)
    {
        //Search
        $search = [
            'category' => Category::PARENTS
        ];
        //categories
        $categories = $search['category'];

        if (isset($request['search'])) {
            $search = json_decode($request['search'], true);
            if (isset($search['category'])) {
                $categories = $search['category'];
            }
        }
        //View
        $view = 'photo';
        if (isset($request['view'])) {
            $view = $request['view'];
        }

        //Sort
        $sort = 'group';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //Order
        $order = 'asc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 25;
        $users = $this->userRepository->getUsersByDataDefined($categories, $search, $sort, strtoupper($order));
        $paginator = new LengthAwarePaginator(
            $users->forPage($page, $perPage), $users->count(), $perPage, $page
        );
        $paginator->setPath('admissions/users');

        return view('students.users')
            ->withUsers($paginator)
            ->withSearch($search)
            ->withView($view)
            ->withSort($sort)
            ->withOrder($order);
    }

}
