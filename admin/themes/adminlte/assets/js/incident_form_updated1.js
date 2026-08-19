// $(document).ready(function(e) {

// 	$('body').bind('cut copy paste',function(e){
// 		e.preventDefault();
// 	});
// });


$("kp_club_form_entry").submit(function(e) {

// Disabling cut copy and paste across complete page



var dob = $("#datepicker_dob_applicant").val();

var from_date = $(".from_date").html();
var to_date = $(".to_date").html();

from_date = from_date.substr(6);
to_date = to_date.substr(6);
dob = dob.substr(6);

if((dob < from_date || dob > to_date))
{
    $("#datepicker_dob_applicant_msg").html("Invalid Date of Birth Range");
    $("#datepicker_dob_applicant_msg").show();
    return false;
}
else
{
    $("#datepicker_dob_applicant_msg").hide();
}

});

$(function() 
{
    $("#incident_date,#marriage_date").datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'dd/mm/yyyy',
    }).on('change', function () {

        var dob_one = $('#cp_one_dob').datepicker('getDate');
        var dob_two = $('#cp_two_dob').datepicker('getDate');
        if(dob_one)
        {
            calculate_cp_one_age();
        }
        if( dob_two)
        {
            calculate_cp_two_age();
        }
    });

    $("#cp_one_dob").datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'dd/mm/yyyy',
    }).on('change', function () {
        calculate_cp_one_age();
    });
    $("#cp_two_dob").datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'dd/mm/yyyy',
    }).on('change', function () {
        calculate_cp_two_age();
    });
    $(document).on('change','.marriage_details_check',function(){
        var marriage_details=$(this).val();
        $('#cp_one_age').val('');
        $("#cp_one_age_error").text("");
        $('#cp_two_age').val('');
        $("#cp_two_age_error").text("");
        // alert(1213131);  
        if (marriage_details == 3) {
            $('input[name="prevented_details"][value="1"]').prop('disabled', true);
            $('input[name="prevented_details"][value="2"]').prop('checked', true);
        } else {
            $('input[name="prevented_details"]').prop('disabled', false);
        }

        var dob_one = $('#cp_one_dob').datepicker('getDate');
        var dob_two = $('#cp_two_dob').datepicker('getDate');
        if(dob_one)
        {
            calculate_cp_one_age();
        }
        if( dob_two)
        {
            calculate_cp_two_age();
        }
    });
    
});

function calculate_cp_one_age()
{
    $("#cp_one_age_error").text("");
    var marriage_details = $("input[name='marriage_details']:checked").val();
    var dob = $('#cp_one_dob').datepicker('getDate');
    var cp_age_new = calculate_age(dob);   
    if(cp_age_new==0)
    {
        $('#cp_one_age').val('');
        if(marriage_details==3)
        {
            $("#cp_one_age_error").text("Date Of Birth Should Be Less Then Marriage Date to calculate age");
        }
        else
        {
            $("#cp_one_age_error").text("Date Of Birth Should Be Less Then Intervention Date!");
        }
    }
    else if(cp_age_new==-2)
    {
        if(marriage_details==3)
        {
            $("#cp_one_age_error").text("Please provide Marriage date and date of birth");
        }
        else
        {
            $("#cp_one_age_error").text("Please provide Intervention date and date of birth to calculate age");
        }
        $('#cp_one_age').val('');
    }
    else if(cp_age_new==-1)
    {
        $('#cp_one_dob').val('');
        $("#cp_one_age_error").text("please enter marriage details to calculate age!");
    }
    else
    {
        $('#cp_one_age').val(cp_age_new);  
    }
}

function calculate_cp_two_age()
{
    $("#cp_two_age_error").text("");
    var marriage_details = $("input[name='marriage_details']:checked").val();
    var dob = $('#cp_two_dob').datepicker('getDate');
    var cp_age_new = calculate_age(dob);  
    if(cp_age_new==0)
    {
        $('#cp_two_age').val('');
        if(marriage_details==3)
        {
            $("#cp_two_age_error").text("Date Of Birth Should Be Less Then Marriage Date to calculate age");
        }
        else
        {
            $("#cp_two_age_error").text("Date Of Birth Should Be Less Then Intervention Date!");
        }
    }
    else if(cp_age_new==-2)
    {
        if(marriage_details==3)
        {
            $("#cp_two_age_error").text("Please provide Marriage date and date of birth");
        }
        else
        {
            $("#cp_two_age_error").text("Please provide Intervention date and date of birth to calculate age");
        }
        $('#cp_two_age').val('');
    }
    else if(cp_age_new==-1)
    {
        $('#cp_two_dob').val('');
        $("#cp_two_age_error").text("please enter marriage details to calculate age");
    }
    else
    {
        $('#cp_two_age').val(cp_age_new);  
    }
}

