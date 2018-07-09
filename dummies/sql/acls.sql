/*####
--ACLS GENERALS
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('exports.type.mime', 'Admin,Academic,Principal,HomeroomTeacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('notifications', 'Admin,Admission,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('notifications.dashboard','Admin,Teacher,Academic,Principal,Assistant,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('notificationsbyuser', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('profile', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('push', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('push.features', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('push.monitorings', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('settings', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('settings.points', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('uploads.tasks.delete','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('uploads.tasks.upload','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('uploads.users.photo','Admin,Admission',NOW(), NOW());

/*####
--ACLS MODELES
####*/

/*####
--Dashboard
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('dashboard','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Parents,Doorman,Maintenance,Admission,HelpDesk,Assistant,Student,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('home','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Parents,Doorman,Maintenance,HelpDesk,Admission,Assistant,Student,Resources',NOW(),NOW());

/*####
--Admissions
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.dashboard','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.families.assign','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.families.create','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.families.edit','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.families.index','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.families.store','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.healthinformations.store','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.healthinformations.update','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.identifications.index','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.identifications.store','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.identifications.update','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.origeninformations.store','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.origeninformations.update','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.quantitativerecoveryfinalareas.getrecoveriesbyuser','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.quantitativerecoveryfinalareas.index','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.responsibleparents.store','Admin,Account,Admission,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.responsibleparents.update','Admin,Account,Admission,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.schoolinformations.index','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.schoolinformations.store','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.schoolinformations.update','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.students.create','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.students.edit','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.students.index','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.students.store','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.students.update','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.users.index','Admin,Admission',NOW(),NOW());

/*####
--Finalcials
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.dashboard', 'Admin,Principal,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.packages.create', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.packages.index','Admin,Account,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.payments.convert','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.payments.convert.manualreceipt','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.payments.convert.virtualreceipt','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.receipts.export','Admin,Account,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.payments.create', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.payments.edit','Admin,Account,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.payments.index','Admin,Account,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.payments.receipts','Admin,Account,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.students.index', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('financials.students.transactions', 'Admin,Account,Treasurer', NOW(), NOW());


/*#######
--Transports
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('admissions.transports.index', 'Admin', NOW(), NOW());

/*####
--Formation
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.dashboard','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.attendances.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.attendances.showbystudent','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.attendances.delete','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.descriptivereports.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.indicators.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.monitoringtypes.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.monitorings.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.observators.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.observators.create','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.observators.showbystudent','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.partials.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.tasks.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.tasks.create','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.tasks.update','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.tasks.destroy','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.tasks.edit','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.statistics.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.statistics.group','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.statistics.subject','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.statistics.area','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.contracts.init','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.contracts.index','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.contracts.getperiodsbyyear','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.groupdirectors.init','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.academics.init','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.areamanagers.init','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.monitoringcategorybyyears.init','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.subjects.init','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.votes.init','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('formation.monitorings.studentspendigsbymonitoring','Admin,Academic,Principal,Account,Treasurer,AreaManager,HomeroomTeacher,Teacher',NOW(),NOW());

/*####
--Resources
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.assets.create', 'Admin,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.assets.destroy', 'Admin,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.assets.edit', 'Admin,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.assets.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.assets.store', 'Admin,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.dashboard','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.details.create','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.inventories.index','Admin,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.inventories.inventory','Admin,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.inventories.verify','Admin,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.providers.create', 'Admin,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.providers.create', 'Admin,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.providers.destroy', 'Admin,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.providers.edit', 'Admin,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.providers.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.providers.update', 'Admin,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.purchases.create','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.purchases.edit','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.purchases.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.visitors.create','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.visitors.destroy','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.visitors.edit','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('resources.visitors.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());


/*####
--Communications
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('communications.dashboard','Admin,Academic,Principal,Teacher,HomeroomTeacher,AreaManager,Account,Communicator,Treasurer,RRHH,Discipline,Counseling,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('communications.weeklyevaluations.create','Admin,Academic,Principal,Teacher,Communicator,Account,Discipline,Counseling', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('communications.weeklyevaluations.destroy','Admin,Academic,Principal,Teacher,Communicator,Account,Discipline,Counseling', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('communications.weeklyevaluations.edit','Admin,Academic,Principal,Teacher,Communicator,Account,Discipline,Counseling', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('communications.weeklyevaluations.index','Admin,Academic,Principal,Teacher,Communicator,Account,Discipline,Counseling,Resources', NOW(), NOW());

/*####
--Parents
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.dashboard', 'Admin,Parents,Student', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.homeworks.index', 'Admin,Parents,Student', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.members.index', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.monitoring.detail', 'Admin,Parents,Student', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.monitoring.index', 'Admin,Parents,Student', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.payments.checkout', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.payments.detailpaymentbyparent', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.payments.index', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.payments.respond', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.profile.member.index', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('parents.reports.index', 'Admin,Parents', NOW(), NOW());

/*######
---Users
######*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('uploads.consents.upload','Admin',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('users.consent.index', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('users.request.index', 'Admin', NOW(), NOW());


/*####
--API V1
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.academics.destroy','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.academics.getacademicsbyyear','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.academics.store','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.academics.update','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.achievements.destroy', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.achievements.getachievementsbygroup', 'Admin,Teacher,Academic,Principal,AreaManager,Counseling', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.achievements.store', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.achievements.update', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.accountingentries.getaccountingentriesbyreceipt', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.accountingentries.store', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.accountingentries.update', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.accountingentries.destroy', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.areamanagers.destroy','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.areamanagers.getareamanagersbyyear','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.areamanagers.store','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.areamanagers.update','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.areas.getareasbyyear', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.areas.index', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.assets.destroy', 'Admin,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.assets.setverified', 'Admin,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.assets.store', 'Admin,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.assets.update', 'Admin,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendancecontrols.index', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendancecontrols.show', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendancecontrols.store', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendancecontrols.update', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendances.destroy', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendances.getattendancesamountbydate','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Assistant,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendances.index', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendances.show', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendances.store', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.attendances.update', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.banks.index', 'Admin,Principal,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.banks.show', 'Admin,Principal,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.bloodtypes.index', 'Admin,Teacher,Parents,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.calendars.index','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.categories.getcategorycodebyname', 'Admin,Teacher,Academic,Principal,Admission,Resources,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.categories.index', 'Admin,Teacher,Academic,Principal,Admission,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.concepttypes.index', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.consenttypes.index', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.contracts.getcontractsbyparams', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.contracts.getcontractsbyyearandperiod', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.contracts.store', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.contracts.update', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.conveyors.index', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.conveyors.store', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.conveyors.update', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.costcenters.getcostcenterbystudent', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.costs.getcostsbypackage', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.descriptivereports.destroy','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.descriptivereports.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.descriptivereports.show','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.descriptivereports.store','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.descriptivereports.update','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.details.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.details.store','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.details.update','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.destroy','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentlatestbystudentwithcost','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollments','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentsbystatus','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentsbystudent','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentslatestbystudent','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentswithattendance','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentswithdata','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentswithdescriptivereport','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentswithgrades','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentswithobservers','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.getenrollmentswithpartial','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.index','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.show','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Teacher,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.store','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.enrollments.update','Admin,Admission,Counseling,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.ethnicgroups.index', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.evaluationpurchases.getevaluationbypurchase','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,HelpDesk,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.evaluationpurchases.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.evaluationpurchases.show','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,HelpDesk,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.evaluationpurchases.store','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,HelpDesk,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.exports.receipts.reports','Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.exports.reports.descriptive','Admin,Parents,HomeroomTeacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.exports.reports.final','Admin,Parents,HomeroomTeacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.exports.reports.partials','Admin,Parents,HomeroomTeacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.exports.students.enrollments','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,HelpDesk,Admission,Librarian', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.families.searchfamilies','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.families.searchfamilybyname','Admin,Admissions',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.families.getpaymentsbyfamily', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.families.store','Admin,Admissions',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.genders.index', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.grades.index', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.grades.show', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.groupdirectors.destroy','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.groupdirectors.getgroupdirectorsbyyear','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.groupdirectors.store','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.groupdirectors.update','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.groups.getgroupsbyyearandperiod','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,HomeroomTeacher,AreaManager,Admission,Account.Treasurer,Communicator,Assistant,Librarian,Nurse,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.groups.getgroupsbyyearsandperiod','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission,Treasurer,Account,Communicator',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.groups.index','Admin.Teacher,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission,Account,Treasurer,Principal,Communicator,Librarian,Nurse,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.groups.show', 'Admin,Teacher,Academic,Principal,AreaManager,HomeroomTeacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.identificationtypes.index', 'Admin,Teacher,Parents,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.indicators.destroy', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.indicators.getindicators','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.indicators.getindicatorsbygroup','Admin,Teacher,Academic,Principal,Admission,AreaManager',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.indicators.getindicatorspendingbyteacher','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.indicators.store', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.indicators.update', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.inventorytypes.index', 'Admin,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.maritalstatuses.index', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringcategories.index','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringcategorybyyears.destroy','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringcategorybyyears.getmonitoringcategoriesbyyearandsubject','Admin,Teacher,Academic,Principal,AreaManager,HomeroomTeacher,Admission,Counseling',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringcategorybyyears.getmonitoringcategorybyyeardetail','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringcategorybyyears.store','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringcategorybyyears.update','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitorings.destroy', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitorings.getglobalperformances','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitorings.getmonitoringsbyuser','Admin,Teacher,Academic,Principal,AreaManager,HomeroomTeacher,Admission,Counseling',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitorings.getmonitoringsbyuserforparents','Admin,Teacher,Parents,Academic,Principal,AreaManager,HomeroomTeacher,Admission,Student',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitorings.getmonitoringsincurrentweek','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitorings.getmonitoringsperformancebystudent','Admin,Teacher,Parents,Academic,Principal,AreaManager,HomeroomTeacher,Admission,Student',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitorings.getstudentspendigsbymonitoring','Admin,Academic,Principal,Account,Treasurer,AreaManager,HomeroomTeacher,Teacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitorings.store', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitorings.update', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringtypeindicators.destroy','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringtypeindicators.store','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringtypes.destroy', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringtypes.getmonitoringtypesbycategory','Admin,Teacher,Academic,Principal,Admission,AreaManager',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringtypes.getmonitoringtypesbygroup','Admin,Teacher,Academic,Principal,AreaManager,HomeroomTeacher,Admission,Counseling',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringtypes.getmonitoringtypesbygroupchart','Admin,Teacher,Academic,Principal,Admission,AreaManager,Counseling',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringtypes.store', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.monitoringtypes.update', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.nivels.getnivelsbysubject','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.nivels.getnivelsbyyearandperiodandgroupandsubject','Admin,Teacher,Academic,Principal,Discipline,AreaManager,HomeroomTeacher,Admission,Assistant,Counseling',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.nivels.index','Admin,Teacher,Academic,Principal,Discipline,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.observers.destroy','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.observers.getobservers','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.observers.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.observers.show','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.observers.store','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.observers.update','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.observertypes.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,RRHH,Discipline,Counseling',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.packages.getpackagesbyconcept','Admin,Account,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.partialratings.destroy','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.partialratings.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.partialratings.show','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.partialratings.store','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.partialratings.update','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.getpaymentsbyuser', 'Admin,Teacher,Parents,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.getpaymentsbyuserwithtransactions','Admin,Account,Treasurer',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.getpaymentspending', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.getpaymentspendingbyuser', 'Admin,Account,Treasurer,HomeroomTeacher,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.setpaymentagreement', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.setpaymentindividual', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.setpaymentindividualnew', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.setpaymentindividualbyuser', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.setpaymentmassive', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.setpaymentmethod', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.update', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.updatepaymentshort', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.payments.verifypaymentpending', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.periods.getcurrentperiod','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.periods.getperiodsbyyear','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission,Assistant',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.periods.index','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.prepaidmedicals.index', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.medicalinsurances.index', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.preregistrations.destroy', 'Admin,Teacher,Parents,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.preregistrations.getpreregistrationbyuser', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.preregistrations.show', 'Admin,Teacher,Parents,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.preregistrations.store', 'Admin,Teacher,Parents,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.preregistrations.update', 'Admin,Teacher,Parents,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.preregistrations.updateprofilegeneral', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.preregistrations.updateprofilemedical', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.preregistrations.updateprofileadditional', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.preregistrations.updateprofileprofession', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.productcategories.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Resources',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.products.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.products.searchbycode','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.providers.create', 'Admin,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.providers.destroy', 'Admin,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.providers.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Resources',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.providers.update', 'Admin,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.purchases.destroy','Admin,HelpDesk,Assistant,Resources,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.purchases.generatecode','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant,Resources,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.purchases.getdiscount','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant,Resources,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.purchases.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant,Resources,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.purchases.show','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant,Resources,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.purchases.statusupdate', 'Admin,Resources,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.purchases.store','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant,Resources,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.purchases.update','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant,Resources,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.qualitativerecoveryfinalareas.store', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.qualitativerecoveryfinalareas.update', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.quantitativerecoveries.destroy', 'Admin,Teacher,Academic', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.quantitativerecoveries.getrecoverybyuser','Admin,Teacher,Academic,Principal,AreaManager,HomeroomTeacher,Admission,Counseling',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.quantitativerecoveries.show', 'Admin,Teacher,Academic,Principal,AreaManager', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.quantitativerecoveries.store', 'Admin,Teacher,Academic,Areamanager', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.quantitativerecoveries.update', 'Admin,Teacher,Academic,AreaManager', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.quantitativerecoveryfinalareas.store', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.quantitativerecoveryfinalareas.update', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.receipts.index', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.receipts.store', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.receipts.getreceiptsbyvouchertype', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.religions.index', 'Admin,Teacher,Academic,Parents,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.reports.getreportbystudent', 'Admin,HomeroomTeacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.reports.getreportenabled', 'Admin,HomeroomTeacher,Parents,Student', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.reports.store', 'Admin,HomeroomTeacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.responsibleparents.getresponsibleparentbystudent', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.routebyusers.destroy', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.routebyusers.store', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.routes.store', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.routes.update', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.settings.getpoints', 'Admin,Teacher,Parents,Academic,Principal,Student', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statistics.globalperformancebyarea','Admin,Teacher,Academic,Principal,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statistics.globalperformancebygroup','Admin,Teacher,Academic,Principal,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statistics.globalperformancebysubject','Admin,Teacher,Academic,Principal,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statistics.globalperformances', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statuses.index', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statuspurchases.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,HelpDesk,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statusschooltypes.destroy','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statusschooltypes.edit','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statusschooltypes.index','Admin,Admission,Counseling,Account,Treasurer,Academic,Principal,Communicator,Discipline,Librarian,Nurse,RRHH,AreaManager,HomeroomTeacher,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statusschooltypes.show','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statusschooltypes.store','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.statusschooltypes.update','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.stratuses.index', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.subjects.getsubjectsbyyear','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.subjects.getsubjectsbyyearandperiodandgroup','Admin,Teacher,Academic,Principal,Discipline,AreaManager,HomeroomTeacher,Admission,Assistant,Counseling',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.subjects.getsubjectwithareasandnivels','Admin',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.subjects.index','Admin,Teacher,Academic,Principal,Discipline,AreaManager,HomeroomTeacher,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.tasks.destroy','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.tasks.gettasks','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.tasks.gettasksbyuser', 'Admin,Academic,Principal,HomeroomTeacher,Parents,Student', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.tasks.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.tasks.setapproved', 'Admin,Academic,Principal,AreaManager', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.tasks.show','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.tasks.store','Admin,Teacher,Academic,Principal,AreaManager',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.tasks.update','Admin,Teacher,Academic,Principal,AreaManager',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.tasktypes.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Librarian,Nurse,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.towns.index', 'Admin,Teacher,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.transactions.destroy', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.transactions.findvoucherintransactions', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.transactions.gettransactionsbypayment', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.transactions.store', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.transactions.update', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.transactiontypes.index', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.ubications.getubications','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,HelpDesk,Resources', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.ubications.index', 'Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher',NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.userfamilies.getusersbyfamily', 'Admin,Teacher,Parents,Academic,Principal', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.getallstudents', 'Admin,Academic,Principal,Account,Treasurer,AreaManager,HomeroomTeacher,Teacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.getlatest','Admin,Admissions',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.getlatestcode','Admin,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.getpersonalacademic', 'Admin,Academic,Principal,Account,Treasurer,AreaManager,HomeroomTeacher,Teacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.index', 'Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.savecelularbycertification','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.savecelularbypasscode','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.saveemailbycertification','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.saveemailbypasscode','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.show', 'Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.store', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.update','Admin,Admissions',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.verifycelular','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.verifycelularmessage','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.verifyemail','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.verifyemailmessage','Admin,Account,Admission',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.users.getpaymentsbyuser', 'Admin,Account,Treasurer', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.vehicles.index', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.vehicles.store', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.vehicles.update', 'Admin', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitors.checkin','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitors.checkout','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitors.destroy','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitors.generatecode','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitors.getvisitorsnow','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitors.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitors.show','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitors.store','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitors.update','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Librarian,Assistant,Admission,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitortypes.index','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.visitortypes.show','Admin,Teacher,Academic,Principal,Account,Treasurer,Communicator,Doorman,Maintenance,Counseling,RRHH,HelpDesk,Discipline,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.vouchertypes.getvouchertypes','Admin,Account,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.voucherconsecutives.getvoucherconsecutivebycode','Admin,Account,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.voucherconsecutives.getvoucherconsecutivebyname','Admin,Account,Treasurer',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.weeklyevaluations.getevaluations', 'Admin,Academic,Principal,Teacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.weeklyevaluations.index', 'Admin,Academic,Principal,Teacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.weeklyevaluations.show', 'Admin,Academic,Principal,Teacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.weeklyevaluations.store', 'Admin,Academic,Principal,Teacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.weeklyevaluations.update', 'Admin,Academic,Principal,Teacher', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.years.getcurrentyear','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission,Assistant,Resources',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.years.getcurrentpreregistration','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission,Assistant,Resources,Parents',NOW(),NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v1.years.index','Admin,Teacher,Academic,Principal,RRHH,Discipline,Counseling,AreaManager,HomeroomTeacher,Admission,Treasurer,Account,Assistant,Librarian,Nurse,Resources',NOW(),NOW());

/*####
--API V2
####*/
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v2.tasks.gettasksbyuser', 'Admin,Parents', NOW(), NOW());
INSERT INTO `acls` (`route`, `roles`, `created_at`, `updated_at`) VALUES ('api.v2.users.login', 'Admin,Parents', NOW(), NOW());


