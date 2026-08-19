var base_url = $('body').data('base_url');
// Get Incident Block Details
$(document).on('change','#incident_district',function(){
   if($( "#incident_district option:selected" ).val()!="")
   {
      var id=$('#incident_district').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#incident_block').html('');
             $('#incident_block').html('<option value="0" disabled selected>--Select Block / Municipality--</option>');
             data.forEach(element =>$("#incident_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v=$( "#incident_block option:selected" ).val();
          }
      });
   }
});

// Get Identity Block Details
$(document).on('change','#identity_district',function(){
   if($( "#identity_district option:selected" ).val()!="")
   {
      var id=$('#identity_district').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#identity_block').html('');
             $('#identity_block').html('<option value="0" disabled selected>--Select Block / Municipality--</option>');
             data.forEach(element =>$("#identity_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v=$( "#identity_block option:selected" ).val();
             $('#identity_ward_gp').empty();
             $('#identity_ward_gp').html('<option value="0" disabled selected>--Select Block / Municipality First--</option>');
          }
      });
   }
});
// Get CP One District Details
$(document).on('change','#cp_one_state',function(){
   if($( "#cp_one_state option:selected" ).val()!="")
   {
      var id=$('#cp_one_state').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/Get_District_By_Id',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#cp_one_district').html('');
             $('#cp_one_district').html('<option value="0" disabled selected>--Select District--</option>');
             data.forEach(element =>$("#cp_one_district").append($('<option></option>').val(element['district_id_pk']).html(element['district_name'])));
             var v=$( "#cp_one_district option:selected" ).val();
             $('#cp_one_block').empty();
             $('#cp_one_ward_gp').empty();
             $('#cp_one_block').html('<option value="0" disabled selected>--Select District First--</option>');
             $('#cp_one_ward_gp').html('<option value="0" disabled selected>--Select Block / Municipality First--</option>');
          }
      });
   }
});
// Get CP One Block Details
$(document).on('change','#cp_one_district',function(){
   if($( "#cp_one_district option:selected" ).val()!="")
   {
      var id=$('#cp_one_district').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#cp_one_block').html('');
             $('#cp_one_block').html('<option value="0" disabled selected>--Select Block / Municipality--</option>');
             data.forEach(element =>$("#cp_one_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v=$( "#cp_one_block option:selected" ).val();
             $('#cp_one_ward_gp').empty();
             $('#cp_one_ward_gp').html('<option value="0" disabled selected>--Select Block / Municipality First--</option>');
          }
      });
   }
});
// Get CP Two District Details
$(document).on('change','#cp_two_state',function(){
   if($( "#cp_two_state option:selected" ).val()!="")
   {
      var id=$('#cp_two_state').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/Get_District_By_Id',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#cp_two_district').html('');
             $('#cp_two_district').html('<option value="0" disabled selected>--Select District--</option>');
             data.forEach(element =>$("#cp_two_district").append($('<option></option>').val(element['district_id_pk']).html(element['district_name'])));
             var v=$( "#cp_two_district option:selected" ).val();
             $('#cp_two_block').empty();
             $('#cp_two_ward_gp').empty();
             $('#cp_two_block').html('<option value="0" disabled selected>--Select District First--</option>');
             $('#cp_two_ward_gp').html('<option value="0" disabled selected>--Select Block / Municipality First--</option>');
          }
      });
   }
});
// Get CP Two Block Details
$(document).on('change','#cp_two_district',function(){
   if($( "#cp_two_district option:selected" ).val()!="")
   {
      var id=$('#cp_two_district').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#cp_two_block').html('');
             $('#cp_two_block').html('<option value="0" disabled selected>--Select Block / Municipality--</option>');
             data.forEach(element =>$("#cp_two_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v=$( "#cp_two_block option:selected" ).val();
             $('#cp_two_ward_gp').empty();
             $('#cp_two_ward_gp').html('<option value="0" disabled selected>--Select Block / Municipality First--</option>');
          }
      });
   }
});

