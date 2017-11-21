/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/coffee/SigeTurbo.coffee":
/***/ (function(module, exports) {

var SigeTurbo;

SigeTurbo = {
  Main: function() {
    var options;
    options = {
      menu_extended: false
    };
    this.init = function() {
      $(window).on('scroll', this.onScroll);
      $(window).on('resize', this.onResize);
      this.eventHandler();
    };
    this.onScroll = function() {
      var contained;
      if ($(window).scrollTop() === 0) {
        $("ul#breadcrumb").removeClass("on");
      } else {
        $("ul#breadcrumb").addClass("on");
      }
      contained = $("#sige-content").height();
      if (contained >= $(window).scrollTop()) {
        $("aside").css("top", ($(window).scrollTop()) + "px");
      }
    };
    this.onResize = function() {};
    this.eventHandler = function() {
      var menuVisible, toggle;
      toggle = false;
      $("#mobile-toggle").bind("click", function(toogle) {
        if (toggle) {
          $("#sige-main-container").css({
            "left": "0px",
            "right": "0px"
          });
          $("#account-info").css({
            "display": "none"
          });
          $("#breadcrumb").css({
            "left": "0px",
            "right": "0px"
          });
          $("#navigation").css({
            "left": "initial",
            "right": "0px",
            "display": "none"
          });
          toggle = false;
        } else {
          $("#sige-main-container").css({
            "left": "-250px",
            "right": "250px"
          });
          $("#account-info").css({
            "display": "block"
          });
          $("#breadcrumb").css({
            "left": "-250px",
            "right": "250px"
          });
          $("#navigation").css({
            "left": "initial",
            "right": "0",
            "display": "block"
          });
          toggle = true;
        }
      });
      menuVisible = false;
      $('#profile-view').bind("click", function(e) {
        e.preventDefault();
        if (menuVisible) {
          $('#profile-dropdown').css({
            'display': 'none'
          });
          menuVisible = false;
          return;
        }
        $('#profile-dropdown').css({
          'display': 'block'
        });
        return menuVisible = true;
      });
      $('#profile-dropdown').bind("click", function(e) {
        $(this).css({
          'display': 'none'
        });
        menuVisible = false;
      });
      $('#sige-welcome-close').bind("click", function(e) {
        $('#contained').fadeOut(2000);
      });
      $('#show_academic_info').bind("click", function(e) {
        e.preventDefault();
        $('.info').fadeIn(2000);
      });
      $('#sigeturbo_apple').bind("click", function(e) {
        e.preventDefault();
        alert("Muy pronto ...");
        return false;
      });
      $('#sigeturbo_google').bind("click", function(e) {
        e.preventDefault();
        alert("Muy pronto ...");
        return false;
      });
      $("#apps").on("change", function() {
        return window.location.href = '/' + this.value;
      });
      //DatePicker
      $('[data-toggle="starts"]').datepicker({
        format: 'yyyy-mm-dd',
        autoHide: true
      });
      $('[data-toggle="ends"]').datepicker({
        format: 'yyyy-mm-dd',
        autoHide: true
      });
      $('[data-toggle="register"]').datepicker({
        format: 'yyyy-mm-dd',
        autoHide: true
      });
      $('[data-toggle="statusdate"]').datepicker({
        format: 'yyyy-mm-dd',
        autoHide: true
      });
      $('[data-toggle="date"]').datepicker({
        format: 'yyyy-mm-dd',
        autoHide: true
      });
      return $('[data-toggle="birth"]').datepicker({
        format: 'yyyy-mm-dd',
        autoHide: true
      });
    };
    return this.init();
  }
};

$(function() {
  return window.main = new SigeTurbo.Main();
});


/***/ }),

/***/ 10:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/coffee/SigeTurbo.coffee");


/***/ })

/******/ });