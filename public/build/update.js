(self["webpackChunk"] = self["webpackChunk"] || []).push([["update"],{

/***/ "./assets/js/update.js":
/*!*****************************!*\
  !*** ./assets/js/update.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
function addAttachment() {
  var collectionHolder = document.getElementById('attachments-wrapper');
  var prototype = collectionHolder.getAttribute('data-prototype');
  var index = collectionHolder.querySelectorAll('input[type="file"]').length;
  var newForm = prototype.replace(/__name__/g, index);
  var newFormDiv = document.createElement('div');
  newFormDiv.classList.add('attachment-item');
  newFormDiv.innerHTML = newForm;
  newFormDiv.innerHTML += '<button type="button" id="special_style" onclick="removeAttachment(this)">X</button>';
  collectionHolder.appendChild(newFormDiv);
}
function removeAttachment(button) {
  var attachmentDiv = button.parentElement;
  attachmentDiv.remove();
}
window.addAttachment = addAttachment;
window.removeAttachment = removeAttachment;

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_string_replace_js"], () => (__webpack_exec__("./assets/js/update.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoidXBkYXRlLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7QUFBQSxTQUFTQSxhQUFhQSxDQUFBLEVBQUU7RUFFcEIsSUFBSUMsZ0JBQWdCLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLHFCQUFxQixDQUFDO0VBRXJFLElBQUlDLFNBQVMsR0FBR0gsZ0JBQWdCLENBQUNJLFlBQVksQ0FBQyxnQkFBZ0IsQ0FBQztFQUUvRCxJQUFJQyxLQUFLLEdBQUdMLGdCQUFnQixDQUFDTSxnQkFBZ0IsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDQyxNQUFNO0VBRTFFLElBQUlDLE9BQU8sR0FBR0wsU0FBUyxDQUFDTSxPQUFPLENBQUMsV0FBVyxFQUFFSixLQUFLLENBQUM7RUFFbkQsSUFBSUssVUFBVSxHQUFHVCxRQUFRLENBQUNVLGFBQWEsQ0FBQyxLQUFLLENBQUM7RUFDOUNELFVBQVUsQ0FBQ0UsU0FBUyxDQUFDQyxHQUFHLENBQUMsaUJBQWlCLENBQUM7RUFDM0NILFVBQVUsQ0FBQ0ksU0FBUyxHQUFHTixPQUFPO0VBRzlCRSxVQUFVLENBQUNJLFNBQVMsSUFBSSxzRkFBc0Y7RUFDOUdkLGdCQUFnQixDQUFDZSxXQUFXLENBQUNMLFVBQVUsQ0FBQztBQUM1QztBQUdBLFNBQVNNLGdCQUFnQkEsQ0FBQ0MsTUFBTSxFQUFFO0VBQzlCLElBQUlDLGFBQWEsR0FBR0QsTUFBTSxDQUFDRSxhQUFhO0VBQ3hDRCxhQUFhLENBQUNFLE1BQU0sQ0FBQyxDQUFDO0FBQzFCO0FBRUFDLE1BQU0sQ0FBQ3RCLGFBQWEsR0FBR0EsYUFBYTtBQUNwQ3NCLE1BQU0sQ0FBQ0wsZ0JBQWdCLEdBQUdBLGdCQUFnQiIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9qcy91cGRhdGUuanMiXSwic291cmNlc0NvbnRlbnQiOlsiZnVuY3Rpb24gYWRkQXR0YWNobWVudCgpe1xyXG4gICAgICAgICAgICBcclxuICAgIHZhciBjb2xsZWN0aW9uSG9sZGVyID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2F0dGFjaG1lbnRzLXdyYXBwZXInKTtcclxuXHJcbiAgICB2YXIgcHJvdG90eXBlID0gY29sbGVjdGlvbkhvbGRlci5nZXRBdHRyaWJ1dGUoJ2RhdGEtcHJvdG90eXBlJyk7XHJcblxyXG4gICAgdmFyIGluZGV4ID0gY29sbGVjdGlvbkhvbGRlci5xdWVyeVNlbGVjdG9yQWxsKCdpbnB1dFt0eXBlPVwiZmlsZVwiXScpLmxlbmd0aDtcclxuXHJcbiAgICB2YXIgbmV3Rm9ybSA9IHByb3RvdHlwZS5yZXBsYWNlKC9fX25hbWVfXy9nLCBpbmRleCk7XHJcblxyXG4gICAgdmFyIG5ld0Zvcm1EaXYgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKTtcclxuICAgIG5ld0Zvcm1EaXYuY2xhc3NMaXN0LmFkZCgnYXR0YWNobWVudC1pdGVtJyk7IFxyXG4gICAgbmV3Rm9ybURpdi5pbm5lckhUTUwgPSBuZXdGb3JtO1xyXG5cclxuIFxyXG4gICAgbmV3Rm9ybURpdi5pbm5lckhUTUwgKz0gJzxidXR0b24gdHlwZT1cImJ1dHRvblwiIGlkPVwic3BlY2lhbF9zdHlsZVwiIG9uY2xpY2s9XCJyZW1vdmVBdHRhY2htZW50KHRoaXMpXCI+WDwvYnV0dG9uPic7XHJcbiAgICBjb2xsZWN0aW9uSG9sZGVyLmFwcGVuZENoaWxkKG5ld0Zvcm1EaXYpO1xyXG59XHJcblxyXG5cclxuZnVuY3Rpb24gcmVtb3ZlQXR0YWNobWVudChidXR0b24pIHtcclxuICAgIHZhciBhdHRhY2htZW50RGl2ID0gYnV0dG9uLnBhcmVudEVsZW1lbnQ7IFxyXG4gICAgYXR0YWNobWVudERpdi5yZW1vdmUoKTsgXHJcbn1cclxuXHJcbndpbmRvdy5hZGRBdHRhY2htZW50ID0gYWRkQXR0YWNobWVudDtcclxud2luZG93LnJlbW92ZUF0dGFjaG1lbnQgPSByZW1vdmVBdHRhY2htZW50OyJdLCJuYW1lcyI6WyJhZGRBdHRhY2htZW50IiwiY29sbGVjdGlvbkhvbGRlciIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJwcm90b3R5cGUiLCJnZXRBdHRyaWJ1dGUiLCJpbmRleCIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJsZW5ndGgiLCJuZXdGb3JtIiwicmVwbGFjZSIsIm5ld0Zvcm1EaXYiLCJjcmVhdGVFbGVtZW50IiwiY2xhc3NMaXN0IiwiYWRkIiwiaW5uZXJIVE1MIiwiYXBwZW5kQ2hpbGQiLCJyZW1vdmVBdHRhY2htZW50IiwiYnV0dG9uIiwiYXR0YWNobWVudERpdiIsInBhcmVudEVsZW1lbnQiLCJyZW1vdmUiLCJ3aW5kb3ciXSwic291cmNlUm9vdCI6IiJ9