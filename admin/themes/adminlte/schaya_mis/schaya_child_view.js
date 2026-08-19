$( document ).ready(function() {
	//alert('id_hash');
	//feedback_view
	$(document).on('click','.view_schaya_mis', function(){
		var id_hash = $(this).attr('alt');
		//alert('gh');
		$('.modal-title').text('Sneha Chaya Child View');
		
		
		var url = 'schaya_mis/District_wise_registered_child/view_schaya_child_details/'+id_hash;
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
	