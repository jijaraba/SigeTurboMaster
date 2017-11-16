<?php

namespace SigeTurbo\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use SigeTurbo\Jobs\AttendancesLevel03Job;
use SigeTurbo\Repositories\Attendance\AttendanceRepositoryInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;

class AttendancesLevel03 extends Command
{

    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'sigeturbo:attendances_level03';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Send HighSchool attendances report';
    /**
     * @var AttendanceRepositoryInterface
     */
    private $attendanceRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * Create a new command instance.
     * @param AttendanceRepositoryInterface $attendanceRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(AttendanceRepositoryInterface $attendanceRepository, UserRepositoryInterface $userRepository)
    {
        parent::__construct();
        $this->attendanceRepository = $attendanceRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $users = $this->userRepository->getUsersByRoles('Admin,Principal,Discipline,Admission,HomeroomTeacher,Assistant');
        foreach ($users as $user) {
            if ($user) {
                $data = ['user' => $user, 'attendances' => $this->attendanceRepository->getAttendancesLevel03Today()];
                $this->dispatch(new AttendancesLevel03Job($data));
            }
        }
        $this->info('HighSchool attendances report was sent successfully');
    }
}
