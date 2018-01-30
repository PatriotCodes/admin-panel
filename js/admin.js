$(document).ready(function() {
    $('.deleteRowButton').click(DeleteRow);
});

function DeleteRow() {
	var del_id = $(this).attr("id");
    var table = $(this).attr("name");
    var idName = $(this).attr("value");
 	$.ajax({
                url : 'http://localhost/admin-panel/resources/controllers/delete.php',
                type : 'get',
                data : 'id='+ del_id + '&name='+ table +'&idName=' + idName,
                success: function(data)         
                {
                    // etc...
                }
            });
    $(this).parents('tr').animate("fast").animate( {
    	opacity : "hide" 
    }, 300);
}
