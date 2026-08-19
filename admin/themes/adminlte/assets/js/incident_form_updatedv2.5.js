// $(document).ready(function(e) {

// 	$('body').bind('cut copy paste',function(e){
// 		e.preventDefault();
// 	});
// });


// $("kp_club_form_entry").submit(function(e) {

// // Disabling cut copy and paste across complete page



// var dob = $("#datepicker_dob_applicant").val();

// var from_date = $(".from_date").html();
// var to_date = $(".to_date").html();

// from_date = from_date.substr(6);
// to_date = to_date.substr(6);
// dob = dob.substr(6);

// if((dob < from_date || dob > to_date))
// {
//     $("#datepicker_dob_applicant_msg").html("Invalid Date of Birth Range");
//     $("#datepicker_dob_applicant_msg").show();
//     return false;
// }
// else
// {
//     $("#datepicker_dob_applicant_msg").hide();
// }

// });




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
            // $("#cp_one_age_error").text("Please provide Intervention date and date of birth to calculate age");
            $("#cp_one_age_error").text("Please enter intervention date, and marriage date (if applicable) to calculate age");
        }
        $('#cp_one_age').val('');
    }
    else if(cp_age_new==-1)
    {
        $('#cp_one_age').val('');
        $("#cp_one_age_error").text("Please enter intervention date, and marriage date (if applicable) to calculate age");
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
//calculate age

function cal_age(inc_mar_date = null,dob=null) 
{
    // alert('hii');
    // if(incident_date < dob)
    // {
    //     console.log('dob should be less than incident');
    // }
    var ageDate = new Date(inc_mar_date - dob);
    var newAge = Math.abs(ageDate.getUTCFullYear() - 1970);

    var months = ageDate.getUTCMonth();
    var days = ageDate.getUTCDate() - 1;

    // console.log(inc_mar_date+"--------------------"+dob);
    // console.log(ageDate+"--------------------"+newAge);
    // console.log(newAge+"years "+months+"month "+days+" days");

    return newAge;

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
                // var w=Math.floor(v/86400000);
                // var age=yearMethod(w);
                var age=cal_age(incident_date,dob);

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
                // var w=Math.floor(v/86400000);
                // var age=yearMethod(w);
                var age=cal_age(marriage_date,dob);
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




$("input[name='prevented_details']").change(function()
{
    var prevented_details = $("input[name='prevented_details']:checked").val();
    control_trash_str(prevented_details);
});
function yearMethod(x) 
{
    var y = 365;
    var y2 = 31;
    var remainder = x % y;
    var casio = remainder % y2;
    year = (x - remainder) / y;
    return(year);
}


function control_trash_str(prevented_details = null)
{
    $('#font-str').css("display", "none");
    $('#trash').prop('disabled', false);
    if(prevented_details == 2)
    {
        $('#font-str').css("display", "block");
        $('#trash').prop('disabled', true);
    }
}


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


function check_marriage_incident_date()
{
    //alert("hello_old");
    $('#incident_date_error').html('');
    var incident_date = $("input[name='incident_date']").datepicker('getDate');
    var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
    var marriage_details = $("input[name='marriage_details']:checked").val();

    if(typeof marriage_details != 'undefined' && incident_date && marriage_date)
    {
        //alert("0");
        incident_date = incident_date.getTime();
        marriage_date = marriage_date.getTime();
        if(marriage_details ==1)
        {
            //alert("1");

            if(marriage_date <= incident_date)
            {
                //alert("2");
                var int_date = $("input[name='incident_date']").datepicker('getDate');
                var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
                var int_date = formatDate(int_date);
                var mag_date = formatDate(marriage_date);
                var msg = "You have marked the intervention as <b>“Before Marriage”</b>, so the intervention date should be before the marriage date. <br>";
                var msg_date = "You had entered <b>intervention date</b> as <b>"+int_date+"</b> and <b>marriage date</b> as <b>"+mag_date+"</b>. Please correct";
                // alert('marriage date should be > Intervention Date');

                 $('#incident_date_error').html(msg+msg_date); 
                $("input[name='incident_date']").val('');
                $("input[name='marriage_date']").val('');

                // $("input[name='marriage_details']:checked").prop('checked', false);
                $('#cp_one_age').val('')
                $('#cp_two_age').val('')
                // event.preventDefault();
                // $("#cp_two_age_error").text("Please provide Marriage date and date of birth");
            }
        }
        else if(marriage_details == 2)
        {
            if(incident_date != marriage_date)
            {
                // alert(marriage_date.getTime()+"---------------"+incident_date.getTime());
                // alert(marriage_date+"-"+incident_date);
                // alert('Then Marriage date must be = Intervention Date');
                var int_date = $("input[name='incident_date']").datepicker('getDate');
                var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
                var int_date = formatDate(int_date);
                var mag_date = formatDate(marriage_date);
                var msg = "You have marked the intervention as <b>“On The Day Of Marriage”</b>, so the intervention date must be the same as the marriage date. <br>";
                var msg_date = "You had entered <b>intervention date</b> as <b>"+int_date+"</b> and <b>marriage date</b> as <b>"+mag_date+"</b>. Please correct";

                
                $('#incident_date_error').html(msg+msg_date); 

                // $('#incident_date_error').html('Intervention Date and Marriage Date should be same date!');
                $("input[name='incident_date']").val('');
                $("input[name='marriage_date']").val('');
                // $("input[name='marriage_details']:checked").prop('checked', false);
                $('#cp_one_age').val('')
                $('#cp_two_age').val('')

            }
        }
        else if(marriage_details == 3)
        {
            if(marriage_date >= incident_date)
            {
                // alert('then Marriage date must be < Intervention Date');
                // alert(int_date);
                var int_date = $("input[name='incident_date']").datepicker('getDate');
                var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
                var int_date = formatDate(int_date);
                var mag_date = formatDate(marriage_date);
                var msg = "You have marked the intervention as <b>“Post Marriage”</b>,  so the Intervention date should be after the marriage date. <br>";
                var msg_date = "You had entered <b>intervention date</b> as <b>"+int_date+"</b> and <b>marriage date</b> as <b>"+mag_date+"</b>. Please correct";

                
                $('#incident_date_error').html(msg+msg_date);     
                $("input[name='incident_date']").val('');
                $("input[name='marriage_date']").val('');
                
                // $("input[name='marriage_details']:checked").prop('checked', false);
                $('#cp_one_age').val('')
                $('#cp_two_age').val('')

            }
        }
    }
}


function control_pre_notpre(marriage_details = null,not_control=0)
{
    control_trash_str();
    var prevented_details_val = $("input[name='prevented_details']:checked").val();
    $('input[name="prevented_details"][value="1"]').prop('disabled', false);
    $('input[name="prevented_details"][value="2"]').prop('disabled', false);
    $('input[name="prevented_details"][value="1"]').prop('checked', false);
    $('input[name="prevented_details"][value="2"]').prop('checked', false);

    if(marriage_details == 1)
    {
        // $('input[name="prevented_details"][value="2"]').prop('disabled', true);
        // $('input[name="prevented_details"][value="1"]').prop('checked', true);
        // var marriage_details = $("input[name='marriage_details']:checked").val();
        // $('input[name="marriage_details"][value="'+marriage_details_val+'"]').prop('checked', true);

        $('input[name="prevented_details"][value="'+prevented_details_val+'"]').prop('checked', true);
        
    }
    else if (marriage_details == 2 && not_control==1) 
    {
        if(prevented_details_val)
        {
            $('input[name="prevented_details"][value="'+prevented_details_val+'"]').prop('checked', true);
            if(prevented_details_val == 2)
            {
                control_trash_str(2);
            }
        }
    }
    else if (marriage_details == 3) 
    {
        $('input[name="prevented_details"][value="1"]').prop('disabled', true);
        $('input[name="prevented_details"][value="2"]').prop('checked', true);
        control_trash_str(2);
    }

}



$(document).ready(function(e) 
{
    var prevented_details = $("input[name='prevented_details']:checked").val();
    var marriage_details = $("input[name='marriage_details']:checked").val();
    control_pre_notpre(marriage_details,1);
    control_trash_str(prevented_details);

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
        if(dob_two)
        {
            calculate_cp_two_age();
        }

        check_marriage_incident_date();
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

         //
        control_pre_notpre(marriage_details);

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

        check_marriage_incident_date();
    });
});





    function mobile_no_validation(inputField) {
        let inputValue = inputField.value;

        // Clear any existing error messages
        // console.clear();

        if (inputValue.length === 0) {
            return; // No need to check if the input is empty
        }

        // Log ASCII values to the console
        for (let i = 0; i < inputValue.length; i++) {
            let char = inputValue.charAt(i);
            let asciiValue = char.charCodeAt(0);
            // console.log(`Character: ${char}, ASCII Value: ${asciiValue}`);

            if (i === 0 && (asciiValue < 54 || asciiValue > 57)) {
                // console.log("Invalid first digit. Must be between 6 and 9.");
                inputField.value = ''; // Clear the input field if the first digit is not between 6 and 9
                return;
            }

            if (i !== 0 && (asciiValue < 48 || asciiValue > 57)) {
                // console.log("Invalid non-first digit. Must be between 0 and 9.");
                inputField.value = ''; // Clear the input field if any non-first digit is not between 0 and 9
                return;
            }
        }

        // // Check if the total length is not 10
        // if (inputValue.length !== 10) {
        //     console.log("Invalid length. Must be 10 digits.");
        //     inputField.value = ''; // Clear the input field if the length is not 10
        //     return;
        // }
    }

    function formatDate(date = null)
    {
        if (date instanceof Date && !isNaN(date)) 
        {
        // Format the date as a string (adjust the options as needed)
        var formattedDate = date.toLocaleDateString('en-GB');
        return formattedDate;
        }
        return null;
    }


