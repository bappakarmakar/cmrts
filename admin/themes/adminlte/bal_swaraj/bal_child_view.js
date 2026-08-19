$( document ).ready(function() {
	//alert('id_hash');
	//feedback_view
	$(document).on('click','.view_bal_swaraj', function(){
		var id_hash = $(this).attr('alt');
		//alert('gh');
		$('.modal-title').text('Bal Swaraj Child View');
		
		
		var url = 'csv_upload/uploadCsv/view_bal_swaraj_details/'+id_hash;
		//alert(url);
		$.ajax({
			url: url,
			beforeSend: function(){
			},
			success: function(result){
				console.log(result);
				$(".modal-body").html(result);
			}
		 });
		
		//alert(id_hash);
	});
		 });

$(document).ready(function() {
            $('#mytable').DataTable();
        });

        $('#mytable').DataTable( {
            stateSave: true,
        } );
	