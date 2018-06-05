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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 21);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/coffee/Stream.coffee":
/***/ (function(module, exports) {

var Stream;

Stream = {
  Main: function() {
    this.init = function() {
      this.eventHandler();
    };
    this.onScroll = function() {};
    this.onResize = function() {};
    this.eventHandler = function() {
      var socket;
      //Socket
      socket = io('https://sigeturbo.thenewschool.edu.co:3000');
      return socket.on('sigeturbo-channel:SigeTurbo\\Events\\Stream', function(stream) {
        var stream_container, stream_node, timeID;
        if (timeID) {
          clearTimeout(timeID);
          false;
        }
        stream_container = $("#sigeturbo_stream");
        stream_container.css({
          bottom: "0px",
          display: "block"
        });
        stream_node = stream_container.find(".stream");
        stream_node.html(stream.data.message);
        timeID = setTimeout(function() {
          stream_container.css({
            bottom: "-70px",
            display: "none"
          });
          return false;
        }, 10000);
        return false;
      });
    };
    return this.init();
  }
};

$(function() {
  return window.main = new Stream.Main();
});


/***/ }),

/***/ 21:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/coffee/Stream.coffee");


/***/ })

/******/ });