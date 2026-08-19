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



// $('.date-picker').datepicker({
//     format: 'dd/mm/yyyy',
//     //startDate: '-3d'
//     autoclose: true
// });
// $(function() {
//     $(".date-picker").datepicker();
// });

// $(function () {
//   $(".datepicker").datepicker({ 
//         format: 'dd/mm/yyyy',
//         autoclose: true, 
//         todayHighlight: true
//   }).datepicker('update', new Date());
// });

// $(document).on('change','#cp_one_dob',function(){
//     var cp_one_age = $('#cp_one_age').val();
//     if(cp_one_age >= 18){
//       $('.cp_one_transfer').html("Adult Transfer Details <sup style='color: #FF0000'>*</sup>");
//       $('.cp_one_minor_sent').html("Adult Sent to <sup style='color: #FF0000'>*</sup>");
//     }else{
//       $('.cp_one_transfer').html("Minor Transfer Details <sup style='color: #FF0000'>*</sup>");
//       $('.cp_one_minor_sent').html("Minor Sent to <sup style='color: #FF0000'>*</sup>");
//     }
// });

// $(document).on('change','#cp_two_dob',function(){
//     var cp_two_age = $('#cp_two_age').val();
//     if(cp_two_age >= 18){
//       $('.cp_two_transfer').html("Adult Transfer Details <sup style='color: #FF0000'>*</sup>");
//       $('.cp_two_minor_sent').html("Adult Sent to <sup style='color: #FF0000'>*</sup>");
//     }else{
//       $('.cp_two_transfer').html("Minor Transfer Details <sup style='color: #FF0000'>*</sup>");
//       $('.cp_two_minor_sent').html("Minor Sent to <sup style='color: #FF0000'>*</sup>");
//     }
// });

// CP One Age Validation
$(function() 
{
    $("#cp_one_dob,#incident_date").datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'dd/mm/yyyy',
    }).on('change', function () {

        $("#cp_one_age_error").text("");
        var incident_date = $("input[name='incident_date']").datepicker('getDate');
        var dob = $('#cp_one_dob').datepicker('getDate');
        if(incident_date)
        {
            if(dob)
            {
                var v=incident_date-dob;
                if(v>=0)
                {
                    var w=Math.floor(v/86400000);
                    var age=yearMethod(w);
                    // alert(incident_date);
                    $('#cp_one_age').val(age);
                }
                else
                {
                    $("#cp_one_age_error").text("Date Of Birth Should Be Less Then Intervention Date!");
                    $('#cp_one_age').val('');
                }
            }
        }
        else
        {
            // alert("Please enter intervention date");
            $("#cp_one_age_error").text("Please Enter Intervention Date!");
        }
    });
    function yearMethod(x) {
      var y = 365;
      var y2 = 31;
      var remainder = x % y;
      var casio = remainder % y2;
      year = (x - remainder) / y;
      return(year);
    }
});
// CP Two Age Validatin
// $(function() 
// {
//     $("#cp_two_dob").datepicker({
//         autoclose: true,
//         todayHighlight: true,
//         dateFormat: 'dd/mm/yyyy',
//     }).on('change', function () {

//         var v=new Date()-$('#cp_two_dob').datepicker('getDate');
//         var w=Math.floor(v/86400000);
//         var age=yearMethod(w);
//         $('#cp_two_age').val(age);
//     });
//     function yearMethod(x) {
//       var y = 365;
//       var y2 = 31;
//       var remainder = x % y;
//       var casio = remainder % y2;
//       year = (x - remainder) / y;
//       return(year);
//     }
// });
$(function() 
{
    $("#cp_two_dob,#incident_date").datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'dd/mm/yyyy',
    }).on('change', function () {

        $("#cp_two_age_error").text("");
        var incident_date = $("input[name='incident_date']").datepicker('getDate');
        var dob = $('#cp_two_dob').datepicker('getDate');
        if(incident_date)
        {
            if(dob)
            {
                var v=incident_date-dob;
                if(v>=0)
                {
                    var w=Math.floor(v/86400000);
                    var age=yearMethod(w);
                    // alert(incident_date);
                    $('#cp_two_age').val(age);
                }
                else
                {   
                    $("#cp_two_age_error").text("Date Of Birth Should Be Less Then Intervention Date!");
                    $('#cp_two_age').val('');
                }
            }
        }
        else
        {
            // alert("Please enter intervention date");
            $("#cp_two_age_error").text("Please Enter Intervention Date!");
        }
    });
    function yearMethod(x) {
      var y = 365;
      var y2 = 31;
      var remainder = x % y;
      var casio = remainder % y2;
      year = (x - remainder) / y;
      return(year);
    }
});

var contracting_party_one_age = $('#cp_one_age').val();
var cp_one_cwc_minor_sent_to = $('input[name="cp_one_cwc_minor_sent_to"]:checked').val();
if(contracting_party_one_age >= 18){
    cp_one_cwc_minor_sent_to.disabled = true;
}
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