document.addEventListener('DOMContentLoaded', function () {
  // Your code here
function startDictation() {
    if (window.hasOwnProperty('webkitSpeechRecognition')) {
      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;
      recognition.lang = 'en-US';
      recognition.start();

      recognition.onresult = function (e) {
        document.getElementById('transcript').value = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('formSubmit').submit();
      };
      recognition.onerror = function (e) {
        recognition.stop();
      };
    }
  }
//   function startDictation() {
//     if (window.hasOwnProperty('webkitSpeechRecognition')) {
//       const recognition = new webkitSpeechRecognition();
//       const myForm = document.getElementById('myForm');
//       recognition.continuous = false;
//       recognition.interimResults = false;

//       recognition.lang = 'en-US';
//       recognition.start();

//       recognition.onresult = function(e) {
//         document.getElementById('transcript').value = e.results[0][0].transcript;
//         recognition.stop();
//         if(myForm){
//           document.forms[0].submit();        }
//       };

//       recognition.onerror = function(e) {
//         recognition.stop();
//       }
//     }
//   }
});
