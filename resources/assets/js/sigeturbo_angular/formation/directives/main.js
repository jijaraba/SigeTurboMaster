/* eslint-disable no-console,no-undef,no-unused-vars */
'use strict';

/* Formation Directives */
angular.module('Formation.directives', [])
    .directive('appVersion', ['version', function (version) {
        return function (scope, elm) {
            elm.text(version);
        };
    }])
    .directive('sigeTurboFormation', ['$log', '$filter', function ($log, $filter) {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.monitoringtype = {
                    date: $filter('date')(new Date(), 'yyyy-MM-dd')
                };
            }]
        };
    }])
    .directive('sigeTurboAcademicBasic', ['$log', 'Year', 'Group', function ($log, Year, Group) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFormation',
            template: require('./views/partials/academic/academic_basic.html'),
            controller: ['$scope', function ($scope) {
                $scope.academic = {
                    year: '2015',
                    group: '1'
                };
                // Get years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Current Year
                        Year.getCurrentYear().$promise.then(
                            function (year) {
                                $scope.academic.year = year.idyear;
                                // Get periods
                                $scope.academic.group = 'Loading ...';
                                Group.getGroupsForObservator({
                                    year: year.idyear
                                }).$promise.then(
                                    function (groups) {
                                        $scope.groups = groups;
                                    },
                                    function (error) {
                                        $log.error(error);
                                    }
                                );
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            link: function (scope, elem, attr) {
                //Find Years
                scope.$watch('academic.year', function (newYear, oldYear) {
                    if (newYear !== oldYear) {
                        scope.groups = [];
                        scope.academic.group = '';
                        if (newYear != null) {
                            scope.academic.group = 'Loading ...';
                            Group.getGroupsForObservator({
                                year: newYear
                            }).$promise.then(
                                function (groups) {
                                    scope.groups = groups;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.groups = [];
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAcademicBasicPeriod', ['$log', 'Year', 'Period', 'Academic', function ($log, Year, Period, Academic) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFormation',
            template: require('./views/partials/academic/academic_basic_period.html'),
            controller: ['$scope', function ($scope) {
                $scope.academic = {
                    year: '2017',
                    period: '1'
                };

                $scope.buttonSearchEnable = false;
                // Get years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Current Year
                        Year.getCurrentYear().$promise.then(
                            function (year) {
                                $scope.academic.year = year.idyear;
                                // Get periods
                                $scope.academic.idperiod = 'Loading ...';
                                Academic.getPeriodsByYear({yearId: year.idyear}).$promise.then(
                                    function (periods) {
                                        $scope.periods = periods;
                                        //Get Current Period
                                        Period.getCurrentPeriod().$promise.then(
                                            function (period) {
                                                $scope.academic.idperiod = period.idperiod;

                                            },
                                            function (error) {
                                                $log.error(error);
                                            }
                                        );
                                    },
                                    function (error) {
                                        $log.error(error);
                                    }
                                );
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            link: function (scope) {

                //Find Years
                scope.$watch('academic.year', function (newYear, oldYear) {
                    if (newYear !== oldYear) {
                        scope.periods = [];
                        scope.academic.period = '';
                        if (newYear != null) {
                            // Get Periods
                            scope.academic.period = 'Loading ...';
                            Period.getPeriodsByYear({
                                year: newYear
                            }).$promise.then(
                                function (periods) {
                                    scope.periods = periods;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.periods = [];
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAcademicBasicArea', ['$log', 'Year', 'Area', function ($log, Year, Area) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFormation',
            template: require('./views/partials/academic/academic_basic_generic.html'),
            controller: ['$scope', function ($scope) {
                $scope.academic = {
                    year: '2015',
                    area: '1'
                };

                //alert("Entre");
                // Get years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Current Year
                        Year.getCurrentYear().$promise.then(
                            function (year) {
                                $scope.academic.year = year.idyear;
                                // Get Areas
                                $scope.academic.area = 'Loading ...';
                                //Get Areas
                                Area.getAreasByYear({
                                    year: year.idyear
                                }).$promise.then(
                                    function (areas) {
                                        $scope.areas = areas;
                                    },
                                    function (error) {
                                        $log.error(error);
                                    }
                                );
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            link: function (scope, elem, attr) {
                //Find Years
                scope.$watch('academic.year', function (newYear, oldYear) {
                    if (newYear !== oldYear) {
                        scope.areas = [];
                        scope.academic.area = '';
                        if (newYear != null) {
                            // Get Areas
                            scope.academic.area = 'Loading ...';
                            //Get Areas
                            Area.getAreasByYear({
                                year: newYear
                            }).$promise.then(
                                function (areas) {
                                    scope.areas = areas;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.areas = [];
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAcademicBasicSubject', ['$log', 'Year', 'Subject', function ($log, Year, Subject) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFormation',
            template: require('./views/partials/academic/academic_basic_subject.html'),
            controller: ['$scope', function ($scope) {
                $scope.academic = {
                    year: '2017',
                    subject: '1'
                };

                //alert("Entre");
                // Get years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Current Year
                        Year.getCurrentYear().$promise.then(
                            function (year) {
                                $scope.academic.year = year.idyear;
                                // Get Subjects
                                $scope.academic.subject = 'Loading ...';
                                //Get Subjects
                                Subject.getSubjectsByYear({
                                    year: year.idyear
                                }).$promise.then(
                                    function (subjects) {
                                        $scope.subjects = subjects;
                                    },
                                    function (error) {
                                        $log.error(error);
                                    }
                                );
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            link: function (scope) {
                //Find Years
                scope.$watch('academic.year', function (newYear, oldYear) {
                    if (newYear !== oldYear) {
                        scope.subjects = [];
                        scope.academic.area = '';
                        if (newYear != null) {
                            // Get Subjects
                            scope.academic.subject = 'Loading ...';
                            //Get Subjects
                            Subject.getSubjectsByYear({
                                year: newYear
                            }).$promise.then(
                                function (subjects) {
                                    scope.subjects = subjects;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.subjects = [];
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAcademic', ['$log', 'Year', 'Period', 'Group', 'Subject', 'Nivel', 'Monitoringcategorybyyear', function ($log, Year, Period, Group, Subject, Nivel, Monitoringcategorybyyear) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFormation',
            template: require('./views/partials/academic/academic.html'),
            controller: ['$scope', function ($scope) {
                $scope.academic = {};
                $scope.buttonSearchEnable = false;
                // Get years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Current Year
                        Year.getCurrentYear().$promise.then(
                            function (year) {
                                $scope.academic.year = year.idyear;
                                // Get periods
                                $scope.academic.period = 'Loading ...';
                                Period.getPeriodsByYear({year: year.idyear}).$promise.then(
                                    function (periods) {
                                        $scope.periods = periods;
                                        //Get Current Period
                                        Period.getCurrentPeriod().$promise.then(
                                            function (period) {
                                                $scope.academic.period = period.idperiod;
                                                // Get groups
                                                $scope.academic.group = 'Loading ...';
                                                Group.getGroupsByYearAndPeriod({
                                                    year: year.idyear,
                                                    period: period.idperiod
                                                }).$promise.then(
                                                    function (groups) {
                                                        $scope.groups = groups;
                                                        $scope.subjectEnable = false;
                                                    },
                                                    function (error) {
                                                        $log.error(error);
                                                    }
                                                );
                                            },
                                            function (error) {
                                                $log.error(error);
                                            }
                                        );
                                    },
                                    function (error) {
                                        $log.error(error);
                                    }
                                );
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            link: function (scope) {
                scope.buttonSearchEnable = true;
                //Find Years
                scope.$watch('academic.year', function (newYear, oldYear) {
                    if (newYear !== oldYear) {
                        scope.periods = [];
                        scope.academic.period = '';
                        scope.groups = [];
                        scope.academic.group = '';
                        scope.subjects = [];
                        scope.academic.subject = '';
                        scope.nivels = [];
                        scope.academic.nivel;
                        if (newYear != null) {
                            scope.academic.period = 'Loading ...';
                            Period.getPeriodsByYear({
                                year: scope.academic.year
                            }).$promise.then(
                                function (periods) {
                                    scope.periods = periods;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.periods = [];
                            scope.groups = [];
                            scope.subjects = [];
                            scope.nivels = [];
                        }
                    }
                });
                //Find Periods
                scope.$watch('academic.period', function (newPeriod, oldPeriod) {
                    if (newPeriod !== oldPeriod) {
                        scope.groups = [];
                        scope.academic.group = '';
                        scope.subjects = [];
                        scope.academic.subject = '';
                        scope.nivels = [];
                        scope.academic.nivel;
                        if (newPeriod != null && newPeriod != '' && newPeriod != 'Loading ...' && newPeriod != undefined) {
                            scope.academic.group = 'Loading ...';
                            Group.getGroupsByYearAndPeriod({
                                year: scope.academic.year,
                                period: scope.academic.period
                            }).$promise.then(
                                function (groups) {
                                    scope.groups = groups;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.groups = [];
                            scope.subjects = [];
                            scope.nivels = [];
                        }
                    }
                });
                //Find Groups
                scope.$watch('academic.group', function (newGroup, oldGroup) {
                    if (newGroup !== oldGroup) {
                        scope.subjects = [];
                        scope.academic.subject = '';
                        scope.nivels = [];
                        scope.academic.nivel;
                        if (newGroup != null && newGroup != '' && newGroup != 'Loading ...' && newGroup != undefined) {
                            scope.academic.subject = 'Loading ...';
                            Subject.getSubjectsByYearAndPeriodAndGroup({
                                year: scope.academic.year,
                                period: scope.academic.period,
                                group: scope.academic.group
                            }).$promise.then(
                                function (subjects) {
                                    scope.subjects = subjects;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.subjects = [];
                            scope.nivels = [];
                        }
                    }
                });
                //Find Subjects
                scope.$watch('academic.subject', function (newSubject, oldSubject) {
                    if (newSubject !== oldSubject) {
                        if (newSubject != null && newSubject !== '' && newSubject != 'Loading ...' && newSubject != undefined) {
                            scope.academic.nivel = 'Loading ...';
                            Nivel.getNivelsByYearAndPeriodAndGroupAndSubject({
                                year: scope.academic.year,
                                period: scope.academic.period,
                                group: scope.academic.group,
                                subject: scope.academic.subject
                            }).$promise.then(
                                function (nivels) {
                                    scope.nivels = nivels;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.nivels = [];
                        }
                    }
                });
                //Find Nivels
                scope.$watch('academic.nivel', function (newNivel, oldNivel) {
                    if (newNivel !== oldNivel) {
                        if (newNivel !== 0 && newNivel != null && newNivel !== '' && newNivel != 'Loading ...' && newNivel != undefined) {
                            scope.buttonSearchEnable = false;
                        }
                    }
                });

                scope.$watch('showMonitoringTypes', function (newValue, oldValue) {
                    if (newValue !== oldValue) {
                        Monitoringcategorybyyear.getMonitoringCategoriesByYearAndSubject({
                            yearId: scope.academic.year,
                            subjectId: scope.academic.subject
                        }).$promise.then(
                            function (monitoringcategories) {
                                scope.monitoringcategories = monitoringcategories;
                                scope.monitoringtype.monitoringcategory = 1;
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAcademicToAssign', ['$log', 'Year', 'Period', 'Group', 'Subject', 'Nivel', 'User', 'Academic', 'Contract', '$filter', function ($log, Year, Period, Group, Subject, Nivel, User, Academic, Contract, $filter) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFormation',
            template: require('./views/partials/academic/academic_toassign.html'),
            controller: ['$scope', function ($scope) {
                $scope.academic = {};
                $scope.buttonSearchEnable = false;
                // Get years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Current Year
                        Year.getCurrentYear().$promise.then(
                            function (year) {
                                $scope.academic.idyear = year.idyear;
                                // Get periods
                                $scope.academic.idperiod = 'Loading ...';
                                Academic.getPeriodsByYear({yearId: year.idyear}).$promise.then(
                                    function (periods) {
                                        $scope.periods = periods;
                                        //Get Current Period
                                        Period.getCurrentPeriod().$promise.then(
                                            function (period) {
                                                $scope.academic.idperiod = period.idperiod;
                                                // Get groups
                                                $scope.academic.idgroup = 'Loading ...';
                                                Group.getGroupsByYearAndPeriod({
                                                    year: year.idyear,
                                                    period: period.idperiod
                                                }).$promise.then(
                                                    function (groups) {
                                                        $scope.groups = groups;
                                                        $scope.subjectEnable = false;
                                                        $scope.academic.idsubject = 'Loading ...';
                                                        Subject.all('').$promise.then(
                                                            function (subjects) {
                                                                $scope.subjects = subjects;
                                                                $scope.subjectsoriginal = subjects;
                                                                Nivel.all('').$promise.then(
                                                                    function (nivels) {
                                                                        $scope.nivels = nivels;
                                                                        $scope.nivelsoriginal = nivels;
                                                                        User.getPersonalAcademic({}).$promise.then(
                                                                            function (users) {
                                                                                $scope.users = users;
                                                                            },
                                                                            function (error) {
                                                                                $log.error(error);
                                                                            }
                                                                        );
                                                                    },
                                                                    function (error) {
                                                                        $log.error(error);
                                                                    }
                                                                );
                                                            },
                                                            function (error) {
                                                                $log.error(error);
                                                            }
                                                        );
                                                    },
                                                    function (error) {
                                                        $log.error(error);
                                                    }
                                                );
                                            },
                                            function (error) {
                                                $log.error(error);
                                            }
                                        );
                                    },
                                    function (error) {
                                        $log.error(error);
                                    }
                                );
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            link: function (scope) {

                //Insert Achievement
                scope.save = function () {
                    var scopechild = angular.element(document.getElementById('academicsearch')).scope().$$childTail.$parent;
                    if (scope.academic['idcontract']) {
                        Contract.update(scope.academic).$promise.then(
                            function (result) {
                                angular.forEach(scopechild.contractoriginals, function (registroindivi) {
                                    if (registroindivi.idcontract == result.idcontract) {
                                        registroindivi.idyear = scope.academic.idyear;
                                        registroindivi.idgroup = scope.academic.idgroup;
                                        registroindivi.idperiod = scope.academic.idperiod;
                                        registroindivi.idsubject = scope.academic.idsubject;
                                        registroindivi.idnivel = scope.academic.idnivel;
                                        registroindivi.iduser = scope.academic.iduser;
                                        registroindivi.timeintensity = scope.academic.timeintensity;
                                    }
                                });
                                scopechild.contracts = scopechild.contractsname($filter('getByPropiertyAndArray')(scopechild.nonulos(scope.academic), angular.copy(scopechild.contractoriginals)));
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    } else {
                        scope.after = scope.academic;

                        Contract.save(scope.academic).$promise.then(
                            function (result) {
                                scope.after = {
                                    'idcontract': result.last_insert_id,
                                    'idyear': scope.after.idyear,
                                    'idgroup': scope.academic.idgroup,
                                    'idperiod': scope.academic.idperiod,
                                    'idsubject': scope.academic.idsubject,
                                    'idnivel': scope.academic.idnivel,
                                    'iduser': scope.academic.iduser,
                                    'timeintensity': scope.academic.timeintensity
                                };
                                scopechild.contractoriginals.push(scope.after);
                                scopechild.contracts = scopechild.contractsname($filter('getByPropiertyAndArray')(scopechild.nonulos(scope.academic), angular.copy(scopechild.contractoriginals)));

                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    }
                };

                //Find Years
                scope.$watch('academic.idyear', function (newYear, oldYear) {
                    if (newYear !== oldYear) {
                        scope.periods = [];
                        scope.academic.idperiod = '';
                        scope.groups = [];
                        scope.academic.idgroup = '';
                        scope.subjects = [];
                        scope.academic.idsubject = '';
                        scope.nivels = [];
                        scope.academic.idnivel;
                        if (newYear != null) {
                            scope.academic.idperiod = 'Loading ...';
                            Academic.getPeriodsByYear({
                                yearId: scope.academic.idyear
                            }).$promise.then(
                                function (periods) {
                                    scope.periods = periods;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.periods = [];
                            scope.groups = [];
                            scope.subjects = [];
                            scope.nivels = [];
                        }
                    }
                });
                //Find Periods
                scope.$watch('academic.idperiod', function (newPeriod, oldPeriod) {
                    if (newPeriod !== oldPeriod) {
                        scope.groups = [];
                        scope.academic.idgroup = '';
                        scope.subjects = [];
                        scope.academic.idsubject = '';
                        scope.nivels = [];
                        scope.academic.idnivel;
                        if (newPeriod != null && newPeriod != '' && newPeriod != 'Loading ...' && newPeriod != undefined) {
                            scope.academic.idgroup = 'Loading ...';
                            Group.getGroupsByYearAndPeriod({
                                year: scope.academic.idyear,
                                period: scope.academic.idperiod
                            }).$promise.then(
                                function (groups) {
                                    scope.groups = groups;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.groups = [];
                            scope.subjects = [];
                            scope.nivels = [];
                        }
                    }
                });
                //Find Subjects
                scope.$watch('academic.idsubject', function (newSubject, oldSubject) {
                    if (newSubject !== oldSubject) {
                        if (newSubject != null && newSubject !== '' && newSubject != 'Loading ...' && newSubject != undefined) {
                            scope.academic.idnivel = 'Loading ...';
                            scope.nivels = $filter('orderBy')($filter('getByPropiertyAndArray')({'idsubject': scope.academic.idsubject}, angular.copy(scope.nivelsoriginal)), '-name', true);
                        } else {
                            scope.nivels = [];
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAcademicEmbedded', ['$log', 'Year', 'Period', 'Group', 'Subject', 'Nivel', function ($log, Year, Period, Group, Subject, Nivel) {
        return {
            restrict: 'AE',
            template: require('./views/partials/academic/academic_embedded.html'),
            scope: {
                year: '@',
                period: '@',
                group: '@',
                subject: '@',
                nivel: '@',
                academic: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.academic = {};
                $scope.buttonSearchEnable = false;
                // Get years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Current Year
                        Year.getCurrentYear().$promise.then(
                            function (year) {
                                if ($scope.year !== undefined) {
                                    $scope.academic.year = parseInt($scope.year);
                                } else {
                                    $scope.academic.year = year.idyear;
                                }
                                // Get periods
                                $scope.academic.period = 'Loading ...';
                                Period.getPeriodsByYear({year: year.idyear}).$promise.then(
                                    function (periods) {
                                        $scope.periods = periods;
                                        //Get Current Period
                                        Period.getCurrentPeriod().$promise.then(
                                            function (period) {
                                                if ($scope.period !== undefined) {
                                                    $scope.academic.period = parseInt($scope.period);
                                                } else {
                                                    $scope.academic.period = period.idperiod;
                                                }
                                                // Get groups
                                                Group.getGroupsByYearAndPeriod({
                                                    year: year.idyear,
                                                    period: period.idperiod
                                                }).$promise.then(
                                                    function (groups) {
                                                        $scope.groups = groups;
                                                        $scope.subjectEnable = 1;
                                                        if ($scope.group !== undefined) {
                                                            $scope.academic.group = parseInt($scope.group);
                                                            $scope.subjectEnable = 0;
                                                        }
                                                    },
                                                    function (error) {
                                                        $log.error(error);
                                                    }
                                                );
                                            },
                                            function (error) {
                                                $log.error(error);
                                            }
                                        );
                                    },
                                    function (error) {
                                        $log.error(error);
                                    }
                                );
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

            }],
            link: function (scope) {
                scope.buttonSearchEnable = true;
                //Find Years
                scope.$watch('academic.year', function (newYear, oldYear) {
                    if (newYear !== oldYear) {
                        scope.periods = [];
                        scope.academic.period = '';
                        scope.groups = [];
                        scope.academic.group = '';
                        scope.subjects = [];
                        scope.academic.subject = '';
                        scope.nivels = [];
                        scope.academic.nivel;
                        if (newYear != null) {
                            scope.academic.period = 'Loading ...';
                            Period.getPeriodsByYear({
                                year: scope.academic.year
                            }).$promise.then(
                                function (periods) {
                                    scope.periods = periods;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.periods = [];
                            scope.groups = [];
                            scope.subjects = [];
                            scope.nivels = [];
                        }
                    }
                });
                //Find Periods
                scope.$watch('academic.period', function (newPeriod, oldPeriod) {
                    if (newPeriod !== oldPeriod) {
                        scope.groups = [];
                        scope.academic.group = '';
                        scope.subjects = [];
                        scope.academic.subject = '';
                        scope.nivels = [];
                        scope.academic.nivel;
                        if (newPeriod != null && newPeriod != '' && newPeriod != 'Loading ...' && newPeriod != undefined) {
                            scope.academic.group = 'Loading ...';
                            Group.getGroupsByYearAndPeriod({
                                year: scope.academic.year,
                                period: scope.academic.period
                            }).$promise.then(
                                function (groups) {
                                    scope.groups = groups;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.groups = [];
                            scope.subjects = [];
                            scope.nivels = [];
                        }
                    }
                });
                scope.$watch('academic.group', function (newGroup, oldGroup) {
                    if (newGroup !== oldGroup && newGroup !== undefined) {
                        scope.subjects = [];
                        scope.academic.subject = '';
                        scope.nivels = [];
                        scope.academic.nivel = '';
                        if (newGroup != null && newGroup != '' && newGroup != 'Loading ...' && newGroup != undefined) {
                            Subject.getSubjectsByYearAndPeriodAndGroup({
                                year: scope.academic.year,
                                period: scope.academic.period,
                                group: scope.academic.group
                            }).$promise.then(
                                function (subjects) {
                                    scope.subjectEnable = 0;
                                    scope.subjects = subjects;
                                    if (scope.subject !== undefined) {
                                        scope.academic.subject = parseInt(scope.subject);
                                    }
                                    //Find Nivels
                                    if (scope.year !== undefined && scope.period !== undefined && scope.group !== undefined && scope.subject !== undefined) {
                                        Nivel.getNivelsByYearAndPeriodAndGroupAndSubject({
                                            year: scope.year,
                                            period: scope.period,
                                            group: scope.group,
                                            subject: scope.subject
                                        }).$promise.then(
                                            function (nivels) {
                                                scope.nivels = nivels;
                                                if (scope.nivel !== undefined) {
                                                    scope.academic.nivel = parseInt(scope.nivel);
                                                }
                                            },
                                            function (error) {
                                                $log.error(error);
                                            }
                                        );
                                    }

                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.subjects = [];
                            scope.nivels = [];
                        }
                    }
                });

                scope.$watch('academic.subject', function (newSubject, oldSubject) {
                    if (newSubject !== oldSubject && newSubject !== undefined) {
                        if (newSubject != null && newSubject !== '') {
                            Nivel.getNivelsByYearAndPeriodAndGroupAndSubject({
                                year: scope.academic.year,
                                period: scope.academic.period,
                                group: scope.academic.group,
                                subject: scope.academic.subject
                            }).$promise.then(
                                function (nivels) {
                                    scope.nivels = nivels;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            scope.nivels = [];
                        }
                    }
                });

                scope.$watch('academic.nivel', function (newNivel, oldNivel) {
                    if (newNivel !== oldNivel) {
                        if (newNivel !== 0) {
                            scope.buttonSearchEnable = false;
                        }
                    }
                });

                scope.$watch('showMonitoringTypes', function (newValue, oldValue) {
                    if (newValue !== oldValue) {
                        Monitoringcategorybyyear.getMonitoringCategoriesByYearAndSubject({
                            yearId: scope.academic.year,
                            subjectId: scope.academic.subject
                        }).$promise.then(
                            function (monitoringcategories) {
                                scope.monitoringcategories = monitoringcategories;
                                //Seleccionar Categoría por Defecto
                                scope.monitoringtype.monitoringcategory = 1;
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    }
                });
            }
        };
    }])
    .directive('sigeTurboIndicatorInsert', ['$log', 'Achievement', 'Indicator', 'SweetAlert', function ($log, Achievement, Indicator, SweetAlert) {
        return {
            restrict: 'AE',
            template: require('./views/partials/indicators/insert.html'),
            controller: ['$scope', function ($scope) {
                $scope.achievement = {};
                $scope.indicator = {};
                //Insert Achievement
                $scope.insertAchievement = function () {
                    Achievement.save({
                        year: $scope.academic.year,
                        period: $scope.academic.period,
                        group: $scope.academic.group,
                        subject: $scope.academic.subject,
                        nivel: $scope.academic.nivel,
                        achievement: $scope.achievement.achievement
                    }).$promise.then(
                        function (achievement) {
                            $scope.searching();
                            SweetAlert.success('Excelente', achievement.message);
                        },
                        function (error) {
                            $log.error(error);
                            SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                        }
                    );
                };
                //Insert Indicators
                $scope.insertIndicator = function () {
                    //Ingresar Logro
                    Indicator.save({
                        year: $scope.academic.year,
                        period: $scope.academic.period,
                        group: $scope.academic.group,
                        subject: $scope.academic.subject,
                        nivel: $scope.academic.nivel,
                        achievement: $scope.indicator.achievement,
                        consecutive: $scope.indicator.consecutive,
                        indicatorcategory: $scope.indicator.idindicatorcategory,
                        type01: $scope.indicator.type01,
                        fortitude: $scope.indicator.fortitude,
                        type02: $scope.indicator.type02,
                        recommendation: $scope.indicator.recommendation
                    }).$promise.then(
                        function (indicator) {
                            $log.info(indicator);
                            //Borrar Campos
                            $scope.indicator.fortitude = '';
                            $scope.indicator.recommendation = '';
                            //Actualizar búsqueda de indicadores
                            $scope.searching();
                            SweetAlert.success('Excelente', indicator.message);
                        },
                        function (error) {
                            $log.error(error);
                            SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                        }
                    );
                };

            }],
            link: function () {
            }
        };
    }])
    .directive('sigeTurboIndicatorList', ['$log', 'Achievement', 'SweetAlert', 'ngDialog', '$filter', 'Indicator', function ($log, Achievement, SweetAlert, ngDialog, $filter, Indicator) {
        return {
            restrict: 'AE',
            template: require('./views/partials/indicators/lists.html'),
            controller: ['$scope', function ($scope) {
                // !Important Searching
                $scope.showAchievementList = false;
                $scope.showAchievementContainerOptions = false;
                //!Important Searching
                $scope.searching = function () {
                    //Show Option Container
                    $scope.showAchievementContainerOptions = true;
                    //Get Achievements
                    Achievement.getAchievementsByGroup({
                        year: $scope.academic.year,
                        period: $scope.academic.period,
                        group: $scope.academic.group,
                        subject: $scope.academic.subject,
                        nivel: $scope.academic.nivel
                    }).$promise.then(
                        function (achievements) {
                            $scope.achievements = achievements;
                            $scope.achievementShow = 'show';
                            if ($scope.achievements.length > 0) {
                                $scope.indicator.achievement = $scope.achievements[0].idachievement;
                            }
                            $scope.showAchievementList = ($scope.achievements.length > 0) ? true : false;
                            if ($scope.achievements.length > 0) {
                                $scope.achievementShow = 'hide';
                                $scope.indicator.consecutive = (($scope.achievements[0].indicators.length) / 2) + 1;
                            } else {
                                $scope.indicator.consecutive = 1;
                            }
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };
                //!Important: Show Form
                $scope.showIndicators = false;
                $scope.showForm = function () {
                    $scope.showIndicators = !$scope.showIndicators;
                };
                //Delete Achievement
                $scope.deleteAchievement = function (achievement) {
                    if (confirm('¿Desea borrar el Logro?')) {
                        Achievement.delete({
                            achievementId: achievement.idachievement,
                            year: $scope.academic.year,
                            period: $scope.academic.period,
                            group: $scope.academic.group,
                            subject: $scope.academic.subject,
                            nivel: $scope.academic.nivel
                        }).$promise.then(
                            function (value) {
                                $log.info(value.message);
                                $scope.searching();
                                SweetAlert.success('Excelente', value.message);
                            },
                            function (error) {
                                $log.error(error.message);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    }
                };

                $scope.editindicators = function () {
                    //alert("Este es el arreglo de la Fortaleza :"+JSON.stringify($scope.indicator)+"\n este es la recomendación : "+JSON.stringify($scope.recomendacion));
                    //Actualizar Logro
                    Indicator.update({
                        year: $scope.academic.year,
                        period: $scope.academic.period,
                        group: $scope.academic.group,
                        subject: $scope.academic.subject,
                        nivel: $scope.academic.nivel,
                        idindicator: $scope.indicator.idindicator,
                        achievement: $scope.indicator.idachievement,
                        consecutive: $scope.indicator.consecutive,
                        idindicatorrecomendation: $scope.recomendacion.idindicator,
                        indicatorcategory: $scope.indicator.idindicatorcategory,
                        type01: $scope.indicator.idindicatortype,
                        fortitude: $scope.indicator.indicator,
                        type02: $scope.recomendacion.idindicatortype,
                        recommendation: $scope.recomendacion.indicator
                    }).$promise.then(
                        function (indicator) {
                            $log.info(indicator);
                            //Borrar Campos
                            $scope.indicator.fortitude = '';
                            $scope.indicator.recommendation = '';
                            //Actualizar búsqueda de indicadores
                            $scope.searching();
                            ngDialog.close();
                            SweetAlert.success('Excelente', indicator.message);
                        },
                        function (error) {
                            $log.error(error);
                            SweetAlert.error('Error', 'Se ha presentado un error al Modificar la información');
                        }
                    );
                };


                $scope.indicatortypes = [{'idindicatortype': 1, 'name': 'Fortaleza'}, {
                    'idindicatortype': 2,
                    'name': 'Recomendación'
                }];
                $scope.indicatorcategories = [{'idindicatorcategory': 1, 'name': 'General'}, {
                    'idindicatorcategory': 2,
                    'name': 'Flexibilización'
                }, {'idindicatorcategory': 3, 'name': 'Profundización'}];
                //Functions
                $scope.dialogsforms = function ($object) {
                    //alert("Todos los Indicadores : " + JSON.stringify($scope.achievements[0].indicators)+" \n EL Objeto Actual"+ JSON.stringify($object));
                    $scope.consecutiveactual = $object.consecutive;
                    $scope.indicator = ($object.idindicatortype == 1 ) ? angular.copy($object) : $filter('getByPropertyAnd')({
                        'consecutive': $object.consecutive,
                        'idindicatortype': 1
                    }, angular.copy($scope.achievements[0].indicators)); //Independización del Array para que no se dañe el orginal si no hay POST| Actaulizacion o Modificación
                    $scope.recomendacion = ($object.idindicatortype == 2 ) ? angular.copy($object) : $filter('getByPropertyAnd')({
                        'consecutive': $object.consecutive,
                        'idindicatortype': 2
                    }, angular.copy($scope.achievements[0].indicators));
                    ngDialog.open({
                        template: require('./views/partials/indicators/edit.html'),
                        plain: true,
                        scope: $scope,
                        controller: ['$scope', function ($scope) {
                            $scope.$watch('indicator.consecutive', function (newConsecutive, oldConsecutive) {
                                if (newConsecutive !== oldConsecutive) {
                                    if ((newConsecutive != 0) && ($filter('getByPropertyAnd')({'consecutive': newConsecutive}, angular.copy($scope.achievements[0].indicators)) === null || $scope.consecutiveactual == $scope.indicator.consecutive )) {
                                        $scope.validateconsecutivo = false;
                                    } else {
                                        $scope.validateconsecutivo = true;
                                    }
                                }
                            });
                        }]
                    });
                };

                //Update Achievement
                $scope.updateAchievement = function (achievement) {
                    Achievement.update({
                        idachievement: achievement.idachievement,
                        year: $scope.academic.year,
                        period: $scope.academic.period,
                        group: $scope.academic.group,
                        subject: $scope.academic.subject,
                        nivel: $scope.academic.nivel,
                        achievement: achievement.achievement
                    }).$promise.then(
                        function (value) {
                            $log.info(value.message);
                            SweetAlert.success('Excelente', value.message);
                        },
                        function (error) {
                            $log.error(error.message);
                            SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                        }
                    );
                };

            }],
            link: function () {
            }
        };
    }])
    .directive('sigeTurboMonitoringTypesInsert', ['$log', 'Monitoringtype', 'SweetAlert', function ($log, Monitoringtype, SweetAlert) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFormation',
            template: require('./views/partials/monitoringtype/insert.html'),
            controller: ['$scope', function ($scope) {
                $scope.insertMonitoringtype = function () {
                    //Ocultar Grilla
                    $scope.showGrid = false;
                    //Ingresar Tipo de Seguimiento
                    Monitoringtype.save({
                        year: $scope.academic.year,
                        period: $scope.academic.period,
                        group: $scope.academic.group,
                        subject: $scope.academic.subject,
                        nivel: $scope.academic.nivel,
                        monitoringcategory: $scope.monitoringtype.monitoringcategory,
                        date: $scope.monitoringtype.date,
                        name: $scope.monitoringtype.name,
                        description: ($scope.monitoringtype.description) ? $scope.monitoringtype.description : null,
                        indicators: $scope.monitoringtype.indicators
                    }).$promise.then(
                        function (data) {
                            SweetAlert.success('Excelente', data.message);
                            $scope.searching();
                        },
                        function (error) {
                            $log.error(error);
                            SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                        }
                    );
                };
            }],
            link: function (scope, elem, attr, controllerInstance) {
                scope.name = 'Ingresar Seguimiento';
                scope.$watch('name', function (newMessage, oldMessage) {
                    if (newMessage !== oldMessage) {
                        controllerInstance.test(scope);
                    }
                });
            }
        };
    }])
    .directive('sigeTurboMonitoringTypesList', ['$log', 'Monitoringtype', 'Indicator', 'SweetAlert', 'ASSETS_SERVER', function ($log, Monitoringtype, Indicator, SweetAlert, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            template: require('./views/partials/monitoringtype/lists.html'),
            controller: ['$scope', function ($scope) {
                $scope.assets = ASSETS_SERVER;
                //!Important: Searching
                $scope.searching = function () {
                    $scope.showMonitoringTypesList = false;
                    $scope.showMonitoringtypeContainerOptions = false;
                    //Get Monitoringtypes
                    Monitoringtype.getMonitoringtypesByGroupChart({
                        year: $scope.academic.year,
                        period: $scope.academic.period,
                        group: $scope.academic.group,
                        subject: $scope.academic.subject,
                        nivel: $scope.academic.nivel
                    }).$promise.then(
                        function (monitoringtypes) {
                            $scope.monitoringtypes = monitoringtypes;
                            $scope.showMonitoringTypesList = ($scope.monitoringtypes.length > 0) ? true : false;
                            $scope.showMonitoringtypeContainerOptions = true;
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                    //Get Indicators
                    Indicator.getIndicators({
                        year: $scope.academic.year,
                        period: $scope.academic.period,
                        group: $scope.academic.group,
                        subject: $scope.academic.subject,
                        nivel: $scope.academic.nivel
                    }).$promise.then(
                        function (indicators) {
                            $scope.indicators = indicators;
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };

                //!Important: Show Form
                $scope.showMonitoringTypes = false;
                $scope.showForm = function () {
                    $scope.showMonitoringTypes = !$scope.showMonitoringTypes;
                };


                $scope.delete = function (monitoringtype) {
                    if (confirm('¿Desea borrar el tipo de seguimiento?')) {
                        Monitoringtype.delete({
                            monitoringtypeId: monitoringtype.idmonitoringtype,
                            year: $scope.academic.year,
                            period: $scope.academic.period,
                            group: $scope.academic.group,
                            subject: $scope.academic.subject,
                            nivel: $scope.academic.nivel
                        }).$promise.then(
                            function (monitoringtype) {
                                $log.info(monitoringtype.message);
                                $scope.searching();
                                SweetAlert.success('Excelente', monitoringtype.message);
                            },
                            function (error) {
                                $log.error(error.message);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    }
                };
            }],
            link: function () {
            }
        };
    }])
    .directive('sigeTurboMonitoringTypesIndicators', [function () {
        return {
            restrict: 'AE',
            template: require('./views/partials/monitoringtype/indicators.html'),
            scope: {
                monitoringtype: '=',
                indicators: '=',
                monitoringtypeindicator: '=',
            },
            controller: [function () {

            }],
            link: function () {
            }
        };
    }])
    .directive('sigeTurboMonitoringTypesIndicatorSelect', ['$log', 'Monitoringtypeindicator', function ($log, Monitoringtypeindicator) {
        return {
            restrict: 'AE',
            template: require('./views/partials/monitoringtype/select.html'),
            scope: {
                monitoringtype: '=',
                indicator: '=',
                monitoringtypeindicator: '=',
            },
            controller: ['$scope', function ($scope) {
                $scope.monitoringtypeindicatorID = 0;
                $scope.selected = false;
                $scope.indicatorID = $scope.indicator.idindicator;
                angular.forEach($scope.monitoringtypeindicator, function (indicator) {
                    if ($scope.indicator.idindicator === indicator.idindicator) {
                        $scope.monitoringtypeindicatorID = indicator.idmonitoringtypeindicator;
                        $scope.selected = true;
                    }
                });
            }],
            link: function (scope) {
                scope.select = function () {
                    if (scope.selected) {
                        Monitoringtypeindicator.delete({monitoringtypeindicatorId: scope.monitoringtypeindicatorID}).$promise.then(
                            function () {
                                scope.selected = false;
                            },
                            function (error) {
                                $log.error(error);
                                scope.selected = true;
                            }
                        );
                    } else {
                        Monitoringtypeindicator.save({
                            monitoringtype: scope.monitoringtype,
                            indicator: scope.indicatorID,
                        }).$promise.then(
                            function (result) {
                                scope.selected = true;
                                scope.monitoringtypeindicatorID = result.monitoringtypeindicator.idmonitoringtypeindicator;
                            },
                            function (error) {
                                $log.error(error);
                                scope.selected = false;
                                scope.monitoringtypeindicatorID = 0;
                            }
                        );
                    }
                };
            }
        };
    }])
    .directive('sigeTurboStudents', ['$log', 'Enrollment', function ($log, Enrollment) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFormation',
            template: require('./views/partials/monitoring/students.html'),
            controller: ['$scope', function ($scope) {
                //!Important Searching
                $scope.showStudents = false;
                $scope.rating = {
                    global: 0
                };
                $scope.order = {
                    item: 'lastname',
                    reverse: false
                };
                $scope.searching = function () {
                    Enrollment.getEnrollmentsWithData({
                        yearId: $scope.academic.year,
                        periodId: $scope.academic.period,
                        groupId: $scope.academic.group,
                        subjectId: $scope.academic.subject,
                        nivelId: $scope.academic.nivel
                    }).$promise.then(
                        function (users) {
                            $scope.users = users;
                            $scope.showStudents = ($scope.users.length > 0) ? true : false;
                            Enrollment.getEnrollmentsWithGrade({
                                yearId: $scope.academic.year,
                                periodId: $scope.academic.period,
                                groupId: $scope.academic.group,
                                subjectId: $scope.academic.subject,
                                nivelId: $scope.academic.nivel
                            }).$promise.then(
                                function (ratings) {
                                    $scope.ratings = ratings;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };
            }],
            link: function (scope, element) {
                scope.showGrid = false;
                scope.select = function (user) {
                    scope.user = user;
                    element.find('user_' + user.iduser).addClass('active');
                };
            }
        };
    }])
    .directive('sigeTurboMonitoringGrid', ['$log', 'Monitoringcategorybyyear', 'Monitoringtype', 'Monitoring', 'ASSETS_SERVER', function ($log, Monitoringcategorybyyear, Monitoringtype, Monitoring, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFormation',
            template: require('./views/partials/monitoring/gridmonitoring.html'),
            scope: {
                user: '=',
                academic: '='
            },
            controller: ['$scope', function ($scope) {

                $scope.assets = ASSETS_SERVER;
                $scope.monitorings = {};

                $scope.getMonitoringCategories = function () {
                    //Get Monitoringcategories
                    Monitoringcategorybyyear.getMonitoringCategoriesByYearAndSubject({
                        yearId: $scope.academic.year,
                        subjectId: $scope.academic.subject
                    }).$promise.then(
                        function (monitoringcategories) {
                            $scope.monitoringcategories = monitoringcategories;
                            //Determinar Cantidad de Elementos
                            switch (monitoringcategories.length) {
                            case 1:
                                $scope.grid = ['col-100'];
                                break;
                            case 2:
                                $scope.grid = ['col-80', 'col-20'];
                                break;
                            case 3:
                                $scope.grid = ['col-60', 'col-20', 'col-20'];
                                break;
                            case 4:
                                $scope.grid = ['col-40', 'col-20', 'col-20', 'col-20'];
                                break;
                            case 5:
                                $scope.grid = ['col-20', 'col-20', 'col-20', 'col-20', 'col-20'];
                                break;
                            default:
                                $scope.grid = [];
                                break;
                            }
                            $scope.showGrid = (monitoringcategories.length > 0) ? true : false;
                            //Get Monitorings
                            Monitoring.getMonitoringsByUser({
                                year: $scope.academic.year,
                                period: $scope.academic.period,
                                group: $scope.academic.group,
                                subject: $scope.academic.subject,
                                nivel: $scope.academic.nivel,
                                user: $scope.user.iduser
                            }).$promise.then(
                                function (monitorings) {
                                    $scope.monitorings = monitorings;
                                    //Get Monitoringtypes
                                    Monitoringtype.getMonitoringtypesByGroup({
                                        year: $scope.academic.year,
                                        period: $scope.academic.period,
                                        group: $scope.academic.group,
                                        subject: $scope.academic.subject,
                                        nivel: $scope.academic.nivel
                                    }).$promise.then(
                                        function (monitoringtypes) {
                                            $scope.monitoringtypes = monitoringtypes;
                                        },
                                        function (error) {
                                            $log.error(error);
                                        }
                                    );
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        },
                        function (error) {
                            console.log(error);
                        }
                    );
                };
            }],
            link: function (scope) {
                scope.user = '';
                scope.$watch('user', function () {
                    scope.getMonitoringCategories();
                });
                scope.close = function () {
                    scope.showGrid = false;
                };
            }
        };
    }])
    .directive('sigeTurboMonitoringType', [function () {
        return {
            restrict: 'AE',
            require: '^sigeTurboMonitoringGrid',
            template: require('./views/partials/monitoring/monitoringtype.html'),
            scope: {
                academic: '=',
                user: '=',
                monitoringcategory: '@',
                monitoringtypes: '=',
                monitorings: '='
            },
            controller: [function () {
            }],
            link: function () {
            }
        };
    }])
    .directive('sigeTurboMonitoring', ['$log', 'Monitoring', function ($log, Monitoring) {
        return {
            restrict: 'AE',
            template: require('./views/partials/monitoring/monitoring.html'),
            require: '^sigeTurboMonitoringGrid',
            scope: {
                academic: '=',
                user: '=',
                monitoringtype: '=',
                monitorings: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.monitoring = {
                    status: false,
                    change: false
                };
                $scope.rating = {
                    global: 0
                };
                angular.forEach($scope.monitorings, function (monitoring) {
                    if ($scope.monitoringtype.idmonitoringtype === monitoring.idmonitoringtype) {
                        $scope.monitoring.idmonitoring = monitoring.idmonitoring;
                        $scope.monitoring.rating = monitoring.rating;
                        $scope.monitoring.status = true;
                    }
                });
            }],
            link: function (scope, element) {
                scope.save = function () {
                    if ((scope.monitoring.rating !== undefined) && (parseFloat(scope.monitoring.rating) >= 0) && (parseFloat(scope.monitoring.rating) <= 5)) {
                        if (!scope.monitoring.status) {
                            Monitoring.save({
                                year: scope.academic.year,
                                period: scope.academic.period,
                                group: scope.academic.group,
                                subject: scope.academic.subject,
                                nivel: scope.academic.nivel,
                                user: scope.user.iduser,
                                monitoringtype: scope.monitoringtype.idmonitoringtype,
                                rating: parseFloat(scope.monitoring.rating)
                            }).$promise.then(
                                function (monitoring) {
                                    scope.monitoring.status = monitoring.successful;
                                    scope.monitoring.idmonitoring = monitoring.last_insert_id;
                                    scope.monitorings.push(monitoring.monitoring);
                                },
                                function (error) {
                                    scope.monitoring.status = error.unsuccessful;
                                    $log.error(error.message);
                                }
                            );
                        } else {
                            if (scope.monitoring.change) {
                                Monitoring.update({
                                    idmonitoring: scope.monitoring.idmonitoring,
                                    year: scope.academic.year,
                                    period: scope.academic.period,
                                    group: scope.academic.group,
                                    subject: scope.academic.subject,
                                    nivel: scope.academic.nivel,
                                    user: scope.user.iduser,
                                    monitoringtype: scope.monitoringtype.idmonitoringtype,
                                    rating: parseFloat(scope.monitoring.rating)
                                }).$promise.then(
                                    function (value) {
                                        $log.info(value.message);

                                    },
                                    function (error) {
                                        $log.error(error.message);
                                    }
                                );
                            }
                            scope.monitoring.change = false;
                        }
                    }
                };

                scope.$watch('monitoring.rating', function (newRating, oldRating) {
                    if (newRating !== oldRating) {
                        $log.log('Rating', newRating);
                        scope.monitoring.change = true;
                    }
                    1;
                });
                element.bind('keydown keypress', function (event) {
                    if (event.which === 112) {
                        event.preventDefault();
                        if (scope.monitoring.rating !== undefined) {
                            if (confirm('¿Desea borrar el seguimiento?')) {
                                //Envío de Parámetros
                                Monitoring.delete({
                                    monitoringId: scope.monitoring.idmonitoring,
                                    year: scope.academic.year,
                                    period: scope.academic.period,
                                    group: scope.academic.group,
                                    subject: scope.academic.subject,
                                    nivel: scope.academic.nivel,
                                    user: scope.user.iduser
                                }).$promise.then(
                                    function (value) {
                                        $log.info(value.message);
                                        scope.monitoring.status = false;
                                        scope.monitoring.rating = undefined;

                                    },
                                    function (error) {
                                        $log.error(error.message);
                                    }
                                );
                            }
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboRecovery', ['$log', '$timeout', 'Quantitativerecovery', function ($log, $timeout, Quantitativerecovery) {
        return {
            restrict: 'AE',
            scope: {
                academic: '=',
                user: '=',
                rating: '@'
            },
            require: '^sigeTurboMonitoringGrid',
            controller: ['$scope', function ($scope) {
                $scope.recovery = '';
                $scope.folio = '';
                $scope.description = '';
                $scope.exists = false;
                $scope.recovery_id;
                $scope.flash = false;
            }],
            template: require('./views/partials/recovery/recovery.html'),
            link: function (scope, element) {
                scope.save = function () {
                    if (scope.exists === false) {
                        $log.info('New: ' + scope.user.iduser);
                        Quantitativerecovery.save({
                            year: scope.academic.year,
                            period: scope.academic.period,
                            group: scope.academic.group,
                            subject: scope.academic.subject,
                            nivel: scope.academic.nivel,
                            user: scope.user.iduser,
                            recovery: parseFloat(scope.recovery),
                            folio: scope.folio,
                            description: scope.description
                        }).$promise.then(
                            function (data) {
                                scope.exists = true;
                                scope.recovery_id = data.last_insert_id;
                                scope.flash = true;
                                $timeout(function () {
                                    scope.flash = false;
                                }, 1000);
                            },
                            function (error) {
                                $log.error(error);
                                scope.exists = false;
                                scope.flash = false;
                            }
                        );
                    } else {
                        $log.info('Update: ' + scope.user.iduser);
                        Quantitativerecovery.update({
                            idquantitativerecovery: scope.recovery_id,
                            folio: scope.folio,
                            description: scope.description,
                            recovery: parseFloat(scope.recovery)
                        }).$promise.then(
                            function (data) {
                                scope.exists = true;
                                scope.recovery_id = data.idquantitativerecovery;
                                scope.flash = true;
                                $timeout(function () {
                                    scope.flash = false;
                                }, 1000);
                            },
                            function (error) {
                                $log.error(error);
                                scope.flash = false;
                            }
                        );
                    }
                };

                scope.$watch('user', function () {

                    $log.info('Change: ' + scope.user.iduser);

                    Quantitativerecovery.getRecoveryByUser({
                        year: scope.academic.year,
                        period: scope.academic.period,
                        group: scope.academic.group,
                        subject: scope.academic.subject,
                        nivel: scope.academic.nivel,
                        user: scope.user.iduser
                    }).$promise.then(
                        function (data) {
                            if (data.idquantitativerecovery) {
                                scope.recovery = data.rating;
                                scope.folio = data.folio;
                                scope.description = data.description;
                                scope.exists = true;
                                scope.recovery_id = data.idquantitativerecovery;
                            } else {
                                scope.recovery = undefined;
                                scope.folio = undefined;
                                scope.exists = false;
                                scope.description = undefined;
                            }
                        },
                        function (error) {
                            $log.error(error);
                            scope.exists = false;
                        }
                    );
                });

                element.bind('keydown keypress', function (event) {
                    if (event.which === 112) {
                        event.preventDefault();
                        if (scope.exists) {
                            if (confirm('¿Desea borrar la recuperación?')) {
                                //Envío de Parámetros
                                Quantitativerecovery.delete({
                                    quantitativerecoveryId: scope.recovery_id
                                }).$promise.then(
                                    function (data) {
                                        $log.info(data.message);
                                        scope.exists = false;
                                        scope.recovery = undefined;
                                        scope.folio = undefined;
                                        scope.description = undefined;
                                    },
                                    function (error) {
                                        $log.error(error.message);
                                    }
                                );
                            }
                        }
                    }
                });

            }
        };
    }])
    .directive('sigeTurboAttendance', ['$log', 'Attendance', 'Enrollment', 'ASSETS_SERVER', '$filter', function ($log, Attendance, Enrollment, ASSETS_SERVER, $filter) {
        return {
            restrict: 'AE',
            template: require('./views/partials/attendance/student.html'),
            controller: ['$scope', function ($scope) {
                var date = new Date();
                $scope.attendance = {
                    type: 'Present',
                    attendanceNew: $filter('date')(date, 'yyyy-MM-dd'),
                    save: false,
                    count: ''
                };
                $scope.assets = ASSETS_SERVER;
                //!Important Searching
                $scope.showAttendance = false;
                $scope.searching = function () {
                    //Get Student
                    Enrollment.getEnrollmentsWithAttendance({
                        yearId: $scope.academic.year,
                        periodId: $scope.academic.period,
                        groupId: $scope.academic.group,
                        subjectId: $scope.academic.subject,
                        nivelId: $scope.academic.nivel,
                        date: $scope.attendance.attendanceNew
                    }).$promise.then(
                        function (users) {
                            $scope.users = users;
                            $scope.showAttendance = ($scope.users.length > 0) ? true : false;
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };
            }],
            link: function () {
            }
        };
    }])
    .directive('sigeTurboAttendanceTypes', ['$log', 'Attendance', function ($log, Attendance) {
        return {
            restrict: 'AE',
            template: require('./views/partials/attendance/types.html'),
            require: '^sigeTurboAttendance',
            scope: {
                academic: '=',
                user: '=',
                attendance: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.attendanceControl = {
                    saved: false,
                    id: ''
                };

                //Years
                $scope.attendances = [
                    {'idattendance': 1, name: '1'},
                    {'idattendance': 2, name: '2'}
                ];

                angular.forEach($scope.user.attendancetoday, function (user) {
                    $scope.attendanceControl.saved = true;
                    $scope.attendanceControl.id = user.idattendance;
                    $scope.user.attendance = user.type;
                    $scope.user.count = user.attendance;
                });
                $scope.attendanceSave = function (user, attendance) {
                    if (attendance !== 'Present') { //Ingresar o Actualizar Asistencia
                        if (!$scope.attendanceControl.saved) {
                            //Store Attendance
                            Attendance.save({
                                year: $scope.academic.year,
                                period: $scope.academic.period,
                                group: $scope.academic.group,
                                subject: $scope.academic.subject,
                                nivel: $scope.academic.nivel,
                                user: user.iduser,
                                attendance: ($scope.user.count <= 0 ? 1 : $scope.user.count),
                                type: attendance,
                                date: $scope.attendance.attendanceNew
                            }).$promise.then(
                                function (attendance) {
                                    $scope.attendanceControl.saved = attendance.successful;
                                    $scope.attendanceControl.id = attendance.last_insert_id;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        } else {
                            //Update Attendance
                            Attendance.update({
                                idattendance: $scope.attendanceControl.id,
                                year: $scope.academic.year,
                                period: $scope.academic.period,
                                group: $scope.academic.group,
                                subject: $scope.academic.subject,
                                nivel: $scope.academic.nivel,
                                user: user.iduser,
                                attendance: ($scope.user.count <= 0 ? 1 : $scope.user.count),
                                type: attendance,
                                date: $scope.attendance.attendanceNew
                            }).$promise.then(
                                function (attendance) {
                                    $scope.attendanceControl.saved = attendance.successful;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        }
                    } else {
                        if ($scope.attendanceControl.saved) {
                            //Eliminar Asistencia
                            Attendance.delete({
                                attendanceId: $scope.attendanceControl.id
                            }).$promise.then(
                                function () {
                                    $scope.attendanceControl.saved = false;
                                    $scope.user.count = 1;
                                    $scope.user.attendance = 'Present';
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );
                        }

                    }
                };
            }],
            link: {
                pre: function preLink() {

                },
                post: function postLink() {

                }


            }
        };
    }])

    .directive('sigeTurboObservator', ['$log', 'EnrollmentSimple', 'ASSETS_SERVER', function ($log, EnrollmentSimple, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.observator = {};
                $scope.assets = ASSETS_SERVER;
                //!Important Searching
                $scope.showAttendance = false;
                $scope.searching = function () {
                    //Get Student
                    EnrollmentSimple.getEnrollmentsWithObserver({
                        yearId: $scope.academic.year,
                        groupId: $scope.academic.group
                    }).$promise.then(
                        function (users) {
                            $scope.users = users;
                            $scope.showStudents = ($scope.users.length > 0) ? true : false;
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };
            }],
            template: require('./views/partials/observator/students.html'),
            link: function (scope) {

                scope.select = function (user) {
                    window.location = '/formation/observator/create/' + scope.academic.year + '/' + scope.academic.group + '/' + user.iduser;
                };
            }
        };
    }])
    .directive('sigeTurboAcademicRegistries', ['$log', 'ngDialog', 'ASSETS_SERVER', function ($log, ngDialog, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.academics = {};
                $scope.assets = ASSETS_SERVER;
                $scope.searching = function () {
                    angular.element(document.getElementById('AcademicController')).scope().$$childTail.$parent.searchingcontor();
                };
                $scope.closeDialog = function () {
                    ngDialog.close();
                };
                $scope.deleteregistry = function ($id) {
                    angular.element(document.getElementById('AcademicController')).scope().$$childTail.$parent.delete($id);
                };
            }],
            template: require('./views/partials/academic/index.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboMonitoringcategorybyyear', ['$log', 'ngDialog', '$filter', function ($log, ngDialog, $filter) {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.monitoringcategorybyyears = {};
                $scope.searching = function () {
                    angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.searchingcontor();
                };
                $scope.closeDialog = function () {
                    ngDialog.close();
                };
                $scope.deleteregistry = function ($id) {
                    angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.delete($id);
                };
            }],
            template: require('./views/partials/monitoringcategorybyyear/index.html'),
            link: function (scope) {
                scope.$watch('monitoringcategorybyyears', function (newMonitoring, oldMonitoring) {
                    if (newMonitoring !== oldMonitoring) {
                        if (scope.monitoringcategorybyyears.length > 0) {
                            scope.monitoringcategorygroups = $filter('GroupByArray')(angular.copy(scope.monitoringcategorybyyears), 'idsubject', true, 'percent', true, true);
                        } else {
                            alert('Estoy vacio');
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboPercentbysubject', ['$log', 'ngDialog', '$filter', function ($log, ngDialog, $filter) {
        return {
            restrict: 'AE',
            scope: {
                idsubject: '=',
                monitoringcategorybyyears: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.monitoringcategorybysubjects = $filter('getByPropiertyAndArray')({'idsubject': $scope.idsubject}, $scope.monitoringcategorybyyears);
                $scope.editDialog = function (registry, $controller) {
                    angular.element(document.getElementById('AcademicManagementController')).scope().$$childTail.$parent.edit(registry, $controller);//Se llama de esta manera porque si declaro el controlador AcademicManagementController en la directiva me hace el numero de peticiones a la Base de Datos tanto como se llame la directiva
                };
                $scope.deleteregistry = function ($id) {
                    angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.delete($id);
                };
            }],
            template: require('./views/partials/monitoringcategorybyyear/percentbysubject.html'),
            link: function (scope) {

            }
        };
    }])
    .directive('sigeTurboAreasubjectandnivels', ['$log', 'ASSETS_SERVER', 'ngDialog', '$filter', function ($log, ASSETS_SERVER, ngDialog, $filter) {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.searching = function () {
                    angular.element(document.getElementById('AreaManagerController')).scope().$$childTail.$parent.searchingcontor();
                };
                $scope.closeDialog = function () {
                    ngDialog.close();
                };
                $scope.deleteregistry = function ($id) {
                    angular.element(document.getElementById('AreaManagerController')).scope().$$childTail.$parent.delete($id);
                };
                $scope.assets = ASSETS_SERVER;
            }],
            template: require('./views/partials/subjectwithareasandnivel/index.html'),
            link: function (scope) {
                scope.$watch('subjectwithareasandnivels', function (newSubWithAreAndNiv, oldSubWithAreAndNiv) {
                    if (newSubWithAreAndNiv !== oldSubWithAreAndNiv) {
                        if (scope.subjectwithareasandnivels.length > 0) {
                            scope.areasgroups = $filter('GroupByArray')(angular.copy(scope.subjectwithareasandnivels), 'idarea', true, 'idsubject', true, true);
                        } else {
                            alert('Estoy vacio');
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboSubjectsbyarea', ['$log', 'ngDialog', '$filter', function ($log, ngDialog, $filter) {
        return {
            restrict: 'AE',
            scope: {
                idarea: '=',
                subjectwithareasandnivels: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.subjectbyareas = $filter('GroupByArray')(angular.copy($filter('getByPropiertyAndArray')({'idarea': $scope.idarea}, $scope.subjectwithareasandnivels)), 'idsubject', true, 'idnivel', true, true);
                $scope.editDialog = function (registry, $controller) {
                    angular.element(document.getElementById('AcademicManagementController')).scope().$$childTail.$parent.edit(registry, $controller);
                };
                $scope.deleteregistry = function ($id) {
                    angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.delete($id);
                };
            }],
            template: require('./views/partials/subjectwithareasandnivel/subjectsbyarea.html'),
            link: function (scope) {
                scope.$watch('subjectbyareas', function (newSubByarea, oldSubByarea) {
                    if (newSubByarea !== oldSubByarea) {
                        if (scope.subjectbyareas.length > 0) {
                            scope.subjectsgroups = $filter('GroupByArray')(angular.copy(scope.subjectwithareasandnivels), 'idsubject', true, 'idnivel', true, true);
                        } else {
                            alert('Estoy vacio');
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboNivelsbysubject', ['$log', 'ngDialog', '$filter', function ($log, ngDialog, $filter) {
        return {
            restrict: 'AE',
            scope: {
                idsubject: '=',
                subjectwithareasandnivels: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.nivelsbysubjects = $filter('getByPropiertyAndArray')({'idsubject': $scope.idsubject}, $scope.subjectwithareasandnivels);
                $scope.editDialog = function (registry, $controller) {
                    angular.element(document.getElementById('AcademicManagementController')).scope().$$childTail.$parent.edit(registry, $controller);//Se llama de esta manera porque si declaro el controlador AcademicManagementController en la directiva me hace el numero de peticiones a la Base de Datos tanto como se llame la directiva
                };
                $scope.deleteregistry = function ($id) {
                    angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.delete($id);
                };
            }],
            template: require('./views/partials/subjectwithareasandnivel/nivelsbysubject.html'),
            link: function () {

            }
        };
    }])
    .directive('sigeTurboGroupDirector', ['$log', 'ngDialog', 'GroupDirector', 'ASSETS_SERVER', function ($log, ngDialog, GroupDirector, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.groupdirectors = {};
                $scope.assets = ASSETS_SERVER;
                $scope.searching = function () {
                    GroupDirector.getGroupdirectorsByYear({
                        yearId: $scope.academic.year,
                        groupId: $scope.academic.group
                    }).$promise.then(
                        function (groupdirectors) {
                            $scope.groupdirectors = groupdirectors;
                            //alert(JSON.stringify($scope.groupdirectors));
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };
                $scope.closeDialog = function () {
                    ngDialog.close();
                };
            }],
            template: require('./views/partials/groupdirector/index.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboMonitoringPendingsByStudents', ['$log', '$filter', 'ASSETS_SERVER', function ($log, $filter, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            scope: {
                registries: '=',
                elementsearch: '=',
                resumen: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.assets = ASSETS_SERVER;
                $scope.input = function ($id, $value, $searchvalue) {
                    $scope.elementsearch = {id: $id, value: $value, searchvalue: $searchvalue};
                };
            }],
            template: require('./views/partials/monitoring/pendingsmonitoringsbyusers.html'),
            link: function (scope) {
                scope.$watch('registries', function (newRegistries) {
                    if ((newRegistries != undefined && newRegistries != '') && (typeof newRegistries == 'object')) {
                        scope.groupsinput = $filter('GroupByArray')(angular.copy(scope.registries), 'idgroup', true, 'idgroup', true, true);
                        scope.subjectsinput = $filter('GroupByArray')(angular.copy(scope.registries), 'idsubject', true, 'idsubject', true, true);
                        scope.statusesinput = $filter('GroupByArray')(angular.copy(scope.registries), 'idstatusschooltype', true, 'idstatusschooltype', true, true);
                        scope.resumen = {
                            'Registries': angular.copy(scope.registries).length,
                            'Groups': scope.groupsinput.length,
                            'Subjects': scope.subjectsinput.length,
                            'Students': $filter('GroupByArray')(angular.copy(scope.registries), 'User', true, 'User', true, true).length
                        };

                        scope.$watch('teacherselect', function (newTeacher) {
                            scope.elementsearch = {id: 'teacher', value: newTeacher, searchvalue: newTeacher};
                        });

                        scope.$watch('studentselect', function (newStudent) {
                            scope.elementsearch = {id: 'student', value: newStudent, searchvalue: newStudent};
                        });
                    }
                });
            }
        };
    }])
    .directive('sigeTurboTeachersPendingsByRating', ['$log', 'ASSETS_SERVER', function ($log, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            scope: {
                teachersdata: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.assets = ASSETS_SERVER;
                $scope.teachersdata = eval($scope.teachersdata);
            }],
            template: require('./views/partials/monitoring/teacherspendingsbyrating.html'),
            link: function () {

            }
        };
    }])
    .directive('sigeTurboTeachersPendingsByRatingStatistics', ['$log', '$filter', function ($log, $filter) {
        return {
            restrict: 'AE',
            scope: {
                registries: '=',
                elementsearch: '='
            },
            controller: ['$scope', function () {

            }],
            template: require('./views/partials/monitoring/teacherspendingsbyratingstatistics.html'),
            link: function (scope) {
                scope.$watch('elementsearch', function (newElementSearch) {
                    scope.total = 0;
                    if (newElementSearch.value != undefined) {
                        switch (newElementSearch.id) {
                        case 'student':
                            scope.summaries = $filter('GroupByArray')($filter('getByPropiertyAndArray')({'User': newElementSearch.searchvalue}, angular.copy(scope.registries)), 'idsubject', true, 'idsubject', true, true);
                            break;
                        case 'teacher':
                            scope.summaries = [];
                            angular.forEach(angular.copy(scope.registries), function (subarray) {
                                angular.forEach($filter('getByPropiertyAndArray')({'idteacher': newElementSearch.searchvalue}, angular.copy(eval(subarray.idteachersnivels))), function (val, ind) {
                                    scope.summaries.push(subarray);
                                });
                            });
                            scope.summaries = $filter('GroupByArray')(angular.copy(scope.summaries), 'idgroup', true, 'idgroup', true, true);

                            break;
                        case 'status':
                            scope.summaries = $filter('GroupByArray')($filter('getByPropiertyAndArray')({'idstatusschooltype': newElementSearch.value.idstatusschooltype}, angular.copy(scope.registries)), 'idstatusschooltype', true, 'idstatusschooltype', true, true);
                            break;
                        case 'group':
                            scope.summaries = $filter('GroupByArray')($filter('getByPropiertyAndArray')({'idgroup': newElementSearch.value.idgroup}, angular.copy(scope.registries)), 'idsubject', true, 'idsubject', true, true);
                            break;
                        default:
                            scope.summaries = $filter('GroupByArray')($filter('getByPropiertyAndArray')({'idsubject': newElementSearch.value.idsubject}, angular.copy(scope.registries)), 'idgroup', true, 'idgroup', true, true);
                            break;
                        }
                        //console.log(JSON.stringify(scope.summaries));
                    }
                });
            }
        };
    }])
    .directive('sigeTurboCandidates', ['Vote','$window', function (Vote, $window) {
        //var converter = new Showdown.converter();
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.send = function ($iduser) {
                    Vote.save({
                        type: 1,
                        iduser: $iduser
                    }).$promise.then(
                        function (result) {
                            $('#votesTNS-Personero-Show').remove();
                            $('#votesTNS-Personero-Message').html(result.message);
                            $('#votesTNS-Personero-Message').show(1200);
                            var votoPersonero;
                            votoPersonero = true;
                            if (votoPersonero) {
                                setTimeout(function () {
                                    $window.location.href = '/vote';
                                }, 10000);
                            }
                        },
                        function (error) {
                            console.log(error);
                        }
                    );

                };
            }],
            template: require('./views/partials/vote/index.html'),
            link: function () {

            }
        };
    }])
    .directive('sigeTurboAreamanager', ['$log', 'ASSETS_SERVER', 'ngDialog', function ($log, ASSETS_SERVER, ngDialog) {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.searching = function () {
                    angular.element(document.getElementById('AreaManagerController')).scope().$$childTail.$parent.searchingcontor();
                };
                $scope.closeDialog = function () {
                    ngDialog.close();
                };
                $scope.deleteregistry = function ($id) {
                    angular.element(document.getElementById('AreaManagerController')).scope().$$childTail.$parent.delete($id);
                };
                $scope.assets = ASSETS_SERVER;
            }],
            template: require('./views/partials/areamanager/index.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboPartial', ['$log', 'Partial', 'Enrollment', 'ASSETS_SERVER', '$filter', function ($log, Partial, Enrollment, ASSETS_SERVER, $filter) {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.order = {
                    item: 'lastname',
                    reverse: false
                };
                $scope.assets = ASSETS_SERVER;
                //!Important Searching
                $scope.showPartial = false;
                $scope.searching = function () {
                    //Get Student
                    Enrollment.getEnrollmentsWithPartial({
                        yearId: $scope.academic.year,
                        periodId: $scope.academic.period,
                        groupId: $scope.academic.group,
                        subjectId: $scope.academic.subject,
                        nivelId: $scope.academic.nivel
                    }).$promise.then(
                        function (users) {
                            $scope.users = users;
                            $scope.showPartial = ($scope.users.length > 0) ? true : false;
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };
            }],
            template: require('./views/partials/partial/student.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboDescriptiveReport', ['$log', 'Descriptivereport', 'Enrollment', 'ASSETS_SERVER', '$filter', function ($log, Descriptivereport, Enrollment, ASSETS_SERVER, $filter) {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {
                $scope.order = {
                    item: 'lastname',
                    reverse: false
                };
                $scope.assets = ASSETS_SERVER;
                //!Important Searching
                $scope.showDescriptivereport = false;
                $scope.searching = function () {
                    //Get Student
                    Enrollment.getEnrollmentsWithDescriptivereport({
                        yearId: $scope.academic.year,
                        periodId: $scope.academic.period,
                        groupId: $scope.academic.group,
                        subjectId: $scope.academic.subject,
                        nivelId: $scope.academic.nivel
                    }).$promise.then(
                        function (users) {
                            $scope.users = users;
                            $scope.showDescriptivereport = ($scope.users.length > 0) ? true : false;
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };
            }],
            template: require('./views/partials/descriptivereport/student.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboAcademicContract', ['$log', 'Contract', 'ASSETS_SERVER', '$timeout', '$filter', function ($log, Contract, ASSETS_SERVER, $timeout, $filter) {
        return {
            restrict: 'AE',
            /*scope: {
             groups: '=',
             subjects: '=',
             nivels: '='
             },*/
            require: '^sigeTurboAcademicToAssign',
            controller: ['$scope', function ($scope) {
                $scope.assets = ASSETS_SERVER;
                //!Important Searching
                $scope.editform = function ($object) {
                    $scope.academic.idgroup = $object.idgroup;
                    $scope.academic.iduser = $object.iduser;
                    $scope.academic.timeintensity = $object.timeintensity;
                    $timeout(function () {
                        $scope.academic.idsubject = $object.idsubject;
                        $timeout(function () {
                            $scope.academic.idnivel = $object.idnivel;
                        }, 200);
                    }, 100);
                    $scope.academic.idcontract = $object.idcontract;
                };
            }],
            template: require('./views/partials/contract/list.html'),
            link: function (scope) {

                scope.nonulos = function (object) {
                    var $busqueda = {};
                    //var total = Object.keys(object).length;
                    //var count = 0;
                    for (var key in object) {
                        if (object[key] !== 'Loading ...' && object[key] !== undefined && object[key] !== null && object[key] !== '') {
                            $busqueda[key] = object[key];
                            count++;
                            //if(total == count) //haga
                        }
                    }
                    return $busqueda;
                };

                scope.contractsname = function ($array) {
                    var i = 0, len = $array.length;
                    var count = 0;
                    for (; i < len; i++) {
                        count = 0;
                        var $user = $filter('getByProperty')('iduser', $array[i]['iduser'], angular.copy(scope.users));
                        $array[i]['fullname'] = $user['firstname'] + ' ' + $user['lastname'];
                        $array[i]['photo'] = $user['photo'];
                        var $subjects = $filter('getByProperty')('idsubject', $array[i]['idsubject'], angular.copy(scope.subjects));
                        $array[i]['subject'] = $subjects['name'];
                        var $nivels = $filter('getByProperty')('idnivel', $array[i]['idnivel'], angular.copy(scope.nivelsoriginal));
                        $array[i]['nivel'] = $nivels['name'];
                        var $groups = $filter('getByProperty')('idgroup', $array[i]['idgroup'], angular.copy(scope.groups));
                        $array[i]['group'] = $groups['name'];
                        count += 1;
                    }
                    return $array;
                };

                scope.$watch('academic.idperiod', function (newPeriod, oldPeriod) {
                    if ((!isNaN(newPeriod)) && (newPeriod != undefined || newPeriod != oldPeriod)) {
                        Contract.getContractsByYearAndPeriod({
                            idyear: scope.academic.idyear,
                            idperiod: scope.academic.idperiod
                        }).$promise.then(
                            function (contracts) {
                                scope.contractoriginals = contracts;
                            },
                            function (error) {
                                $log.error(error);
                            }
                        ).then(function () {
                        });
                    }
                });

                scope.$watch('groups', function (newGroups) {
                    if ((newGroups != undefined && newGroups != '') && (typeof newGroups == 'object')) {
                        scope.$watch('academic.idgroup', function (newGroup, oldGroup) {
                            if (newGroup !== 'Loading ...' && newGroup !== oldGroup) {
                                scope.nivels = scope.nivelsoriginal;
                                scope.academic.idcontract = undefined;
                                scope.academic.timeintensity = undefined;
                                scope.academic.idsubject = 'Loading ...';
                                scope.academic.idnivel = 'Loading ...';
                                scope.academic.iduser = undefined;
                                scope.contracts = scope.contractsname($filter('getByPropiertyAndArray')(scope.nonulos(scope.academic), angular.copy(scope.contractoriginals)));
                            }
                        });
                    }
                });

                scope.$watch('subjects', function (newSubjects) {
                    if ((newSubjects != undefined && newSubjects != '') && (typeof newSubjects == 'object')) {
                        scope.$watch('academic.idsubject', function (newSubject, oldSubject) {
                            if (newSubject !== 'Loading ...' && newSubject !== oldSubject) {
                                scope.academic.idcontract = undefined;
                                scope.academic.timeintensity = undefined;
                                scope.academic.idnivel = 'Loading ...';
                                scope.academic.iduser = undefined;
                                scope.contracts = scope.contractsname($filter('getByPropiertyAndArray')(scope.nonulos(scope.academic), angular.copy(scope.contractoriginals)));
                            }
                        });
                    }
                });

                scope.$watch('nivelsoriginal', function (newNivels) {
                    if ((newNivels != undefined && newNivels != '') && (typeof newNivels == 'object')) {
                        scope.$watch('academic.idnivel', function (newNivel, oldNivel) {
                            if (newNivel !== 'Loading ...' && newNivel !== oldNivel) {
                                scope.contracts = scope.contractsname($filter('getByPropiertyAndArray')(scope.nonulos(scope.academic), angular.copy(scope.contractoriginals)));
                                scope.academic.iduser = undefined;
                                scope.academic.idcontract = undefined;
                            }
                        });
                    }
                });

                scope.$watch('users', function (newUsers) {
                    if ((newUsers != undefined && newUsers != '') && (typeof newUsers == 'object')) {
                        scope.$watch('academic.iduser', function (newUser, oldUser) {
                            if (newUser !== undefined && newUser !== oldUser) {
                                scope.contracts = scope.contractsname($filter('getByPropiertyAndArray')(scope.nonulos(scope.academic), angular.copy(scope.contractoriginals)));
                            }
                        });
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAdmissionsAssignOrSelectedStudents', ['$log', 'User', 'SweetAlert', 'ASSETS_SERVER', '$filter', function ($log, User, SweetAlert, ASSETS_SERVER, $filter) {
        return {
            restrict: 'AE',
            scope: {
                destination: '@',
                route: '=',
                user: '=',
                user_name: '@',
                widthdefault: '@',
                showusers: '@',
                userdefault: '='
            },
            controller: ['$scope', function ($scope) {
                //Scope
                $scope.assets = ASSETS_SERVER;
                $scope.showUsers = true;
                User[$scope.showusers]({}).$promise.then(
                    function (users) {
                        $scope.users = users;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                $scope.close = function () {
                    $scope.showUsers = false;
                };

            }],
            template: require('../../admissions/directives/views/student/select.html'),
            link: function (scope) {

                //Verified Empty Text
                scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                };

                scope.AddUser = function (user) {
                    scope.user_name = (user == null || Object.keys(user).length == 0) ? '' : user.firstname + ' ' + user.lastname;
                    scope.user = user;
                    scope.showUsers = false;
                };

                scope.$watch('user_name', function (newUser) {
                    if (newUser != undefined || !scope.isEmpty(newUser)) {
                        scope.showUsers = true;
                    }
                    if (newUser == undefined || scope.isEmpty(newUser)) {
                        scope.userdefault = undefined;
                        scope.AddUser({});
                    }
                });
                scope.$watch('userdefault', function (newUser, oldUser) {
                    if ((newUser != undefined || !scope.isEmpty(newUser)) || (newUser != oldUser)) {
                        var usershow = $filter('getByProperty')('iduser', newUser, scope.users);
                        scope.AddUser(usershow);
                        scope.showUsers = false;
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAssignOnlyUser', ['$log', 'User', 'SweetAlert', 'ASSETS_SERVER', '$filter', function ($log, User, SweetAlert, ASSETS_SERVER, $filter) {
        return {
            restrict: 'AE',
            scope: {
                destination: '@',
                route: '=',
                user: '=',
                user_name: '@',
                widthdefault: '@',
                showusers: '@',
                showusersparams: '=?', // Es un parametro opcional
                userdefault: '='
            },
            controller: ['$scope', function ($scope) {
                //Scope
                $scope.assets = ASSETS_SERVER;
                $scope.showUsers = true;
                User[$scope.showusers](($scope.showusersparams) ? $scope.showusersparams : {}).$promise.then(
                    function (users) {
                        $scope.users = users;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                $scope.close = function () {
                    $scope.showUsers = false;
                };

            }],
            template: require('../../admissions/directives/views/student/select.html'),
            link: function (scope) {

                scope.$watch('users', function (newUsers) {
                    if (newUsers != undefined) {
                        scope.$watch('userdefault', function (newUser) {
                            if ((newUser != undefined && typeof newUser != 'object')) {
                                var usershow = $filter('getByProperty')('iduser', newUser, scope.users);
                                scope.AddUser(usershow);
                                scope.showUsers = false;
                            }
                        });
                        scope.$watch('user_name', function (newUser) {
                            if (newUser != undefined || !scope.isEmpty(newUser)) {
                                scope.showUsers = true;
                            }
                            if (newUser == undefined || scope.isEmpty(newUser)) {
                                scope.userdefault = undefined;
                                scope.AddUser({});
                            }
                        });
                        //Verified Empty Text
                        scope.isEmpty = function (str) {
                            return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                        };

                        scope.AddUser = function (user) {
                            scope.user_name = (user == null || Object.keys(user).length == 0) ? '' : user.firstname + ' ' + user.lastname;
                            scope.user = user;
                            scope.showUsers = false;
                        };
                    }
                });
            }
        };
    }]);