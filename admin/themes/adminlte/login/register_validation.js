// Username Validation
$(document).on('change','#designation, #district, #block',function(){
   var district_id = $('#district').val();
   var designation_id = $('#designation').val();
   var block_id = $('#block').val();
   if(designation_id !='' && district_id !='' && block_id !=''){
       var district = $('#district option:selected').text();
       var designation = $('#designation option:selected').text();
       var block = $('#block option:selected').text();
       var username = designation+' '+district+' '+block;
       var newUsername = username.replace(/[().]/gi, '').replace(/[-]/gi, '_').replace(/[_\s]/g, '_').toUpperCase();
       $('#username').val(newUsername);
   }else{
       $('#username').val('');
   }
});
// Password Check Validation
function checkPassword(password){
  var desc = new Array();
  desc[0] = "Your password strength is very weak";
  desc[1] = "Your password strength is weak";
  desc[2] = "Your password strength is better";
  desc[3] = "Your password strength is medium";
  desc[4] = "Your password strength is strong";
  desc[5] = "Your password strength is strongest";
  var score   = 0;
  //if password bigger than 6 give 1 point
  if (password.length >= 8){
    $("#mincheckright").hide('slow');
    $("#mincheckwrong").show('slow');

  }else{
    $("#mincheckright").show('slow');
    $("#mincheckwrong").hide('slow');
  }
  //if password has both lower and uppercase characters give 1 point  
  if((password.match(/[A-Z]/))){
    score ++;
    $("#uppercheckright").hide('slow');
    $("#uppercheckwrong").show('slow');
  }else{
    $("#uppercheckright").show('slow');
    $("#uppercheckwrong").hide('slow');
  }
  if((password.match(/[a-z]/))) {
    score ++;
    $("#lowercheckright").hide('slow');
    $("#lowercheckwrong").show('slow');
  }else{
    $("#lowercheckright").show('slow');
    $("#lowercheckwrong").hide('slow');
  }
  //if password has at least one number give 1 point
  if(password.match(/\d+/)){
    score ++;
    $("#digitcheckright").hide('slow');
    $("#digitcheckwrong").show('slow');
  }else{
    $("#digitcheckright").show('slow');
    $("#digitcheckwrong").hide('slow');
  }
  //if password has at least one special caracther give 1 point
  if(password.match(/.[!,@,#,$,%,&,*,?,_]/)){
    score ++;
    $("#specialcheckright").hide('slow');
    $("#specialcheckwrong").show('slow');
  }else{
    $("#specialcheckright").show('slow');
    $("#specialcheckwrong").hide('slow');
  }

  //if password bigger than 14 give another 1 point
  if (password.length > 14){
    score++;
  }

  document.getElementById("passwordStrength").innerHTML = desc[score];
  document.getElementById("passwordStrength").className = "strength" + score;
  document.pass.scores.value=score;
}
// Password Show
// $(document).on('click', '#password_eye', function() {
//     var x = document.getElementById("password");
//     changeView(this, x);
// })

// $(document).on('click', '#retype_password_eye', function() {
//     var x = document.getElementById("retype_password");
//     changeView(this, x);
// })
// function changeView(ele, x) {
//    if (x.type === "password") {
//       x.type = "text";
//       $(ele).find("i").removeClass('fa-eye-slash').addClass('fa-eye');
//    } else {
//       x.type = "password";
//       $(ele).find("i").removeClass('fa-eye').addClass('fa-eye-slash');
//    }
//  }

$(document).on('keypress', '#first_name', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$(document).on('keypress', '#last_name', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$('body').on('keyup', '.js-input-mobile', function () {
    var $input = $(this),
        value = $input.val(),
        length = value.length,
        inputCharacter = parseInt(value.slice(-1));

    if (!((length > 0 && inputCharacter >= 0 && inputCharacter <= 10) || (length === 1 && inputCharacter >= 7 && inputCharacter <= 10))) {
        $input.val(value.substring(0, length - 1));
     }
});
