<?php

namespace SigeTurbo\Mailer;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Group;
use SigeTurbo\Jobs\IndicatorCategoryJob;
use SigeTurbo\Jobs\MonitoringInCurrentWeekForParentsJob;
use SigeTurbo\Jobs\ObserverJob;
use SigeTurbo\Jobs\PaymentAcceptedJob;
use SigeTurbo\Jobs\PaymentCreatedJob;
use SigeTurbo\Jobs\PurchaseAcceptedJob;
use SigeTurbo\Jobs\PurchaseDraftJob;
use SigeTurbo\Jobs\PurchaseEvaluationJob;
use SigeTurbo\Jobs\PurchaseInEvaluationJob;
use SigeTurbo\Jobs\VisitorCheckInJob;
use SigeTurbo\Jobs\VisitorCheckOutJob;
use SigeTurbo\Jobs\VisitorNewJob;
use SigeTurbo\Nivel;
use SigeTurbo\Repositories\Groupdirector\GroupdirectorRepository;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\Subject;
use SigeTurbo\User;

class Mailer implements MailerInterface
{

    use DispatchesJobs;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * Mailer constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Send Mail By User
     * @param $service
     * @param $user
     * @param $data
     */
    public function byUser($service, $user, $data)
    {
        $user = User::find($user);
        switch ($service) {
            case 'visitor_new':
                $data = ['user' => $user, 'data' => $data];
                $this->dispatch(new VisitorNewJob($data));
                break;
            case 'visitor_checkin':
                $data = ['user' => $user, 'data' => $data];
                $this->dispatch(new VisitorCheckInJob($data));
                break;
            case 'visitor_checkout':
                $data = ['user' => $user, 'data' => $data];
                $this->dispatch(new VisitorCheckOutJob($data));
                break;
            case 'parents_payment':
                $data = ['user' => $user, 'data' => $data];
                $this->dispatch(new ParentPaymentJob($data));
                break;
        }
    }


    /**
     * Send Email By Users
     * @param $service
     * @param $model
     * @param array $users
     */
    public function byUsers($service, $users = [], $model)
    {
        switch ($service) {
            case 'purchase_inEvaluation':
                foreach ($users as $user) {
                    $user = $this->userRepository->find($user);
                    if ($user) {
                        $data = ['user' => $user, 'purchase' => $model];
                        $this->dispatch(new PurchaseInEvaluationJob($data));
                    }
                }
                break;
            case 'purchase_evaluation':
                foreach ($users as $user) {
                    $user = $this->userRepository->find($user);
                    if ($user) {
                        $data = ['user' => $user, 'purchase' => $model];
                        $this->dispatch(new PurchaseEvaluationJob($data));
                    }
                }
                break;
            case 'monitoring_inCurrentWeekForFamily':
                foreach ($users as $user) {
                    if ($user) {
                        $user = $this->userRepository->find($user->iduser);
                        $data = ['user' => $user, 'monitoring' => $model];
                        $this->dispatch(new MonitoringInCurrentWeekForParentsJob($data));
                    }
                }
                break;
            case 'payment_created':
                foreach ($users as $user) {
                    if ($user) {
                        $user = $this->userRepository->find($user->iduser);
                        $data = ['user' => $user, 'payment' => $model];
                        $this->dispatch(new PaymentCreatedJob($data));
                    }
                }
                break;
        }
    }


    public function byRole($role)
    {
        // TODO: Implement byRole() method.
    }

    /**
     * Send Email By Roles
     * @param $service
     * @param $model
     * @param array $roles
     */
    public function byRoles($service, $model, $roles = [])
    {
        switch ($service) {
            case 'purchase_draft':
                foreach ($roles as $role) {
                    $user = $this->userRepository->getUserByRole($role);
                    if ($user) {
                        $data = ['user' => $user, 'purchase' => $model];
                        $this->dispatch(new PurchaseDraftJob($data));
                    }
                }
                break;
            case 'purchase_accepted':
                foreach ($roles as $role) {
                    $user = $this->userRepository->getUserByRole($role);
                    if ($user) {
                        $data = ['user' => $user, 'purchase' => $model];
                        $this->dispatch(new PurchaseAcceptedJob($data));
                    }
                }
                break;
            case 'payment_accepted':
                foreach ($roles as $role) {
                    $users = $this->userRepository->getUserByRole($role);
                    foreach ($users as $user) {
                        $data = ['user' => $user, 'payment' => $model];
                        $this->dispatch(new PaymentAcceptedJob($data));
                    }
                }
                break;
            case 'indicator_category':
                foreach ($roles as $role) {
                    $users = $this->userRepository->getUserByRole($role);
                    foreach ($users as $user) {
                        $data = ['user' => $user, 'indicator' => $model];
                        $this->dispatch(new IndicatorCategoryJob($data));
                    }
                }
                break;
        }
    }

    /**
     * Observer Send Email by Director Group
     * @param $year
     * @param $group
     * @param $student
     * @param $observer
     */
    public function observerByDirectorGroup($year, $group, $student, $observer)
    {
        //Find Users
        $users = GroupdirectorRepository::getName($year, $group);
        //Find Student
        $student = User::find($student);
        //Teacher
        $teacher = getUser()->firstname . " " . getUser()->lastname;
        if ($users) {
            foreach ($users as $user) {
                $data = ['user' => $user, 'observer' => $observer, 'student' => $student, 'teacher' => $teacher];
                $this->dispatch(new ObserverJob($data));
            }
        }
    }

    public function byDirectorGroups()
    {
        // TODO: Implement byDirectorGroups() method.
    }

    /**
     * Send Email by Families
     * @param $service
     * @param $data
     * @param array $group
     * @param array $family
     * @param array $category
     * @return mixed
     */
    public function byParents($service, $data, $group = [], $family = [], $category = [])
    {
        switch ($service) {
            case 'task':
                //Find Families
                $families = UserfamilyRepository::getFamilies($group, $family, $category);
                //Group
                $group = Group::find($data[0]->idgroup);
                //Subject Name
                $subject = Subject::find($data[0]->idsubject);
                //Nivel Name
                $nivel = Nivel::find($data[0]->idnivel);
                if ($families) {
                    foreach ($families as $user) {
                        Queue::push('SigeTurbo\Queue\TaskService', ['family' => $user, 'task' => $data[0], 'files' => $data[0]->taskfiles, 'group' => $group, 'subject' => $subject, 'nivel' => $nivel]);
                    }
                }
                break;
        }

    }


}