// Get Police Case Details
$(document).on('change','#police_case_district',function(){
   if($( "#police_case_district option:selected" ).val()!="")
   {
      var id=$('#police_case_district').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#police_case_block').html('');
             data.forEach(element =>$("#police_case_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v=$( "#police_case_block option:selected" ).val();
          }
      });
   }
});

// Get CP One CWC Block Details
$(document).on('change','#cp_one_cwc_district',function(){
   if($( "#cp_one_cwc_district option:selected" ).val()!="")
   {
      var id=$('#cp_one_cwc_district').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#cp_one_cwc_block').html('');
             data.forEach(element =>$("#cp_one_cwc_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v=$( "#cp_one_cwc_block option:selected" ).val();
          }
      });
   }
});

// Get CP Two CWC Block Details
$(document).on('change','#cp_two_cwc_district',function(){
   if($( "#cp_two_cwc_district option:selected" ).val()!="")
   {
      var id=$('#cp_two_cwc_district').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#cp_two_cwc_block').html('');
             data.forEach(element =>$("#cp_two_cwc_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v=$( "#cp_two_cwc_block option:selected" ).val();
          }
      });
   }
});

// Get CP One CCI Details
$(document).on('change','#cp_one_cwc_district',function(){
    var cp_one_gender_val = [];
    $(".cp_one_gender_val").each(function(){
       if($(this).is(":checked"))
       {
          cp_one_gender_val.push($(this).val());
       }
    });
    cp_one_gender_value = cp_one_gender_val.toString();
    var cp_one_cwc_district = $('#cp_one_cwc_district').val();
   if(cp_one_gender_value !="")
   {
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/Get_Cp_One_CCI_Details',
          type:'GET',
          data:{'cp_one_gender_value':cp_one_gender_value, 'cp_one_cwc_district':cp_one_cwc_district}, 
          dataType: 'json',
          success: function(data)
          {
             var cp_one_cwc_cci_data = '<option disabled="" selected="">--Please Select CCI--</option>';
             for(var count = 0; count < data.length; count++){
               cp_one_cwc_cci_data += '<option value="'+data[count].sl_no+'">'+data[count].cci_name+'</option>';
             }
             $('#cp_one_cwc_cci').html(cp_one_cwc_cci_data);
          }
      });
   }else{
      $('#cp_one_cwc_cci').val('');
   }
});

