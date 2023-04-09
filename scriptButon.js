/*
// To debug code using alert function
$(document).ready(function() {
  $('.change-btn').click(function() {
    var td = $(this).closest('tr').find('.hobby');
    td.load("updateHobby.php", function() {
      alert("Hello");
    });
  });
});
*/

//Update hobby on button click
$(document).ready(function() {
  $('.change-btn').click(function() {
    var td = $(this).closest('tr').find('.hobby');
    td.load("updateHobby.php");
  });
});