function yearMethod(x) 
{
    var y = 365;
    var y2 = 31;
    var remainder = x % y;
    var casio = remainder % y2;
    year = (x - remainder) / y;
    return(year);
}
function calculate_age(dob)
{
    var incident_date = $("input[name='incident_date']").datepicker('getDate');
    var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
    var marriage_details = $("input[name='marriage_details']:checked").val();

    if(typeof marriage_details == 'undefined')
    {
        return -1;
    }
    else if(marriage_details ==1 || marriage_details==2)
    {
        if(incident_date && dob)
        {
            var v=incident_date-dob;
            if(v>=0)
            {
                var w=Math.floor(v/86400000);
                var age=yearMethod(w);
                return age;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return -2;
        }
    }
    else if(marriage_details ==3)
    {
        if(marriage_date && dob)
        {
            var v=marriage_date-dob;
            if(v>=0)
            {
                var w=Math.floor(v/86400000);
                var age=yearMethod(w);
                return age;
            }
            else
            {
                return 0;
            }

        }
        else
        {
            return -2;
        }
    }
}




// CP Two Age Validation



// var contracting_party_one_age = $('#cp_one_age').val();
// var cp_one_cwc_minor_sent_to = $('input[name="cp_one_cwc_minor_sent_to"]:checked').val();
// if(contracting_party_one_age >= 18){
//     cp_one_cwc_minor_sent_to.disabled = true;
// }
// Tarnsfer Details Check
$(document).ready(function(){
    var cp_one_age = $('#cp_one_age').val();
    var cp_two_age = $('#cp_two_age').val();
    $('body').on('change','#cp_one_dob, #cp_two_dob',function(){
        var cp_one_age = $('#cp_one_age').val();
        var cp_two_age = $('#cp_two_age').val();
        if(cp_one_age >= 18 && cp_two_age >= 18){
            $('input[name=cp_two_cwc_minor_sent_to]:last').attr("disabled", true);
            $('input[name=cp_one_cwc_minor_sent_to]:last').attr("disabled", true);
        } else if (cp_one_age >= 18) {
            $('input[name=cp_one_cwc_minor_sent_to]:last').attr("disabled", true);
            $('input[name=cp_two_cwc_minor_sent_to]:last').attr("disabled", false);
        } else if (cp_two_age >= 18) {
            $('input[name=cp_two_cwc_minor_sent_to]:last').attr("disabled", true);
            $('input[name=cp_one_cwc_minor_sent_to]:last').attr("disabled", false);
        }else{
            $('input[name=cp_two_cwc_minor_sent_to]:last').attr("disabled", false);
            $('input[name=cp_one_cwc_minor_sent_to]:last').attr("disabled", false);
        }
    });
    if(cp_one_age >= 18 && cp_two_age >= 18){
            $('input[name=cp_two_cwc_minor_sent_to]:last').attr("disabled", true);
            $('input[name=cp_one_cwc_minor_sent_to]:last').attr("disabled", true);
        } else if (cp_one_age >= 18) {
            $('input[name=cp_one_cwc_minor_sent_to]:last').attr("disabled", true);
            $('input[name=cp_two_cwc_minor_sent_to]:last').attr("disabled", false);
        } else if (cp_two_age >= 18) {
            $('input[name=cp_two_cwc_minor_sent_to]:last').attr("disabled", true);
            $('input[name=cp_one_cwc_minor_sent_to]:last').attr("disabled", false);
        }else{
            $('input[name=cp_two_cwc_minor_sent_to]:last').attr("disabled", false);
            $('input[name=cp_one_cwc_minor_sent_to]:last').attr("disabled", false);
        }
});


$(document).ready(function(e) {

 var marriage_details1 = $("input[name='marriage_details']:checked").val();
if(marriage_details1 == 3)
{
  $('#font-str').css("display", "block");
  $('#trash').prop('disabled', true);

}
else
{
  $('#font-str').css("display", "none");
  $('#trash').prop('disabled', false);

}
});


$("input[name='marriage_details']").change(function(){
var marriage_details1 = $("input[name='marriage_details']:checked").val();


if(marriage_details1 == 3)
{
  $('#font-str').css("display", "block");
  $('#trash').prop('disabled', true);

}
else
{
    $('#font-str').css("display", "none");
  $('#trash').prop('disabled', false);

}
});





$(document).ready(function() {
    var marriage_date = $('input[name="marriage_date"]').val();
    if(marriage_date != '')
    {
       $('#trash').prop('disabled', false);
    }
    else
    {
      $('#trash').prop('disabled', true);
    }

    

});

function clear_marriage_date (){
    var marriage_date = $('input[name="marriage_date"]').val();

    if(marriage_date != '')
    {
      $('input[name="marriage_date"]').val('');
       $('#trash').prop('disabled', true);
    }
    else
    {
      $('#trash').prop('disabled', false);
    }
}

function hide_trash_button(marriage_date)
{

  var marriage_details_val = $("input[name='marriage_details']:checked").val();
  if(marriage_details_val == 3)
  {
      $('#trash').prop('disabled', true);
  }
  else
  {
      $('#trash').prop('disabled', false);
  }

}



