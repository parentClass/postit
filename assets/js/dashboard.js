$(document).ready(function(){

	function firstPost(){
	    $('#btn-post').text('saving...'); //change button text
	    $('#btn-post').attr('disabled',true); //set button disable 
	    var url = "<?php echo site_url('dashboard/post'); ?>";
	 
	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#form').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {
	            if(data.status) //if success close modal and reload ajax table
	            {
	                $('#firstPostModal').modal('hide');
	            }
	            $('#btn-post').text('save'); //change button text
	            $('#btn-post').attr('disabled',false); //set button enable 
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btn-post').text('save'); //change button text
	            $('#btn-post').attr('disabled',false); //set button enable 
	 
	        }
	    });
	}
});