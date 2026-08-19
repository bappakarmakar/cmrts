// Block
$(document).on('change','#pc_district',function(){
   if($( "#pc_district option:selected" ).val()!="")
   {
      var id = $('#pc_district').val()
      // alert(id);
      $.ajax({
          url:'<?php echo base_url()?>admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#pc_block').html('');
             data.forEach(element =>$("#pc_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v = $( "#pc_block option:selected" ).val();
          }
      });
   }
});
// Form validation
$( "#PoliceCaseForm" ).validate({
  rules: {
   gd_no: {
      required: true
    },
    gd_date: {
      required: true
    },
    fir_no: {
      required: true
    },
    fir_date: {
      required: true
    },
    police_station: {
      required: true
    },
    pc_district: {
      required: true
    },
    pc_block: {
      required: true
    },
    reason: {
      required: true
    }
  },
  messages : {
     gd_no: {
       required: "GD no field is required"
     },
     gd_date: {
       required: "GD date field is required"
     },
     fir_no: {
       required: "Fir no field is required"
     },
     fir_date: {
       required: "Fir date field is required"
     },
     police_station: {
       required: "Police station field is required"
     },
     pc_district: {
       required: "District field is required"
     },
     pc_block: {
      required: "SD/Block field is required"
     },
     reason: {
       required: "Reason field is required"
     },
  },
});