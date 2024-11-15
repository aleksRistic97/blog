(self["webpackChunk"] = self["webpackChunk"] || []).push([["switchLanguage"],{

/***/ "./assets/js/switchLanguage.js":
/*!*************************************!*\
  !*** ./assets/js/switchLanguage.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
function switchLanguage(language) {
  var currentUrl = window.location.href;
  if (language === 'sr') {
    window.location.href = currentUrl.replace(/\/(en|sr)\//, '/sr/');
  }
  if (language === 'en') {
    window.location.href = currentUrl.replace(/\/(en|sr)\//, '/en/');
  }
}
window.switchLanguage = switchLanguage;

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_string_replace_js"], () => (__webpack_exec__("./assets/js/switchLanguage.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoic3dpdGNoTGFuZ3VhZ2UuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7OztBQUFBLFNBQVNBLGNBQWNBLENBQUNDLFFBQVEsRUFBRTtFQUM5QixJQUFNQyxVQUFVLEdBQUdDLE1BQU0sQ0FBQ0MsUUFBUSxDQUFDQyxJQUFJO0VBRXZDLElBQUlKLFFBQVEsS0FBSyxJQUFJLEVBQUU7SUFFbkJFLE1BQU0sQ0FBQ0MsUUFBUSxDQUFDQyxJQUFJLEdBQUdILFVBQVUsQ0FBQ0ksT0FBTyxDQUFDLGFBQWEsRUFBRSxNQUFNLENBQUM7RUFDcEU7RUFHQSxJQUFJTCxRQUFRLEtBQUssSUFBSSxFQUFFO0lBRW5CRSxNQUFNLENBQUNDLFFBQVEsQ0FBQ0MsSUFBSSxHQUFHSCxVQUFVLENBQUNJLE9BQU8sQ0FBQyxhQUFhLEVBQUUsTUFBTSxDQUFDO0VBQ3BFO0FBQ0o7QUFFQUgsTUFBTSxDQUFDSCxjQUFjLEdBQUdBLGNBQWMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvc3dpdGNoTGFuZ3VhZ2UuanMiXSwic291cmNlc0NvbnRlbnQiOlsiZnVuY3Rpb24gc3dpdGNoTGFuZ3VhZ2UobGFuZ3VhZ2UpIHtcbiAgICBjb25zdCBjdXJyZW50VXJsID0gd2luZG93LmxvY2F0aW9uLmhyZWY7XG5cbiAgICBpZiAobGFuZ3VhZ2UgPT09ICdzcicpIHtcblxuICAgICAgICB3aW5kb3cubG9jYXRpb24uaHJlZiA9IGN1cnJlbnRVcmwucmVwbGFjZSgvXFwvKGVufHNyKVxcLy8sICcvc3IvJyk7XG4gICAgfVxuXG5cbiAgICBpZiAobGFuZ3VhZ2UgPT09ICdlbicpIHtcblxuICAgICAgICB3aW5kb3cubG9jYXRpb24uaHJlZiA9IGN1cnJlbnRVcmwucmVwbGFjZSgvXFwvKGVufHNyKVxcLy8sICcvZW4vJyk7XG4gICAgfVxufVxuXG53aW5kb3cuc3dpdGNoTGFuZ3VhZ2UgPSBzd2l0Y2hMYW5ndWFnZTsiXSwibmFtZXMiOlsic3dpdGNoTGFuZ3VhZ2UiLCJsYW5ndWFnZSIsImN1cnJlbnRVcmwiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsImhyZWYiLCJyZXBsYWNlIl0sInNvdXJjZVJvb3QiOiIifQ==