// Get CP Two CCI Details
$(document).on('change','#cp_two_cwc_district',function(){
    var cp_two_gender_val = [];
    $(".cp_two_gender_val").each(function(){
       if($(this).is(":checked"))
       {
          cp_two_gender_val.push($(this).val());
       }
    });
    cp_two_gender_value = cp_two_gender_val.toString();
    var cp_two_cwc_district = $('#cp_two_cwc_district').val();
    if(cp_two_gender_value !="")
    {
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/Get_Cp_Two_CCI_Details',
          type:'GET',
          data:{'cp_two_gender_value':cp_two_gender_value, 'cp_two_cwc_district':cp_two_cwc_district}, 
          dataType: 'json',
          success: function(data)
          {
             var cp_two_cwc_cci_data = '<option disabled="" selected="">--Please Select CCI--</option>';
             for(var count = 0; count < data.length; count++){
               cp_two_cwc_cci_data += '<option value="'+data[count].sl_no+'">'+data[count].cci_name+'</option>';
             }
             $('#cp_two_cwc_cci').html(cp_two_cwc_cci_data);
          }
      });
    }else{
      $('#cp_two_cwc_cci').val('');
    }
});
// Minor Transfer details Check
$(document).ready(function(){
   $("#cp_one_age, #cp_two_age").change(function(){
      var cp_one_age = $('#cp_one_age').val();
      var cp_two_age = $('#cp_one_age').val();
      if(cp_one_age < 18){
         $('#cp_one_transfer').html('Minor Transfer Details');
      }else if(cp_two_age >= 18){
         $('#cp_two_transfer').html('Adult Transfer Details');
      }
   });
});
// Get Incident Ward/GP Details
$(document).on('change','#incident_block',function(){
   if($( "#incident_block option:selected" ).val()!="")
   {
      var id = $('#incident_block').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/Get_Block_Details',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
            if(data.rural_urban == 'U'){
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_Ward_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#ward_gp').html('');
                     $('#ward_gp').html('<option value="0" disabled selected>--Select Ward / GP--</option>');
                     data.forEach(element =>$("#ward_gp").append($('<option></option>').val(element['ward_id_pk']).html(element['ward_no'])));
                     var v = $("#ward_gp option:selected").val();
                   }
               });
            }else{
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_GP_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#ward_gp').html('');
                     $('#ward_gp').html('<option value="0" disabled selected>--Select Ward / GP--</option>');
                     data.forEach(element =>$("#ward_gp").append($('<option></option>').val(element['gp_id_pk']).html(element['gp_name'])));
                     var v = $("#ward_gp option:selected").val();
                   }
               });
            }
          }
      });
   }
});
// Get Identity Ward / GP Details
$(document).on('change','#identity_block',function(){
   if($( "#identity_block option:selected" ).val()!="")
   {
      var id = $('#identity_block').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/Get_Block_Details',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
            if(data.rural_urban == 'U'){
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_Ward_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#identity_ward_gp').html('');
                     $('#identity_ward_gp').html('<option value="0" disabled selected>--Select Ward / GP--</option>');
                     data.forEach(element =>$("#identity_ward_gp").append($('<option></option>').val(element['ward_id_pk']).html(element['ward_no'])));
                     var v = $("#identity_ward_gp option:selected").val();
                   }
               });
            }else{
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_GP_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#identity_ward_gp').html('');
                     $('#identity_ward_gp').html('<option value="0" disabled selected>--Select Ward / GP--</option>');
                     data.forEach(element =>$("#identity_ward_gp").append($('<option></option>').val(element['gp_id_pk']).html(element['gp_name'])));
                     var v = $("#identity_ward_gp option:selected").val();
                   }
               });
            }
          }
      });
   }
});
// Get CP One Ward / GP Details
$(document).on('change','#cp_one_block',function(){
   if($( "#cp_one_block option:selected" ).val()!="")
   {
      var id = $('#cp_one_block').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/Get_Block_Details',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
            if(data.rural_urban == 'U'){
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_Ward_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#cp_one_ward_gp').html('');
                     $('#cp_one_ward_gp').html('<option value="0" disabled selected>--Select Ward/GP--</option>');
                     data.forEach(element =>$("#cp_one_ward_gp").append($('<option></option>').val(element['ward_id_pk']).html(element['ward_no'])));
                     var v = $("#cp_one_ward_gp option:selected").val();
                   }
               });
            }else{
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_GP_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#cp_one_ward_gp').html('');
                     $('#cp_one_ward_gp').html('<option value="0" disabled selected>--Select Ward/GP--</option>');
                     data.forEach(element =>$("#cp_one_ward_gp").append($('<option></option>').val(element['gp_id_pk']).html(element['gp_name'])));
                     var v = $("#cp_one_ward_gp option:selected").val();
                   }
               });
            }
          }
      });
   }
});
// Get CP Two Ward / GP Details
$(document).on('change','#cp_two_block',function(){
   if($( "#cp_two_block option:selected" ).val()!="")
   {
      var id = $('#cp_two_block').val()
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/Get_Block_Details',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
            if(data.rural_urban == 'U'){
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_Ward_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#cp_two_ward_gp').html('');
                     $('#cp_two_ward_gp').html('<option value="0" disabled selected>--Select Ward/GP--</option>');
                     data.forEach(element =>$("#cp_two_ward_gp").append($('<option></option>').val(element['ward_id_pk']).html(element['ward_no'])));
                     var v = $("#cp_two_ward_gp option:selected").val();
                   }
               });
            }else{
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_GP_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#cp_two_ward_gp').html('');
                     $('#cp_two_ward_gp').html('<option value="0" disabled selected>--Select Ward/GP--</option>');
                     data.forEach(element =>$("#cp_two_ward_gp").append($('<option></option>').val(element['gp_id_pk']).html(element['gp_name'])));
                     var v = $("#cp_two_ward_gp option:selected").val();
                   }
               });
            }
          }
      });
   }
});