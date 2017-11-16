'use strict';

/* Formation Filters */
angular.module('Formation.filters', [])
    .filter('interpolate', ['version', function (version) {
        return function (text) {
            return String(text).replace(/\%VERSION\%/mg, version);
        }
    }])
    .filter('averageByCategory', function () {
        return function (monitorings, rating, category) {
            if (typeof(monitorings) === 'undefined' && typeof(rating) === 'undefined' && typeof(category) === 'undefined') {
                return 0;
            }
            function round(value, decimals) {
                return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
            }

            var sum = 0;
            var count = 0;
            for (var i = 0; i < monitorings.length; i++) {
                if (monitorings[i]['idmonitoringcategory'] == category.idmonitoringcategory) {
                    count++;
                    sum = sum + parseFloat(monitorings[i][rating]);
                }
            }
            var average = ((sum / count) * parseFloat(category.percent));
            return isNaN(average) ? 0 : round(average, 2);
        }
    })
    .filter('averageGlobal', function () {
        return function (monitorings, rating, categories) {
            if (typeof(monitorings) === 'undefined' && typeof(rating) === 'undefined' && typeof(categories) === 'undefined') {
                return 0;
            }
            var global = 0;

            function round(value, decimals) {
                return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
                //return value.toFixed(decimals);
            }

            for (var i = 0; i < categories.length; i++) {
                var sum = 0;
                var count = 0;
                for (var j = 0; j < monitorings.length; j++) {
                    if (monitorings[j]['idmonitoringcategory'] === categories[i]['idmonitoringcategory']) {
                        count++;
                        sum = sum + parseFloat(monitorings[j][rating]);
                    }
                }
                var average = parseFloat(((sum / count) * parseFloat(categories[i].percent)));
                global = parseFloat(global + (isNaN(average) ? 0 : round(average, 2)));
            }
            return isNaN(global) ? 0 : round(global, 2);
        }
    })
    .filter('performance', function () {
        return function (rating, style) {
            if (style === 'normal') {
                switch (true) {
                    case (rating >= 4.31 && rating <= 5.00):
                        return "ds";
                    case (rating >= 3.71 && rating < 4.31):
                        return "da";
                    case (rating >= 3.00 && rating < 3.71):
                        return "db";
                    case (rating > 0.00 && rating < 3.00):
                        return "dp";
                    default:
                        return "dp";
                }
            } else {
                switch (true) {
                    case (rating >= 4.31 && rating <= 5.00):
                        return "ds-background";
                    case (rating >= 3.71 && rating < 4.31):
                        return "da-background";
                    case (rating >= 3.00 && rating < 3.71):
                        return "db-background";
                    case (rating > 0.00 && rating < 3.00):
                        return "dp-background";
                    default:
                        return "normal-background";
                }
            }
        }
    })
    .filter('grades', function () {
        return function (ratings, user) {
            if (typeof(ratings) === 'undefined') {
                return 0;
            }
            for (var i = 0; i < ratings.length; i++) {
                if (ratings[i]['iduser'] == user) {
                    return ratings[i]['rating'];
                }
            }
        }
    })
    .filter('days', ['$filter', function ($filter) {
        return function (days) {
            var text = '1 day';
            if (days > 1) {
                text = days + ' days';
            }
            return text;
        }
    }])
    .filter('taskStatus', ['$filter', function ($filter) {
        return function (status) {
            var result = 'draft';
            if (status == 1) {
                result = 'approved';
            }
            return result;
        }
    }])
    .filter('highlight', function ($sce) {
        return function (text, phrase) {
            if (phrase) text = text.replace(new RegExp('(' + phrase + ')', 'gi'),
                '<span class="highlighted">$1</span>')

            return $sce.trustAsHtml(text)
        }
    }).filter('getByProperty', function () {
    return function (propertyName, propertyValue, collection) {
        var i = 0, len = collection.length;
        for (; i < len; i++) {
            if (collection[i][propertyName] == +propertyValue) {
                return collection[i];
            }
        }
        return null;
    }
}).filter('getByPropertyAnd', function () {
    return function (fields, collection) {
        var i = 0, len = collection.length;
        for (; i < len; i++) {
            var total = Object.keys(fields).length;
            var count = 0;
            for (var key in fields) {
                if (collection[i][key] == +fields[key]) {
                    count += 1;
                }
            }
            if (count == total) return collection[i];
        }
        return null;
    }
}).filter('getByPropiertyAndArray', function () {
    return function (fields, collection) {
        var i = 0, len = collection.length;
        var results = [];
        for (; i < len; i++) {
            var total = Object.keys(fields).length;
            var count = 0;
            for (var key in fields) {
                if (collection[i][key] == +fields[key]) {
                    count += 1;
                }
            }
            if (count == total) results.push(collection[i]);
        }
        return results;
    }
}).filter('getValidate', function () {
    return function (el) {
        Date.prototype.lastDay=function(){
        var A=[];
        for(var i=1; i<=12; i++) {
            A[A.length]= new Date(this.getFullYear(), i,0).getDate();
        }
        return  A;
        }
        var re= /^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/;
        if(el != 'undefined' && el != undefined && el != ""){
           //alert("Entre" + el);
            var M= el.match(re);
            var s=el.split(/\D/);
            var d = new Date(s[0]*1,s[1]-1,s[2]*1);
            var L=d.lastDay()[s[1]-1];
            return (M && s[2]<=L)? true : false;
        }
    }
}).filter('GroupByArray', function () {
    return function ($arraytoagrupate,$fieldtoagrupate,$count,$fieldtosum,$sum,$avg,callback) {
        var $arrayagrupate = [];
        var $valueagrupate = [];
        angular.forEach($arraytoagrupate, function(subarray,indexofarray) {
            angular.forEach(subarray, function(val,ind) {
                if(ind == $fieldtoagrupate){
                    if($valueagrupate.indexOf(val) == -1){
                        if($count)subarray['count'] = 1;
                        if($sum)(!isNaN(parseFloat(subarray[$fieldtosum]))) ?  subarray['sum'] = parseFloat(subarray[$fieldtosum]) : subarray['sum'] = "" ;
                        if($avg) (!isNaN(parseFloat(subarray[$fieldtosum]))) ?  subarray['avg'] = parseFloat(subarray[$fieldtosum]) / parseFloat(subarray['count']) : subarray['avg'] = "";
                        $arrayagrupate.push(subarray);
                        $valueagrupate.push(val);
                    }else{
                        if($count)addcount(subarray);
                    }
                    if(callback)callback();
                }
            });
        });
        function addcount ($valueincommon) {
            angular.forEach($arrayagrupate, function(value,index) {
                angular.forEach(value, function(val,ind) {
                    if(ind == $fieldtoagrupate){
                    if(val == $valueincommon[$fieldtoagrupate]){
                        $arrayagrupate[index]['count'] ++;
                        if($sum){
                        /*alert("En el monitoringtype "+$valueincommon['idmonitoringtype']+" con el Monitorincategory: "+$arrayagrupate[index][$fieldtoagrupate]+" se le suma este  valor : "+ $valueincommon[$fieldtosum]+" y la suma global va en: "+$arrayagrupate[index]['sum']);*/
                        if(isNaN(parseFloat($arrayagrupate[index]['sum']))){
                            $arrayagrupate[index]['sum'] = 0;
                            if(!isNaN(parseFloat($valueincommon[$fieldtosum]))){
                            $arrayagrupate[index]['sum'] = parseFloat($arrayagrupate[index]['sum']) + parseFloat($valueincommon[$fieldtosum]);
                            if($avg) $arrayagrupate[index]['avg'] = parseFloat($arrayagrupate[index]['sum']) / parseFloat($arrayagrupate[index]['count']);
                            } 
                        }else{
                            if(!isNaN(parseFloat($valueincommon[$fieldtosum]))){
                            $arrayagrupate[index]['sum'] = parseFloat($arrayagrupate[index]['sum']) + parseFloat($valueincommon[$fieldtosum]);
                            if($avg) $arrayagrupate[index]['avg'] = parseFloat($arrayagrupate[index]['sum']) / parseFloat($arrayagrupate[index]['count']);
                            }
                        } 
                        }
                    }
                    }
                });
            }); 
        }
        return $arrayagrupate;  
    }
});