// ===============================CODE BY SOUMEN 17-12-2024===============================
//==========================CODE START BY SOUMEN 17/12/2024==============================

function calculate_cp_one_age_new() {
    $("#cp_one_age_error").text("");
    var marriage_details = $("input[name='marriage_details']:checked").val();
    var dob = $('#cp_one_dob').datepicker('getDate');
    var cp_age_new = calculate_age_new(dob);   

    if (cp_age_new === 0) { // Invalid age where DOB > target date
        $('#cp_one_age_months').val('');
        if (marriage_details == 3) {
            $("#cp_one_age_error").text("Date Of Birth Should Be Less Than Marriage Date to calculate age");
        } else {
            $("#cp_one_age_error").text("Date Of Birth Should Be Less Than Intervention Date!");
        }
    } 
    else if (cp_age_new === -2) { // Missing necessary input dates
        $('#cp_one_age_months').val('');
        if (marriage_details == 3) {
            $("#cp_one_age_error").text("Please provide Marriage date and Date of Birth");
        } else {
            $("#cp_one_age_error").text("Please enter intervention date, and marriage date (if applicable) to calculate age");
        }
    } 
    else if (cp_age_new === -1) { // Missing marriage details
        $('#cp_one_age_months').val('');
        $("#cp_one_age_error").text("Please enter intervention date, and marriage date (if applicable) to calculate age");
    } 
    else { 
        // If valid age is returned, format the age as Years, Months, Days
        var formattedAge = cp_age_new.years + " Years, " + cp_age_new.months + " Months, " + cp_age_new.days + " Days";
        $('#cp_one_age_months').val(formattedAge);  
    }
}


