<?php

namespace SigeTurbo\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use SigeTurbo\Jobs\AttendancesLevel01Job;
use SigeTurbo\Repositories\Attendance\AttendanceRepositoryInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;

class AttendancesLevel01 extends Command
{

    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'sigeturbo:attendances_level01';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Send Preschool attendances report';
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
        $users = $this->userRepository->getUsersByRoles('Admin,Academic,Principal,Discipline,Admission,HomeroomTeacher,Assistant');
        foreach ($users as $user) {
            if ($user) {
                $data = ['user' => $user, 'attendances' => $this->attendanceRepository->getAttendancesLevel01Today()];
                $this->dispatch(new AttendancesLevel01Job($data));
            }
        }
        $this->info('Preschool attendances report was sent successfully');
    }
}
