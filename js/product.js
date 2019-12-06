$(document).ready(function(){
						 $('.action').change(function(){
						  if($(this).val() != '')
						  {
						   var action = $(this).attr("id");
						   var query = $(this).val();
						   var result = '';
						   if(action == "Size")
						   {
							result = 'Color';
						   }
						   else
						   {
							   if(action == "Color")
							   {
								   result='Quantity';
							   }
							   
						   }
						   $.ajax({
							url:"fetch.php",
							method:"POST",
							data:{action:action, query:query},
							success:function(data){
							 $('#'+result).html(data);
							}
						   })
						  }
						 });
						});