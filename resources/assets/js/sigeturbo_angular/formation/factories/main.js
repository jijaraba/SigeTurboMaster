'use strict';

/* Formation Factories */
angular.module('Formation.factories', [])
    .factory('Year', ['$resource', function ($resource) {
        return $resource('/api/v1/years/:yearId/:action', {yearId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {yearId: ''},
                isArray: true
            },
            getCurrentYear: {
                method: 'GET',
                params: {action: 'getcurrentyear'}
            }

        });
    }])
    .factory('Calendar', ['$resource', function ($resource) {
        return $resource('/api/v1/calendars/:calendarId/:action', {
            calendarId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {calendarId: ''},
                isArray: true
            }
        });
    }])
    .factory('Area', ['$resource', function ($resource) {
        return $resource('/api/v1/areas/:areaId/:action', {
            areaId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {areaId: ''},
                isArray: true
            },
            getAreasByYear: {
                method: 'GET',
                params: {action: 'getareasbyyear'},
                isArray: true
            }
        });
    }])
    .factory('Academic', ['$resource', function ($resource) {
        return $resource('/api/v1/academics/:academicId/:action/year/:yearId', {
            academicId: '@idacademic',
            action: '@action',
            yearId: '@yearId'
        }, {
            all: {
                method: 'GET',
                isArray: true
            },
            getPeriodsByYear: {
                method: 'GET',
                params: {action: 'getperiodsbyyear', yearId: ''},
                isArray: true
            },
            getAcademicsByYear: {
                method: 'GET',
                params: {action: 'getacademicsbyyear'},
                isArray: true
            }
        });
    }])
    .factory('Academicrequest', ['$resource', function ($resource) {
        return $resource('/api/v1/academics/:academicId/:action', {
            academicId: '@idacademic',
            action: '@action'
        }, {
            save: {
                method: 'POST',
            },
            update: {
                method: 'PUT'
            },
            remove: {
                method:'DELETE'
            }
        });
    }])
    .factory('YearV2', ['$resource', function ($resource) {
        return $resource('/api/v2/years/:yearId/:action', {yearId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {yearId: ''},
                isArray: true
            },
            getCurrentYear: {
                method: 'GET',
                params: {action: 'getcurrentyear'}
            }

        });
    }])
    .factory('User', ['$resource', function ($resource) {
        return $resource('/api/v1/users/:userId/:action', {
            userId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {userId: ''},
                isArray: true
            },
            getPersonalAcademic: {
                method: 'GET',
                params: {
                    action: 'getpersonalacademic'
                },
                isArray: true
            },
            getAllStudents: {
                method: 'GET',
                params: {
                    action: 'getallstudents'
                },
                isArray: true
            }
        });
    }])
    .factory('Period', ['$resource', function ($resource) {
        return $resource('/api/v1/periods/:periodId/:action', {
            periodId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {periodId: ''},
                isArray: true
            },
            getPeriodsByYear: {
                method: 'GET',
                params: {action: 'getperiodsbyyear'},
                isArray: true
            },
            getCurrentPeriod: {
                method: 'GET',
                params: {action: 'getcurrentperiod'}
            }
        });
    }])
    .factory('Grade', ['$resource', function ($resource) {
        return $resource('/api/v1/grades/:gradeId', {gradeId: '@id'}, {
            all: {
                method: 'GET',
                params: {gradeId: ''},
                isArray: true
            }
        });
    }])
    .factory('Group', ['$resource', function ($resource) {
        return $resource('/api/v1/groups/:groupId/:action', {
            groupId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {groupId: ''},
                isArray: true
            },
            getGroupsByYearAndPeriod: {
                method: 'GET',
                params: {action: 'getgroupsbyyearandperiod'},
                isArray: true
            },
            getGroupsForObservator: {
                method: 'GET',
                params: {action: 'getgroupsforobservator'},
                isArray: true
            }
        });
    }])
    .factory('GroupDirector', ['$resource', function ($resource) {
        return $resource('/api/v1/groupdirectors/:groupdirectorId/:action', {
            groupdirectorId: '@idgroupdirector',
            yearId: '@id', 
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {yearId: ''},
                isArray: true
            },
            getGroupdirectorsByYear: {
                method: 'GET',
                params: {action: 'getgroupdirectorsbyyear'},
                isArray: true
            },
            update: {
                method: 'PUT'
            },
            remove: {
                method:'DELETE'
            }
        });
    }])
    .factory('AreaManager', ['$resource', function ($resource) {
        return $resource('/api/v1/areamanagers/:areamanagerId/:action', {
            areamanagerId: '@idareamanager',
            yearId: '@id', 
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {yearId: ''},
                isArray: true
            },
            getAreamanagersByYear: {
                method: 'GET',
                params: {action: 'getareamanagersbyyear'},
                isArray: true
            },
            update: {
                method: 'PUT'
            },
            remove: {
                method:'DELETE'
            }
        });
    }])
    .factory('GroupV2', ['$resource', function ($resource) {
        return $resource('/api/v2/groups/:groupId/:action', {
            groupId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {groupId: ''},
                isArray: true
            },
            getGroupsByYearAndPeriod: {
                method: 'GET',
                params: {action: 'getgroupsbyyearandperiod'},
                isArray: true
            }
        });
    }])
    .factory('Subject', ['$resource', function ($resource) {
        return $resource('/api/v1/subjects/:subjectId/:action', {
            subjectId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {subjectId: ''},
                isArray: true
            },
            getSubjectsByYearAndPeriodAndGroup: {
                method: 'GET',
                params: {action: 'getsubjectsbyyearandperiodandgroup'},
                isArray: true
            },
            getSubjectsByYear:{
                method: 'GET',
                params: {action: 'getsubjectsbyyear'},
                isArray: true
            },
            getSubjectWithAreasAndNivels:{
                method: 'GET',
                params: {action: 'getsubjectwithareasandnivels'},
                isArray: true
            }
        });
    }])
    .factory('Nivel', ['$resource', function ($resource) {
        return $resource('/api/v1/nivels/:subjectId/:action', {
            nivelId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {nivelId: ''},
                isArray: true
            },
            getNivelsBySubject: {
                method: 'GET',
                params: {
                    action: 'getnivelsbysubject',subjectId: ''
                },
                isArray: true
            },
            getNivelsByYearAndPeriodAndGroupAndSubject: {
                method: 'GET',
                params: {
                    action: 'getnivelsbyyearandperiodandgroupandsubject'
                },
                isArray: true
            }
        });
    }])
    .factory('Enrollment', ['$resource', function ($resource) {
        return $resource('/api/v1/enrollments/:enrollmentId/:action/year/:yearId/period/:periodId/group/:groupId/subject/:subjectId/nivel/:nivelId', {
            enrollmentId: '@idenrollment',
            action: '@action',
            yearId: '@yearId',
            periodId: '@periodId',
            groupId: '@groupId',
            subjectId: '@subjectId',
            nivelId: '@nivelId'
        }, {
            all: {
                method: 'GET',
                params: {enrollmentId: ''},
                isArray: true
            },
            getEnrollments: {
                method: 'GET',
                params: {action: 'getEnrollments', yearId: '', groupId: ''},
                isArray: true
            },
            getEnrollmentsWithData: {
                method: 'GET',
                params: {
                    action: 'getenrollmentswithdata',
                    yearId: '',
                    periodId: '',
                    groupId: '',
                    subjectId: '',
                    nivelId: ''
                },
                isArray: true
            },
            getEnrollmentsWithAttendance: {
                method: 'GET',
                params: {
                    action: 'getenrollmentswithattendance',
                    yearId: '',
                    periodId: '',
                    groupId: '',
                    subjectId: '',
                    nivelId: ''
                },
                isArray: true
            },
            getEnrollmentsWithPartial: {
                method: 'GET',
                params: {
                    action: 'getenrollmentswithpartial',
                    yearId: '',
                    periodId: '',
                    groupId: '',
                    subjectId: '',
                    nivelId: ''
                },
                isArray: true
            },
            getEnrollmentsWithDescriptivereport: {
                method: 'GET',
                params: {
                    action: 'getenrollmentswithdescriptivereport',
                    yearId: '',
                    periodId: '',
                    groupId: '',
                    subjectId: '',
                    nivelId: ''
                },
                isArray: true
            },
            getEnrollmentsWithGrade: {
                method: 'GET',
                params: {
                    action: 'getenrollmentswithgrades',
                    yearId: '',
                    periodId: '',
                    groupId: '',
                    subjectId: '',
                    nivelId: ''
                },
                isArray: true
            }

        });
    }])
    .factory('EnrollmentSimple', ['$resource', function ($resource) {
        return $resource('/api/v1/enrollments/:enrollmentId/:action/year/:yearId/group/:groupId', {
            enrollmentId: '@idenrollment',
            action: '@action',
            yearId: '@yearId',
            periodId: '@periodId',
            groupId: '@groupId',
            subjectId: '@subjectId',
            nivelId: '@nivelId'
        }, {
            all: {
                method: 'GET',
                params: {enrollmentId: ''},
                isArray: true
            },
            getEnrollments: {
                method: 'GET',
                params: {action: 'getenrollments', yearId: '', groupId: ''},
                isArray: true
            },
            getEnrollmentsWithObserver: {
                method: 'GET',
                params: {
                    action: 'getenrollmentswithobservers',
                    yearId: '',
                    groupId: ''
                },
                isArray: true
            }

        });
    }])
    .factory('Monitoringcategorybyyear', ['$resource', function ($resource) {
        return $resource('/api/v1/monitoringcategorybyyears/:monitoringcategorybyyearId/:action/year/:yearId/subject/:subjectId', {
            monitoringcategorybyyearId: '@idmonitoringcategorybyyear',
            action: '@action',
            yearId: '@yearId',
            subjectId: '@subjectId'
        }, {
            all: {
                method: 'GET',
                params: {monitoringcategorybyyearId: ''},
                isArray: true
            },
            getMonitoringCategoriesByYearAndSubject: {
                method: 'GET',
                params: {action: 'getmonitoringcategoriesbyyearandsubject', yearId: '', subjectId: ''},
                isArray: true
            }

        });
    }])
    .factory('Monitoringcategorybyyearrequest', ['$resource', function ($resource) {
        return $resource('/api/v1/monitoringcategorybyyears/:monitoringcategorybyyearId/:action', {
            monitoringcategorybyyearId: '@idmonitoringcategorybyyear',
            action: '@action'
        }, {
            getMonitoringcategoriesByYear: {
                method: 'GET',
                params: {action: 'getmonitoringcategorybyyeardetail'},
                isArray: true
            },update: {
                method: 'PUT'
            },
            remove: {
                method:'DELETE'
            }

        });
    }])
    .factory('Monitoringtype', ['$resource', function ($resource) {
        return $resource('/api/v1/monitoringtypes/:monitoringtypeId/:action', {
            monitoringtypeId: '@idmonitoringtype',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {monitoringtypeId: ''},
                isArray: true
            },
            getMonitoringtypesByGroup: {
                method: 'GET',
                params: {action: 'getmonitoringtypesbygroup'},
                isArray: true
            },
            getMonitoringtypesByGroupChart: {
                method: 'GET',
                params: {action: 'getmonitoringtypesbygroupchart'},
                isArray: true
            },
            getMonitoringtypesByCategory: {
                method: 'GET',
                params: {action: 'getmonitoringtypesbycategory'},
                isArray: true
            }

        });
    }])
    .factory('Monitoringcategory', ['$resource', function ($resource) {
        return $resource('/api/v1/monitoringcategories/:monitoringcategoryId/:action', {
            monitoringcategoryId: '@idmonitoringcategory',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {monitoringcategoryId: ''},
                isArray: true
            }
        });
    }])
    .factory('Monitoring', ['$resource', function ($resource) {
        return $resource('/api/v1/monitorings/:monitoringId/:action', {
            monitoringId: '@idmonitoring',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {monitoringId: ''},
                isArray: true
            },
            getMonitoringsByUser: {
                method: 'GET',
                params: {action: 'getmonitoringsbyuser'},
                isArray: true
            },
            getGlobalPerformances: {
                method: 'GET',
                params: {action: 'getglobalperformances'},
                isArray: true
            },
            getMonitoringsInCurrentWeek: {
                method: 'GET',
                params: {action: 'getmonitoringsincurrentweek'},
                isArray: true
            },
            getMonitoringsPendingsByUser: {
                method: 'GET',
                params: {action: 'getstudentspendigsbymonitoring'},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Achievement', ['$resource', function ($resource) {
        return $resource('/api/v1/achievements/:achievementId/:action', {
            achievementId: '@idachievement',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {monitoringId: ''},
                isArray: true
            },
            getAchievementsByGroup: {
                method: 'GET',
                params: {action: 'getachievementsbygroup'}, 
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Contract', ['$resource', function ($resource) {
        return $resource('/api/v1/contracts/:contractId/:action', {
            contractId: '@idcontract',
            yearId: '@idyear',
            periodId: '@idperiod',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {contractId: ''},
                isArray: true
            },
            getContractsByYearAndPeriod: {
                method: 'GET',
                params: {action: 'getcontractsbyyearandperiod'}, 
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Indicator', ['$resource', function ($resource) {
        return $resource('/api/v1/indicators/:indicatorId/:action', {
            indicatorId: '@idindicator',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {indicatorId: ''},
                isArray: true
            },
            getIndicatorsByGroup: {
                method: 'GET',
                params: {action: 'getindicatorsbygroup'},
                isArray: true
            },
            getIndicators: {
                method: 'GET',
                params: {action: 'getindicators'},
                isArray: true
            },
            getIndicatorsPendingByTeacher: {
                method: 'GET',
                params: {action: 'getindicatorspendingbyteacher'},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Monitoringtypeindicator', ['$resource', function ($resource) {
        return $resource('/api/v1/monitoringtypeindicators/:monitoringtypeindicatorId/:action', {
            monitoringtypeindicatorId: '@idmonitoringtypeindicator',
            action: '@action'
        }, {
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Attendance', ['$resource', function ($resource) {
        return $resource('/api/v1/attendances/:attendanceId/:action', {
            attendanceId: '@idattendance',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {attendanceId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Observertype', ['$resource', function ($resource) {
        return $resource('/api/v1/observertypes/:observertypeId/:action', {
            observertypeId: '@idobservertype',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {observertypeId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Observer', ['$resource', function ($resource) {
        return $resource('/api/v1/observers/:observerId/:action', {
            observerId: '@idobserver',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {observerId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            },
            getObservers: {
                method: 'GET',
                params: {action: 'getobservers'},
                isArray: true
            }
        });
    }])
    .factory('Task', ['$resource', function ($resource) {
        return $resource('/api/v1/tasks/:taskId/:action', {
            taskId: '@idtask',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {taskId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            },
            getTasks: {
                method: 'GET',
                params: {action: 'gettasks'},
                isArray: true
            },
            setApproved: {
                method: 'GET',
                params: {action: 'setapproved'}
            }
        });
    }])
    .factory('Tasktype', ['$resource', function ($resource) {
        return $resource('/api/v1/tasktypes/:tasktypeId/:action', {
            tasktypeId: '@idtasktype',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {tasktypeId: ''},
                isArray: true
            }
        });
    }])
    .factory('Partial', ['$resource', function ($resource) {
        return $resource('/api/v1/partialratings/:partialId/:action', {
            partialId: '@idpartial',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {partailId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Descriptivereport', ['$resource', function ($resource) {
        return $resource('/api/v1/descriptivereports/:descriptivereportId/:action', {
            descriptivereportId: '@iddescriptivereport',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {descriptivereportId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Quantitativerecovery', ['$resource', function ($resource) {
        return $resource('/api/v1/quantitativerecoveries/:quantitativerecoveryId/:action', {
            quantitativerecoveryId: '@idquantitativerecovery',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {quantitativerecoveryId: ''},
                isArray: true
            },
            getRecoveryByUser: {
                method: 'GET',
                params: {action: 'getrecoverybyuser'}
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Permission', ['$resource', function ($resource) {
        return $resource('/api/v1/permissions/:quantitativerecoveryId/:action', {
            permissionId: '@idpermission',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {permissionId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Statistics', ['$resource', function ($resource) {
        return $resource('/api/v1/statistics/:action/:token', {action: '@action'}, {
            getGlobalPerformances: {
                method: 'GET',
                params: {action: 'globalperformances'},
                isArray: true
            },
            getGlobalPerformancesByGroup: {
                method: 'GET',
                params: {action: 'globalperformancebygroup'},
                isArray: true
            },
            getGlobalPerformancesBySubject: {
                method: 'GET',
                params: {action: 'globalperformancebysubject'},
                isArray: true
            },
            getGlobalPerformancesByArea: {
                method: 'GET',
                params: {action: 'globalperformancebyarea'},
                isArray: true
            }
        });
    }]).factory('Vote', ['$resource', function ($resource) {
        return $resource('/api/v1/vote/:voteId/:action/', {
            voteId: '@idvote',
            action: '@action'
        },{
            all: {
                method: 'GET',
                params: {voteId: ''},
                isArray: true
            }
            ,
        });
    }]);;