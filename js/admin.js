$(document).ready(function() {
    $('.deleteRowButton').click(DeleteRow);
});

$(document).ready(function() {
    $('.deleteRowButtonCheck').click(DeleteRowWCheck);
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

function DeleteRowWCheck() {
    var del_id = $(this).attr("id");
    var table = $(this).attr("name");
    var idName = $(this).attr("value");
    var r = confirm("Если у данной группы есть относящиеся к ней ресурсы, то после ее удаления они окажутся без группы. Вы уверены, что хотите ее удалить?");
    if (r == true) {
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
}

function ChangeResOptions(catID) {
    var resOptions = document.getElementById("resourceOptions");
    for (var i = 0; i < resOptions.length; i++) {
        resOptions.remove(i);
    }
    var curURL = location.protocol + '//' + location.host + location.pathname;
    window.location = curURL + "?idReq=" + catID;   
}

$("a[href='#top']").click(function() {
  window.scrollTo(x-coord, y-coord);
  return false;
});

$(document).ready(function() {
    var highlightedRow = document.getElementById("focus");
    $('html, body').animate({
            scrollTop: $(highlightedRow).offset().top - (window.innerHeight / 2) + 'px'
        }, 'fast');
});