function calculate_cp_two_age_new() {
    $("#cp_two_age_error").text(""); // Clear previous error
    var marriage_details = $("input[name='marriage_details']:checked").val();
    var dob = $('#cp_two_dob').datepicker('getDate'); // Get date of birth
    var cp_age_new = calculate_age_new(dob); // Call calculate_age function

    if (cp_age_new === 0) { // Invalid: DOB > target date
        $('#cp_two_age_months').val('');
        if (marriage_details == 3) {
            $("#cp_two_age_error").text("Date Of Birth Should Be Less Than Marriage Date to calculate age");
        } else {
            $("#cp_two_age_error").text("Date Of Birth Should Be Less Than Intervention Date!");
        }
    } 
    else if (cp_age_new === -2) { // Missing input dates
        $('#cp_two_age_months').val('');
        if (marriage_details == 3) {
            $("#cp_two_age_error").text("Please provide Marriage Date and Date of Birth");
        } else {
            $("#cp_two_age_error").text("Please provide Intervention Date and Date of Birth to calculate age");
        }
    } 
    else if (cp_age_new === -1) { // Missing marriage details
        $('#cp_two_age_months').val('');
        $("#cp_two_age_error").text("Please enter marriage details to calculate age");
    } 
    else { 
        // Format the valid age result: "X Years, Y Months, Z Days"
        var formattedAge = cp_age_new.years + " Years, " + cp_age_new.months + " Months, " + cp_age_new.days + " Days";
        $('#cp_two_age_months').val(formattedAge);  
    }
}


