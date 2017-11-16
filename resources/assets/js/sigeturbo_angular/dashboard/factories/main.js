'use strict';

/* Dashboard Factories */
angular.module('Dashboard.factories', [])
    .factory('User', ['$resource', function ($resource) {
        return $resource('/api/v1/users/:userId/:action', {userId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {userId: ''},
                isArray: true
            },
            getLatestCode: {
                method: 'GET',
                params: {action: 'getlatestcode'}
            }
        });
    }])
    .factory('Attendance', ['$resource', function ($resource) {
        return $resource('/api/v1/attendances/:attendanceId/:action', {attendanceId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {attendanceId: ''},
                isArray: true
            },
            getAttendancesAmountByDate: {
                method: 'GET',
                params: {action: 'getattendancesamountbydate'},
                isArray: true
            }
        });
    }])
    .factory('Enrollment', ['$resource', function ($resource) {
        return $resource('/api/v1/enrollments/:enrollmentId/:action', {
            enrollmentId: '@idenrollment',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {enrollmentId: ''},
                isArray: true
            },
            getEnrollmentsByStudent: {
                method: 'GET',
                params: {action: 'getenrollmentsbystudent'},
                isArray: true
            },
            getEnrollmentsLatestByStudentWithCost: {
                method: 'GET',
                params: {action: 'getenrollmentslatestbystudentwithcost'}
            },
            getEnrollmentsByStatus: {
                method: 'GET',
                params: {action: 'getenrollmentsbystatus'}
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Consenttype', ['$resource', function ($resource) {
        return $resource('/api/v1/consenttypes/:consenttypeId/:action', {consenttypeId: '@id', action: '@action'}, {
            all: { 
                method: 'GET',
                params: {consenttypeId: ''},
                isArray: true
            }
        });
    }]);