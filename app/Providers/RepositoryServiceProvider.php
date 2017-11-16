<?php

namespace SigeTurbo\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(
            'SigeTurbo\Repositories\Academic\AcademicRepositoryInterface',
            'SigeTurbo\Repositories\Academic\AcademicRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Accounttype\AccounttypeRepositoryInterface',
            'SigeTurbo\Repositories\Accounttype\AccounttypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Achievement\AchievementRepositoryInterface',
            'SigeTurbo\Repositories\Achievement\AchievementRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Attendance\AttendanceRepositoryInterface',
            'SigeTurbo\Repositories\Attendance\AttendanceRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Bank\BankRepositoryInterface',
            'SigeTurbo\Repositories\Bank\BankRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Calendar\CalendarRepositoryInterface',
            'SigeTurbo\Repositories\Calendar\CalendarRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Quantitativerecovery\QuantitativerecoveryRepositoryInterface',
            'SigeTurbo\Repositories\Quantitativerecovery\QuantitativerecoveryRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Quantitativerecoveryfinalarea\QuantitativerecoveryfinalareaRepositoryInterface',
            'SigeTurbo\Repositories\Quantitativerecoveryfinalarea\QuantitativerecoveryfinalareaRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Qualitativerecoveryfinalarea\QualitativerecoveryfinalareaRepositoryInterface',
            'SigeTurbo\Repositories\Qualitativerecoveryfinalarea\QualitativerecoveryfinalareaRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Contract\ContractRepositoryInterface',
            'SigeTurbo\Repositories\Contract\ContractRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Preregistration\PreregistrationRepositoryInterface',
            'SigeTurbo\Repositories\Preregistration\PreregistrationRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface',
            'SigeTurbo\Repositories\Userfamily\UserfamilyRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\User\UserRepositoryInterface',
            'SigeTurbo\Repositories\User\UserRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Family\FamilyRepositoryInterface',
            'SigeTurbo\Repositories\Family\FamilyRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Inventory\InventoryRepositoryInterface',
            'SigeTurbo\Repositories\Inventory\InventoryRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Inventorytype\InventorytypeRepositoryInterface',
            'SigeTurbo\Repositories\Inventorytype\InventorytypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Category\CategoryRepositoryInterface',
            'SigeTurbo\Repositories\Category\CategoryRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Cost\CostRepositoryInterface',
            'SigeTurbo\Repositories\Cost\CostRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Costcenter\CostcenterRepositoryInterface',
            'SigeTurbo\Repositories\Costcenter\CostcenterRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Status\StatusRepositoryInterface',
            'SigeTurbo\Repositories\Status\StatusRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Town\TownRepositoryInterface',
            'SigeTurbo\Repositories\Town\TownRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Stratus\StratusRepositoryInterface',
            'SigeTurbo\Repositories\Stratus\StratusRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Ethnicgroup\EthnicgroupRepositoryInterface',
            'SigeTurbo\Repositories\Ethnicgroup\EthnicgroupRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Maritalstatus\MaritalstatusRepositoryInterface',
            'SigeTurbo\Repositories\Maritalstatus\MaritalstatusRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Gender\GenderRepositoryInterface',
            'SigeTurbo\Repositories\Gender\GenderRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Religion\ReligionRepositoryInterface',
            'SigeTurbo\Repositories\Religion\ReligionRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Purchase\PurchaseRepositoryInterface',
            'SigeTurbo\Repositories\Purchase\PurchaseRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Evaluationpurchase\EvaluationpurchaseRepositoryInterface',
            'SigeTurbo\Repositories\Evaluationpurchase\EvaluationpurchaseRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Detail\DetailRepositoryInterface',
            'SigeTurbo\Repositories\Detail\DetailRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Product\ProductRepositoryInterface',
            'SigeTurbo\Repositories\Product\ProductRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Observertype\ObservertypeRepositoryInterface',
            'SigeTurbo\Repositories\Observertype\ObservertypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Observer\ObserverRepositoryInterface',
            'SigeTurbo\Repositories\Observer\ObserverRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Payment\PaymentRepositoryInterface',
            'SigeTurbo\Repositories\Payment\PaymentRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Points\PointsRepositoryInterface',
            'SigeTurbo\Repositories\Points\PointsRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Enrollment\EnrollmentRepositoryInterface',
            'SigeTurbo\Repositories\Enrollment\EnrollmentRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Enrollmentreason\EnrollmentreasonRepositoryInterface',
            'SigeTurbo\Repositories\Enrollmentreason\EnrollmentreasonRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Task\TaskRepositoryInterface',
            'SigeTurbo\Repositories\Task\TaskRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Areamanager\AreamanagerRepositoryInterface',
            'SigeTurbo\Repositories\Areamanager\AreamanagerRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Area\AreaRepositoryInterface',
            'SigeTurbo\Repositories\Area\AreaRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Grade\GradeRepositoryInterface',
            'SigeTurbo\Repositories\Grade\GradeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Bloodtype\BloodtypeRepositoryInterface',
            'SigeTurbo\Repositories\Bloodtype\BloodtypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Healthinformation\HealthinformationRepositoryInterface',
            'SigeTurbo\Repositories\Healthinformation\HealthinformationRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Prepaidmedical\PrepaidmedicalRepositoryInterface',
            'SigeTurbo\Repositories\Prepaidmedical\PrepaidmedicalRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Origeninformation\OrigeninformationRepositoryInterface',
            'SigeTurbo\Repositories\Origeninformation\OrigeninformationRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Country\CountryRepositoryInterface',
            'SigeTurbo\Repositories\Country\CountryRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Language\LanguageRepositoryInterface',
            'SigeTurbo\Repositories\Language\LanguageRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Medicalinsurance\MedicalinsuranceRepositoryInterface',
            'SigeTurbo\Repositories\Medicalinsurance\MedicalinsuranceRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Group\GroupRepositoryInterface',
            'SigeTurbo\Repositories\Group\GroupRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Weeklyevaluation\WeeklyevaluationRepositoryInterface',
            'SigeTurbo\Repositories\Weeklyevaluation\WeeklyevaluationRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Monitoring\MonitoringRepositoryInterface',
            'SigeTurbo\Repositories\Monitoring\MonitoringRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Period\PeriodRepositoryInterface',
            'SigeTurbo\Repositories\Period\PeriodRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Year\YearRepositoryInterface',
            'SigeTurbo\Repositories\Year\YearRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Group\GroupRepositoryInterface',
            'SigeTurbo\Repositories\Group\GroupRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Groupdirector\GroupdirectorRepositoryInterface',
            'SigeTurbo\Repositories\Groupdirector\GroupdirectorRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Subject\SubjectRepositoryInterface',
            'SigeTurbo\Repositories\Subject\SubjectRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Schoolinformation\SchoolinformationRepositoryInterface',
            'SigeTurbo\Repositories\Schoolinformation\SchoolinformationRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Nivel\NivelRepositoryInterface',
            'SigeTurbo\Repositories\Nivel\NivelRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Indicator\IndicatorRepositoryInterface',
            'SigeTurbo\Repositories\Indicator\IndicatorRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Monitoringtype\MonitoringtypeRepositoryInterface',
            'SigeTurbo\Repositories\Monitoringtype\MonitoringtypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Monitoringtypeindicator\MonitoringtypeindicatorRepositoryInterface',
            'SigeTurbo\Repositories\Monitoringtypeindicator\MonitoringtypeindicatorRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Monitoringcategorybyyear\MonitoringcategorybyyearRepositoryInterface',
            'SigeTurbo\Repositories\Monitoringcategorybyyear\MonitoringcategorybyyearRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Attendance\AttendanceRepositoryInterface',
            'SigeTurbo\Repositories\Attendance\AttendanceRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Tasktype\TasktypeRepositoryInterface',
            'SigeTurbo\Repositories\Tasktype\TasktypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Partial\PartialRepositoryInterface',
            'SigeTurbo\Repositories\Partial\PartialRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Provider\ProviderRepositoryInterface',
            'SigeTurbo\Repositories\Provider\ProviderRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Statuspurchase\StatuspurchaseRepositoryInterface',
            'SigeTurbo\Repositories\Statuspurchase\StatuspurchaseRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Notification\NotificationRepositoryInterface',
            'SigeTurbo\Repositories\Notification\NotificationRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Visitor\VisitorRepositoryInterface',
            'SigeTurbo\Repositories\Visitor\VisitorRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Visitortype\VisitortypeRepositoryInterface',
            'SigeTurbo\Repositories\Visitortype\VisitortypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Identification\IdentificationRepositoryInterface',
            'SigeTurbo\Repositories\Identification\IdentificationRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Identificationtype\IdentificationtypeRepositoryInterface',
            'SigeTurbo\Repositories\Identificationtype\IdentificationtypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Descriptivereport\DescriptivereportRepositoryInterface',
            'SigeTurbo\Repositories\Descriptivereport\DescriptivereportRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Statusschooltype\StatusschooltypeRepositoryInterface',
            'SigeTurbo\Repositories\Statusschooltype\StatusschooltypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Asset\AssetRepositoryInterface',
            'SigeTurbo\Repositories\Asset\AssetRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Ubication\UbicationRepositoryInterface',
            'SigeTurbo\Repositories\Ubication\UbicationRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Quality\QualityRepositoryInterface',
            'SigeTurbo\Repositories\Quality\QualityRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Assetcategory\AssetcategoryRepositoryInterface',
            'SigeTurbo\Repositories\Assetcategory\AssetcategoryRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Route\RouteRepositoryInterface',
            'SigeTurbo\Repositories\Route\RouteRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Responsibleparent\ResponsibleparentRepositoryInterface',
            'SigeTurbo\Repositories\Responsibleparent\ResponsibleparentRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Routebyuser\RoutebyuserRepositoryInterface',
            'SigeTurbo\Repositories\Routebyuser\RoutebyuserRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Conveyor\ConveyorRepositoryInterface',
            'SigeTurbo\Repositories\Conveyor\ConveyorRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Vehicle\VehicleRepositoryInterface',
            'SigeTurbo\Repositories\Vehicle\VehicleRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Voucherconsecutive\VoucherconsecutiveRepositoryInterface',
            'SigeTurbo\Repositories\Voucherconsecutive\VoucherconsecutiveRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Vouchertype\VouchertypeRepositoryInterface',
            'SigeTurbo\Repositories\Vouchertype\VouchertypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Transaction\TransactionRepositoryInterface',
            'SigeTurbo\Repositories\Transaction\TransactionRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Transactiontype\TransactiontypeRepositoryInterface',
            'SigeTurbo\Repositories\Transactiontype\TransactiontypeRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Request\RequestRepositoryInterface',
            'SigeTurbo\Repositories\Request\RequestRepository'
        );
        App::bind(
            'SigeTurbo\Repositories\Consent\ConsentRepositoryInterface',
            'SigeTurbo\Repositories\Consent\ConsentRepository'
        );
    }
}