function cal_age_new(target_date, dob) {
    if (!dob || !target_date) return -1; // Ensure both dates are provided

    var birthDate = new Date(dob);
    var endDate = new Date(target_date);

    if (birthDate > endDate) return 0; // Invalid date condition

    var years = endDate.getFullYear() - birthDate.getFullYear();
    var months = endDate.getMonth() - birthDate.getMonth();
    var days = endDate.getDate() - birthDate.getDate();

    // Adjust for negative days
    if (days < 0) {
        months--;
        var daysInPreviousMonth = new Date(endDate.getFullYear(), endDate.getMonth(), 0).getDate();
        days += daysInPreviousMonth;
    }

    // Adjust for negative months
    if (months < 0) {
        years--;
        months += 12;
    }

    return { years: years, months: months, days: days }; // Return detailed breakdown
}

function calculate_age_new(dob) {
    var incident_date = $("input[name='incident_date']").datepicker('getDate');
    var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
    var marriage_details = $("input[name='marriage_details']:checked").val();

    if (typeof marriage_details == 'undefined') {
        return -1;
    } else if (marriage_details == 1 || marriage_details == 2) {
        if (incident_date && dob) {
            var age = cal_age_new(incident_date, dob);
            return age;
        } else {
            return -2;
        }
    } else if (marriage_details == 3) {
        if (marriage_date && dob) {
            var age = cal_age_new(marriage_date, dob);
            return age;
        } else {
            return -2;
        }
    }
}

//==============================CODE END & START BY SOUMEN 17/12/2024==============================


$(document).ready(function(e) 
{
    var prevented_details = $("input[name='prevented_details']:checked").val();
    var marriage_details = $("input[name='marriage_details']:checked").val();
    control_pre_notpre_new(marriage_details,1);
    control_trash_str_new(prevented_details);

    $("#incident_date,#marriage_date").datepicker({
    autoclose: true,
    todayHighlight: true,
    dateFormat: 'dd/mm/yyyy',
    }).on('change', function () {

        var dob_one = $('#cp_one_dob').datepicker('getDate');
        var dob_two = $('#cp_two_dob').datepicker('getDate');
        if(dob_one)
        {
            calculate_cp_one_age_new();
        }
        if(dob_two)
        {
            calculate_cp_two_age_new();
        }

        check_marriage_incident_date_new();
    });

    $("#cp_one_dob").datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'dd/mm/yyyy',
    }).on('change', function () {
        calculate_cp_one_age_new();
    });
    $("#cp_two_dob").datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'dd/mm/yyyy',
    }).on('change', function () {
        calculate_cp_two_age_new();
    });
    $(document).on('change','.marriage_details_check',function(){
        var marriage_details=$(this).val();
        $('#cp_one_age_months').val('');
        $("#cp_one_age_error").text("");
        $('#cp_two_age_months').val('');
        $("#cp_two_age_error").text("");
        // alert(1213131); 

         //
        control_pre_notpre_new(marriage_details);

        var dob_one = $('#cp_one_dob').datepicker('getDate');
        var dob_two = $('#cp_two_dob').datepicker('getDate');
        if(dob_one)
        {
            calculate_cp_one_age_new();
        }
        if( dob_two)
        {
            calculate_cp_two_age_new();
        }

        check_marriage_incident_date_new();
    });
});


