$(document).ready(function(){

 	function load_data(query)
 	{
  		$.ajax({
   		url:"fetch_books.php",
   		method:"POST",
   		data:{query:query},
   		success:function(data)
   		{
    		$('#result').html(data);
   		}
  		});
 	}
 	$('#search_text').keydown(function(){
  	var search = $(this).val();
  	if(search != '')
  	{
   		load_data(search);
  	}
  	else
  	{
   		
  	}
 	});
 	$('#search_text').focusout(function(){
 		$('#result').html("");
 	});
});