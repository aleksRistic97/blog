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
window.addComment = addComment;

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_string_replace_js"], () => (__webpack_exec__("./assets/js/update.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoidXBkYXRlLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7QUFDQSxTQUFTQSxhQUFhQSxDQUFBLEVBQ3RCO0VBRUksSUFBSUMsZ0JBQWdCLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLHFCQUFxQixDQUFDO0VBRXJFLElBQUlDLFNBQVMsR0FBR0gsZ0JBQWdCLENBQUNJLFlBQVksQ0FBQyxnQkFBZ0IsQ0FBQztFQUUvRCxJQUFJQyxLQUFLLEdBQUdMLGdCQUFnQixDQUFDTSxnQkFBZ0IsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDQyxNQUFNO0VBRTFFLElBQUlDLE9BQU8sR0FBR0wsU0FBUyxDQUFDTSxPQUFPLENBQUMsV0FBVyxFQUFFSixLQUFLLENBQUM7RUFFbkQsSUFBSUssVUFBVSxHQUFHVCxRQUFRLENBQUNVLGFBQWEsQ0FBQyxLQUFLLENBQUM7RUFDOUNELFVBQVUsQ0FBQ0UsU0FBUyxDQUFDQyxHQUFHLENBQUMsaUJBQWlCLENBQUM7RUFDM0NILFVBQVUsQ0FBQ0ksU0FBUyxHQUFHTixPQUFPO0VBRzlCRSxVQUFVLENBQUNJLFNBQVMsSUFBSSxzRkFBc0Y7RUFDOUdkLGdCQUFnQixDQUFDZSxXQUFXLENBQUNMLFVBQVUsQ0FBQztBQUM1QztBQUdBLFNBQVNNLGdCQUFnQkEsQ0FBQ0MsTUFBTSxFQUNoQztFQUVJLElBQUlDLGFBQWEsR0FBR0QsTUFBTSxDQUFDRSxhQUFhO0VBQ3hDRCxhQUFhLENBQUNFLE1BQU0sQ0FBQyxDQUFDO0FBRTFCO0FBSUFDLE1BQU0sQ0FBQ3RCLGFBQWEsR0FBR0EsYUFBYTtBQUNwQ3NCLE1BQU0sQ0FBQ0wsZ0JBQWdCLEdBQUdBLGdCQUFnQjtBQUMxQ0ssTUFBTSxDQUFDQyxVQUFVLEdBQUVBLFVBQVUiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvdXBkYXRlLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIlxuZnVuY3Rpb24gYWRkQXR0YWNobWVudCgpXG57XG4gICAgICAgICAgICBcbiAgICB2YXIgY29sbGVjdGlvbkhvbGRlciA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdhdHRhY2htZW50cy13cmFwcGVyJyk7XG5cbiAgICB2YXIgcHJvdG90eXBlID0gY29sbGVjdGlvbkhvbGRlci5nZXRBdHRyaWJ1dGUoJ2RhdGEtcHJvdG90eXBlJyk7XG5cbiAgICB2YXIgaW5kZXggPSBjb2xsZWN0aW9uSG9sZGVyLnF1ZXJ5U2VsZWN0b3JBbGwoJ2lucHV0W3R5cGU9XCJmaWxlXCJdJykubGVuZ3RoO1xuXG4gICAgdmFyIG5ld0Zvcm0gPSBwcm90b3R5cGUucmVwbGFjZSgvX19uYW1lX18vZywgaW5kZXgpO1xuXG4gICAgdmFyIG5ld0Zvcm1EaXYgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKTtcbiAgICBuZXdGb3JtRGl2LmNsYXNzTGlzdC5hZGQoJ2F0dGFjaG1lbnQtaXRlbScpOyBcbiAgICBuZXdGb3JtRGl2LmlubmVySFRNTCA9IG5ld0Zvcm07XG5cbiBcbiAgICBuZXdGb3JtRGl2LmlubmVySFRNTCArPSAnPGJ1dHRvbiB0eXBlPVwiYnV0dG9uXCIgaWQ9XCJzcGVjaWFsX3N0eWxlXCIgb25jbGljaz1cInJlbW92ZUF0dGFjaG1lbnQodGhpcylcIj5YPC9idXR0b24+JztcbiAgICBjb2xsZWN0aW9uSG9sZGVyLmFwcGVuZENoaWxkKG5ld0Zvcm1EaXYpO1xufVxuXG5cbmZ1bmN0aW9uIHJlbW92ZUF0dGFjaG1lbnQoYnV0dG9uKVxue1xuXG4gICAgdmFyIGF0dGFjaG1lbnREaXYgPSBidXR0b24ucGFyZW50RWxlbWVudDsgXG4gICAgYXR0YWNobWVudERpdi5yZW1vdmUoKTtcblxufVxuXG5cblxud2luZG93LmFkZEF0dGFjaG1lbnQgPSBhZGRBdHRhY2htZW50O1xud2luZG93LnJlbW92ZUF0dGFjaG1lbnQgPSByZW1vdmVBdHRhY2htZW50O1xud2luZG93LmFkZENvbW1lbnQ9IGFkZENvbW1lbnQ7Il0sIm5hbWVzIjpbImFkZEF0dGFjaG1lbnQiLCJjb2xsZWN0aW9uSG9sZGVyIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsInByb3RvdHlwZSIsImdldEF0dHJpYnV0ZSIsImluZGV4IiwicXVlcnlTZWxlY3RvckFsbCIsImxlbmd0aCIsIm5ld0Zvcm0iLCJyZXBsYWNlIiwibmV3Rm9ybURpdiIsImNyZWF0ZUVsZW1lbnQiLCJjbGFzc0xpc3QiLCJhZGQiLCJpbm5lckhUTUwiLCJhcHBlbmRDaGlsZCIsInJlbW92ZUF0dGFjaG1lbnQiLCJidXR0b24iLCJhdHRhY2htZW50RGl2IiwicGFyZW50RWxlbWVudCIsInJlbW92ZSIsIndpbmRvdyIsImFkZENvbW1lbnQiXSwic291cmNlUm9vdCI6IiJ9