function check_marriage_incident_date_new()
{
    //alert("hello");
    //$('#incident_date_error').html('');
    var incident_date = $("input[name='incident_date']").datepicker('getDate');
    var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
    var marriage_details = $("input[name='marriage_details']:checked").val();

    if(typeof marriage_details != 'undefined' && incident_date && marriage_date)
    {
        incident_date = incident_date.getTime();
        marriage_date = marriage_date.getTime();
        if(marriage_details ==1)
        {

            if(marriage_date <= incident_date)
            {
                var int_date = $("input[name='incident_date']").datepicker('getDate');
                var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
                var int_date = formatDate(int_date);
                var mag_date = formatDate(marriage_date);
                var msg = "You have marked the intervention as <b>“Before Marriage”</b>, so the intervention date should be before the marriage date. <br>";
                var msg_date = "You had entered <b>intervention date</b> as <b>"+int_date+"</b> and <b>marriage date</b> as <b>"+mag_date+"</b>. Please correct";
                // alert('marriage date should be > Intervention Date');
                //alert(msg_date);
                 $('#incident_date_error').html(msg+msg_date); 
                $("input[name='incident_date']").val('');
                $("input[name='marriage_date']").val('');

                // $("input[name='marriage_details']:checked").prop('checked', false);
                $('#cp_one_age_months').val('')
                $('#cp_two_age_months').val('')
                // event.preventDefault();
                // $("#cp_two_age_error").text("Please provide Marriage date and date of birth");
            }
        }
        else if(marriage_details == 2)
        {
            if(incident_date != marriage_date)
            {
                // alert(marriage_date.getTime()+"---------------"+incident_date.getTime());
                // alert(marriage_date+"-"+incident_date);
                // alert('Then Marriage date must be = Intervention Date');
                var int_date = $("input[name='incident_date']").datepicker('getDate');
                var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
                var int_date = formatDate(int_date);
                var mag_date = formatDate(marriage_date);
                var msg = "You have marked the intervention as <b>“On The Day Of Marriage”</b>, so the intervention date must be the same as the marriage date. <br>";
                var msg_date = "You had entered <b>intervention date</b> as <b>"+int_date+"</b> and <b>marriage date</b> as <b>"+mag_date+"</b>. Please correct";

                
                $('#incident_date_error').html(msg+msg_date); 

                // $('#incident_date_error').html('Intervention Date and Marriage Date should be same date!');
                $("input[name='incident_date']").val('');
                $("input[name='marriage_date']").val('');
                // $("input[name='marriage_details']:checked").prop('checked', false);
                $('#cp_one_age_months').val('')
                $('#cp_two_age_months').val('')

            }
        }
        else if(marriage_details == 3)
        {
            if(marriage_date >= incident_date)
            {
                // alert('then Marriage date must be < Intervention Date');
                // alert(int_date);
                var int_date = $("input[name='incident_date']").datepicker('getDate');
                var marriage_date = $("input[name='marriage_date']").datepicker('getDate');
                var int_date = formatDate(int_date);
                var mag_date = formatDate(marriage_date);
                var msg = "You have marked the intervention as <b>“Post Marriage”</b>,  so the Intervention date should be after the marriage date. <br>";
                var msg_date = "You had entered <b>intervention date</b> as <b>"+int_date+"</b> and <b>marriage date</b> as <b>"+mag_date+"</b>. Please correct";

                
                $('#incident_date_error').html(msg+msg_date);     
                $("input[name='incident_date']").val('');
                $("input[name='marriage_date']").val('');
                
                // $("input[name='marriage_details']:checked").prop('checked', false);
                $('#cp_one_age_months').val('')
                $('#cp_two_age_months').val('')

            }
        }
    }
}

function control_trash_str_new(prevented_details = null)
{
    $('#font-str').css("display", "none");
    $('#trash').prop('disabled', false);
    if(prevented_details == 2)
    {
        $('#font-str').css("display", "block");
        $('#trash').prop('disabled', true);
    }
}
function control_pre_notpre_new(marriage_details = null,not_control=0)
{
    control_trash_str_new();
    var prevented_details_val = $("input[name='prevented_details']:checked").val();
    $('input[name="prevented_details"][value="1"]').prop('disabled', false);
    $('input[name="prevented_details"][value="2"]').prop('disabled', false);
    $('input[name="prevented_details"][value="1"]').prop('checked', false);
    $('input[name="prevented_details"][value="2"]').prop('checked', false);

    if(marriage_details == 1)
    {
        // $('input[name="prevented_details"][value="2"]').prop('disabled', true);
        // $('input[name="prevented_details"][value="1"]').prop('checked', true);
        // var marriage_details = $("input[name='marriage_details']:checked").val();
        // $('input[name="marriage_details"][value="'+marriage_details_val+'"]').prop('checked', true);

        $('input[name="prevented_details"][value="'+prevented_details_val+'"]').prop('checked', true);
        
    }
    else if (marriage_details == 2 && not_control==1) 
    {
        if(prevented_details_val)
        {
            $('input[name="prevented_details"][value="'+prevented_details_val+'"]').prop('checked', true);
            if(prevented_details_val == 2)
            {
                control_trash_str_new(2);
            }
        }
    }
    else if (marriage_details == 3) 
    {
        $('input[name="prevented_details"][value="1"]').prop('disabled', true);
        $('input[name="prevented_details"][value="2"]').prop('checked', true);
        control_trash_str_new(2);
    }

}