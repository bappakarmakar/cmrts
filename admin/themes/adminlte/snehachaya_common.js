
$(function () {

  $(document).ready(function(){
    $("input:checkbox").prop("checked", "true");
});

});

$(function () {
//File button bootstrap
  $("#assignQuestion").click(function () {
   var hash_name = $(this).attr("alt");
   var hash = $(this).attr("rel");

   var check = $('#childAppend').find('input[type=checkbox]:checked').length;
  
    if(check < 1){
      swal('Please check only one child at a time !!');
      return false;
      }
        
  if(check==0){
    swal('Please check atleast one child !!');
  }else{
            
    var checked = [];
    $("input[name='checkedchild[]']:checked").each(function(){
        checked.push($(this).val());
    });
    checked=JSON.stringify(checked);
var url = 'csv_upload/uploadCsv/export_bal_swaraj_child_info'; 
    $.ajax({
      type:"POST",
      url: url,
      data: {checked:checked,[hash_name]: hash},
      success:function(CalBAckFav){
        
        swal({
          reverseButtons:true,
          title: "Do you want to export the child list?",
          type: "warning",
          confirmButtonClass: "btn-success",
          confirmButtonText: "Yes",
          showCancelButton: true,
          cancelButtonText:"No",
          cancelButtonClass:"btn-danger",
          closeOnConfirm: false
        },
        function(isConfirm){
          if(!isConfirm) return;
            swal({
        title: "Successfully Exported",
      //text: "You clicked the button!", 
       type: "success"
        },
      function(){ 
       location.reload();
       }
     );
            
        });
      }
    });
  }

    });
  

});
$(function () {

/***********File upload********************/
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
      });
    
      // We can watch for our custom `fileselect` event like this
      $(document).ready( function() {
          $(':file').on('fileselect', function(event, numFiles, label) {
    
              var input = $(this).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;
    
              if( input.length ) {
                  input.val(log);
              } else {
                  //if( log ) alert(log);
              }
    
          });
      });
      /***********End File upload********************/

});

