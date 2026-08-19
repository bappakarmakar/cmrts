$(document).ready(function(){
   // DOB Document Contracting Party One
      var cp_one_dob_document_available = $('input[name="cp_one_dob_document_available"]:checked').val();

      if(cp_one_dob_document_available==1){
         $("#dob_document_available_cp_one").show();

      }else{
         $("#dob_document_available_cp_one").hide();
      }

      var cp_one_cwc_minor_sent_to = $('input[name="cp_one_cwc_minor_sent_to"]:checked').val();
      if(cp_one_cwc_minor_sent_to == 1 || cp_one_cwc_minor_sent_to == 2 || cp_one_cwc_minor_sent_to == 3){
          $("#cp_one_cwc_first_row").hide();
          $("#cp_one_cwc_second_row").show();
          $("#cp_one_cwc_cci_div").hide();
          $("#cp_one_cwc_address_div").show();
          $("#cp_one_cwc_third_row").show();
      }else if(cp_one_cwc_minor_sent_to == 4){
          $("#cp_one_cwc_first_row").show();
          $("#cp_one_cwc_second_row").show();
          $("#cp_one_cwc_cci_div").show();
          $("#cp_one_cwc_third_row").show();
          $("#cp_one_cwc_address_div").hide(); 
      }else{
          $("#cp_one_cwc_first_row").hide();
          $("#cp_one_cwc_second_row").hide();
          $("#cp_one_cwc_third_row").hide();
          $("#cp_one_cwc_cci_div").hide();
          $("#cp_one_cwc_address_div").hide();
      }

      var cp_two_cwc_minor_sent_to = $('input[name="cp_two_cwc_minor_sent_to"]:checked').val();
      if(cp_two_cwc_minor_sent_to == 1 || cp_two_cwc_minor_sent_to == 2 || cp_two_cwc_minor_sent_to == 3){
          $("#cp_two_cwc_first_row").hide();
          $("#cp_two_cwc_second_row").show();
          $("#cp_two_cwc_cci_div").hide();
          $("#cp_two_cwc_address_div").show();
          $("#cp_two_cwc_third_row").show();
      }else if(cp_two_cwc_minor_sent_to == 4){
          $("#cp_two_cwc_first_row").show();
          $("#cp_two_cwc_second_row").show();
          $("#cp_two_cwc_cci_div").show();
          $("#cp_two_cwc_third_row").show();
          $("#cp_two_cwc_address_div").hide();
      }else{
          $("#cp_two_cwc_first_row").hide();
          $("#cp_two_cwc_second_row").hide();
          $("#cp_two_cwc_cci_div").hide();
          $("#cp_two_cwc_third_row").hide();
          $("#cp_two_cwc_address_div").hide();
      }
   //$("#dob_document_available_cp_one").hide();
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
      var cp_one_identity_document_available = $('input[name="cp_one_identity_document_available"]:checked').val();
      if(cp_one_identity_document_available==1){
         $("#identity_document_available_cp_one").show();

      }else{
         $("#identity_document_available_cp_one").hide();
      }
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
   var cp_two_dob_document_available = $('input[name="cp_two_dob_document_available"]:checked').val();
   if(cp_two_dob_document_available==1){
      $("#dob_document_available_cp_two").show();

   }else{
      $("#dob_document_available_cp_two").hide();
   }
   // $("#dob_document_available_cp_two").hide();
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

      var cp_two_identity_document_available = $('input[name="cp_two_identity_document_available"]:checked').val();
      if(cp_two_identity_document_available==1){
         $("#identity_document_available_cp_two").show();
      }else{
         $("#identity_document_available_cp_two").hide();
      }
   // $("#identity_document_available_cp_two").hide();
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
   // var edit_id =$('#incident_form_edit').attr('id');
   //  if(edit_id != 'incident_form_edit'){
   //    $("#cp_one_cwc_first_row").hide();
   //    $("#cp_one_cwc_second_row").hide();
   //    $("#cp_one_cwc_third_row").hide();
   //    $("#cp_one_cwc_cci_div").hide();
   //    $("#cp_one_cwc_address_div").hide();
   //  }
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
   // var edit_id =$('#incident_form_edit').attr('id');
   // if(edit_id != 'incident_form_edit'){
   //    $("#cp_two_cwc_first_row").hide();
   //    $("#cp_two_cwc_second_row").hide();
   //    $("#cp_two_cwc_address_div").hide();
   //    $("#cp_two_cwc_third_row").hide();
   //    $("#cp_two_cwc_cci_div").hide();
   // }
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
   var anonymous = $('input[name="anonymous"]:checked').val();
   if(anonymous==2){
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

   // Advanced Search 
   $("#advanced_search_form").hide();
   $("advanced_search_btn").click(function(){
      $("#advanced_search_form").show(1000);
   });

   // CP Two Hide Show 
   var cp_two_is_available = $('input[name="cp_two_is_available"]:checked').val();
   if(cp_two_is_available == 1){
      $("#cp_two_hide_show_div").show();
   }else{
      $("#cp_two_hide_show_div").hide();
   }

   $(".cp_two_is_available_button").change(function(){
       var cp_two_is_available = $('input[name="cp_two_is_available"]:checked').val();
       if(cp_two_is_available == '1'){
          $("#cp_two_hide_show_div").show();
       }else{
          $("#cp_two_hide_show_div").hide();
       }
   });

   // CP One Address Details Hide Show
   var cp_one_state = $('#cp_one_state').val()
   if(cp_one_state == 1){
      $("#cp_one_address_div_one").show();
      $("#cp_one_address_div_two").hide();
   }else if(cp_one_state == 2){
      $("#cp_one_address_div_one").hide();
      $("#cp_one_address_div_two").show();
   }else{
      $("#cp_one_address_div_one").show();
      $("#cp_one_address_div_two").hide();
   }

   $(".cp_one_state_box").change(function(){
       var cp_one_state = $('#cp_one_state').val()
       if(cp_one_state == 1){
          $("#cp_one_address_div_one").show();
          $("#cp_one_address_div_two").hide();
       }else{
          $("#cp_one_address_div_one").hide();
          $("#cp_one_address_div_two").show();
       }
   });

   // CP Two Address Details Hide Show
   var cp_two_state = $('#cp_two_state').val()
   if(cp_two_state == 1){
      $("#cp_two_address_div_one").show();
      $("#cp_two_address_div_two").hide();
   }else if(cp_two_state == 2){
      $("#cp_two_address_div_one").hide();
      $("#cp_two_address_div_two").show();
   }else{
      $("#cp_two_address_div_one").show();
      $("#cp_two_address_div_two").hide();
   }

   $(".cp_two_state_box").change(function(){
       var cp_two_state = $('#cp_two_state').val()
       if(cp_two_state == 1){
          $("#cp_two_address_div_one").show();
          $("#cp_two_address_div_two").hide();
       }else{
          $("#cp_two_address_div_one").hide();
          $("#cp_two_address_div_two").show();
       }
   });
});