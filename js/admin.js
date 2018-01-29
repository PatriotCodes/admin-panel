$(document).ready(function() {
    $('.deleteRowButton').click(DeleteRow);
});

function DeleteRow() {
	var del_id = $(this).attr("id");
 	$.ajax({
 				type : "POST",
                url : "http://localhost/admin-panel/resources/controllers/delete.php", 
                data : 'id='+del_id,
                success : function() {
                }
            });
    $(this).parents('tr').animate("fast").animate( {
    	opacity : "hide" 
    }, 300);
}
