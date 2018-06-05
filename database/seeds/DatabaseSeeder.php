<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Eloquent::unguard();
        $this->call('AclsTableSeeder');
        $this->command->info('Acls table seeded!');
        $this->call('AreasTableSeeder');
        $this->command->info('Areas table seeded!');
        $this->call('BloodtypesTableSeeder');
        $this->command->info('Bloodtypes table seeded!');
        $this->call('CalendarsTableSeeder');
        $this->command->info('Calendars table seeded!');
        $this->call('CategoriesTableSeeder');
        $this->command->info('Categories table seeded!');
        $this->call('CountriesTableSeeder');
        $this->command->info('Countries table seeded!');
        $this->call('DepartmentsTableSeeder');
        $this->command->info('Departments table seeded!');
        $this->call('TownsTableSeeder');
        $this->command->info('Towns table seeded!');
        $this->call('EthnicgroupsTableSeeder');
        $this->command->info('Ethnicgroups table seeded!');
        $this->call('GendersTableSeeder');
        $this->command->info('Genders table seeded!');
        $this->call('GradesTableSeeder');
        $this->command->info('Grades table seeded!');
        $this->call('GroupsTableSeeder');
        $this->command->info('Groups table seeded!');
        $this->call('IdentificationtypesTableSeeder');
        $this->command->info('Identificationtypes table seeded!');
        $this->call('IndicatortypesTableSeeder');
        $this->command->info('Indicatortypes table seeded!');
        $this->call('IndicatorcategoriesTableSeeder');
        $this->command->info('Indicatorcategories table seeded!');
        $this->call('MaritalstatusesTableSeeder');
        $this->command->info('Maritalstatuses table seeded!');
        $this->call('MonitoringcategoriesTableSeeder');
        $this->command->info('Monitoringcategories table seeded!');
        $this->call('PeriodsTableSeeder');
        $this->command->info('Periods table seeded!');
        $this->call('ProvenancesTableSeeder');
        $this->command->info('Provenances table seeded!');
        $this->call('ReligionsTableSeeder');
        $this->command->info('Religions table seeded!');
        $this->call('StatusesTableSeeder');
        $this->command->info('Statuses table seeded!');
        $this->call('StatusschooltypesTableSeeder');
        $this->command->info('Statusschooltypes table seeded!');
        $this->call('StratusesTableSeeder');
        $this->command->info('Stratuses table seeded!');
        $this->call('SubjectsTableSeeder');
        $this->command->info('Subjects table seeded!');
        $this->call('TownsTableSeeder');
        $this->command->info('Towns table seeded!');
        $this->call('NivelsTableSeeder');
        $this->command->info('Nivels table seeded!');
        $this->call('NotificationsTableSeeder');
        $this->command->info('Notifications table seeded!');
        $this->call('UsersTableSeeder');
        $this->command->info('Users table seeded!');
        $this->call('YearsTableSeeder');
        $this->command->info('Years table seeded!');
        $this->call('MonitoringcategorybyyearsTableSeeder');
        $this->command->info('Monitoringcategorybyyears table seeded!');
        $this->call('MonitoringtypesTableSeeder');
        $this->command->info('Monitoringtypes table seeded!');
        $this->call('MonitoringsTableSeeder');
        $this->command->info('Monitorings table seeded!');
        $this->call('EnrollmentsTableSeeder');
        $this->command->info('Enrollments table seeded!');
        $this->call('AchievementsTableSeeder');
        $this->command->info('Achievements table seeded!');
        $this->call('IndicatorsTableSeeder');
        $this->command->info('Indicators table seeded!');
        $this->call('MonitoringtypeindicatorsTableSeeder');
        $this->command->info('Monitoringtypeindicators table seeded!');
        $this->call('NotificationusersTableSeeder');
        $this->command->info('Notificationusers table seeded!');
        $this->call('ContractsTableSeeder');
        $this->command->info('Contracts table seeded!');
        $this->call('AcademicsTableSeeder');
        $this->command->info('Academics table seeded!');
        $this->call('AttendancesTableSeeder');
        $this->command->info('Attendances table seeded!');
        $this->call('FamiliesTableSeeder');
        $this->command->info('Families table seeded!');
        $this->call('UserfamiliesTableSeeder');
        $this->command->info('Userfamilies table seeded!');
        $this->call('StatuspurchasesTableSeeder');
        $this->command->info('Statuspurchases table seeded!');
        $this->call('ProductcategoriesTableSeeder');
        $this->command->info('Productcategories table seeded!');
        $this->call('ProductsTableSeeder');
        $this->command->info('Products table seeded!');
        $this->call('ObservertypesTableSeeder');
        $this->command->info('Observertypes table seeded!');
        $this->call('TasktypesTableSeeder');
        $this->command->info('Tasktypes table seeded!');
        $this->call('AreamanagersTableSeeder');
        $this->command->info('Areamanagers table seeded!');
        $this->call('VisitortypesTableSeeder');
        $this->command->info('Visitortypes table seeded!');
        $this->call('DescriptivereportsTableSeeder');
        $this->command->info('Descriptivereports table seeded!');
        $this->call('LanguagesTableSeeder');
        $this->command->info('Languages table seeded!');
        $this->call('PaymenttypesTableSeeder');
        $this->command->info('Paymenttypes table seeded!');
        $this->call('BanksTableSeeder');
        $this->command->info('Banks table seeded!');
        $this->call('ConcepttypesTableSeeder');
        $this->command->info('Concepttypes table seeded!');
        Model::reguard();
    }
}
