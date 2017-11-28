'use strict';

/* Core Services */
angular.module('Core.services', [])
    .constant('TOKEN', '1234')
    .constant('CONVENIO_ID', 4300)
    .constant('CONVENIO_KEY', '477009070')
    .constant('ASSETS_SERVER', 'https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com')
    .value('version', '0.1')
    .service('sigeTurboStorage', ['$window', function ($window) {
        this.setStorage = function (name, value) {
            $window.sessionStorage.setItem(name, value);
        };
        this.getStorage = function (name) {
            return $window.sessionStorage.getItem(name);
        };
    }])
    .service('sigeTurboUpload', ['$http',function ($http) {
        //Upload File
        this.uploadFileToUrl = function (file, uploadUrl) {
            var fd = new FormData();
            fd.append('file', file);
            return $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                sigeJsonContentType: false,
                headers: {
                    'X-Force-Content-Type': undefined,
                    'enctype': 'multipart/form-data'
                }
            });
        };
        //Delete File
        this.deleteFile = function (file, uploadUrl) {
            return $http.get(uploadUrl, null, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            });
        };
    }]);