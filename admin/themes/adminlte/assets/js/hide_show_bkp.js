$(document).ready(function(){
   // DOB Document Contracting Party One
   $("#dob_document_available_cp_one").hide();
    $(".dob_document_cp_one").change(function(){
       var dob_document_cp_one = [];
       $(".dob_document_cp_one").each(function(){
          if($(this).is(":checked"))
          {
             dob_document_cp_one.push($(this).val());
          }
       });
       dob_document_cp_one_value = dob_document_cp_one.toString();
       if(dob_document_cp_one_value == '1'){
          $("#dob_document_available_cp_one").show();
       }else{
          $("#dob_document_available_cp_one").hide();
       }
   });
   // Identity Document Contracting Party One
   $("#identity_document_available_cp_one").hide();
    $(".identity_document_cp_one").change(function(){
       var identity_document_cp_one = [];
       $(".identity_document_cp_one").each(function(){
          if($(this).is(":checked"))
          {
             identity_document_cp_one.push($(this).val());
          }
       });
       identity_document_cp_one_value = identity_document_cp_one.toString();
       if(identity_document_cp_one_value == '1'){
          $("#identity_document_available_cp_one").show();
       }else{
          $("#identity_document_available_cp_one").hide();
       }
   });
   // DOB Document Contracting Party Two
   $("#dob_document_available_cp_two").hide();
    $(".dob_document_cp_two").change(function(){
       var dob_document_cp_two = [];
       $(".dob_document_cp_two").each(function(){
          if($(this).is(":checked"))
          {
             dob_document_cp_two.push($(this).val());
          }
       });
       dob_document_cp_two_value = dob_document_cp_two.toString();
       if(dob_document_cp_two_value == '1'){
          $("#dob_document_available_cp_two").show();
       }else{
          $("#dob_document_available_cp_two").hide();
       }
   });
   // Identity Document Contracting Party Two
   $("#identity_document_available_cp_two").hide();
    $(".identity_document_cp_two").change(function(){
       var identity_document_cp_two = [];
       $(".identity_document_cp_two").each(function(){
          if($(this).is(":checked"))
          {
             identity_document_cp_two.push($(this).val());
          }
       });
       identity_document_cp_two_value = identity_document_cp_two.toString();
       if(identity_document_cp_two_value == '1'){
          $("#identity_document_available_cp_two").show();
       }else{
          $("#identity_document_available_cp_two").hide();
       }
   });
    // Contracting Party One CWC Details
    var edit_id =$('#incident_form_edit').attr('id');
    if(edit_id != 'incident_form_edit'){
      $("#cp_one_cwc_first_row").hide();
      $("#cp_one_cwc_second_row").hide();
      $("#cp_one_cwc_third_row").hide();
      $("#cp_one_cwc_cci_div").hide();
      $("#cp_one_cwc_address_div").hide();
    }
    $(".cp_one_cwc_minor_sent_div").change(function(){
       var cp_one_cwc_minor_sent_div = [];
       $(".cp_one_cwc_minor_sent_div").each(function(){
          if($(this).is(":checked"))
          {
             cp_one_cwc_minor_sent_div.push($(this).val());
          }
       });
       cp_one_cwc_minor_sent_div_value = cp_one_cwc_minor_sent_div.toString();
       if(cp_one_cwc_minor_sent_div_value == '4'){
          $("#cp_one_cwc_first_row").show();
          $("#cp_one_cwc_second_row").show();
          $("#cp_one_cwc_cci_div").show();
          $("#cp_one_cwc_third_row").show();
          $("#cp_one_cwc_address_div").hide();
       }else{
          $("#cp_one_cwc_first_row").hide();
          $("#cp_one_cwc_second_row").show();
          $("#cp_one_cwc_cci_div").hide();
          $("#cp_one_cwc_address_div").show();
          $("#cp_one_cwc_third_row").show();
       }
   });
   // Contracting Party Two CWC Details
   var edit_id =$('#incident_form_edit').attr('id');
   if(edit_id != 'incident_form_edit'){
      $("#cp_two_cwc_first_row").hide();
      $("#cp_two_cwc_second_row").hide();
      $("#cp_two_cwc_address_div").hide();
      $("#cp_two_cwc_third_row").hide();
      $("#cp_two_cwc_cci_div").hide();
   }
    $(".cp_two_cwc_minor_sent_div").change(function(){
       var cp_two_cwc_minor_sent_div = [];
       $(".cp_two_cwc_minor_sent_div").each(function(){
          if($(this).is(":checked"))
          {
             cp_two_cwc_minor_sent_div.push($(this).val());
          }
       });
       cp_two_cwc_minor_sent_div_value = cp_two_cwc_minor_sent_div.toString();
       if(cp_two_cwc_minor_sent_div_value == '4'){
          $("#cp_two_cwc_first_row").show();
          $("#cp_two_cwc_second_row").show();
          $("#cp_two_cwc_cci_div").show();
          $("#cp_two_cwc_third_row").show();
          $("#cp_two_cwc_address_div").hide();
       }else{
          $("#cp_two_cwc_first_row").hide();
          $("#cp_two_cwc_second_row").show();
          $("#cp_two_cwc_cci_div").hide();
          $("#cp_two_cwc_address_div").show();
          $("#cp_two_cwc_third_row").show();
       }
   });

    $("#Anonymous_1").hide();
    $("#Anonymous_2").hide();
    $("#Anonymous_3").hide();
    $("#Anonymous_4").hide();
   $(".anonymous").change(function(){
       var anonymous = [];
       $(".anonymous").each(function(){
          if($(this).is(":checked"))
          {
             anonymous.push($(this).val());
          }
       });
       anonymous_value = anonymous.toString();
       if(anonymous_value == '2'){
          $("#Anonymous_1").show();
          $("#Anonymous_2").show();
          $("#Anonymous_3").show();
          $("#Anonymous_4").show();
       }else{
          $("#Anonymous_1").hide();
          $("#Anonymous_2").hide();
          $("#Anonymous_3").hide();
          $("#Anonymous_4").hide();
       }
   });
});