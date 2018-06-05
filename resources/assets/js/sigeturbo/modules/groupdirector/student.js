/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../bootstrap');

import Vue from 'vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Student from '../../views/groupdirector/Student';
import Userfamily from '../../views/userfamily/Userfamily';
import PaymentPendingStudent from '../../views/payments/Pending/Student';
import AttendanceScalar from '../../views/attendance/AttendanceScalar';
import ObservatorScalar from '../../views/observator/ObservatorScalar';
import PerformanceByStudent from '../../views/chart/PerformanceByStudent';

new Vue({
    el: '#groupdirector-student',
    components: {
        'sigeturbo-view-groupdirector-student': Student,
        'sigeturbo-view-groupdirector-members': Userfamily,
        'sigeturbo-view-groupdirector-attendance': AttendanceScalar,
        'sigeturbo-view-groupdirector-observator': ObservatorScalar,
        'sigeturbo-view-groupdirector-performance': PerformanceByStudent,
        'sigeturbo-view-payments-pending': PaymentPendingStudent,

    }
});
