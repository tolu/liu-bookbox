$(function() {
    
    	// open dialog when admin clicks button
		$('#addCategoryBtn').live('click', function () { 

			var pathToForm = $(this).attr("href");
			$('#infoBoxContent').html('');
     	$('#infoBoxContent').load(pathToForm);
      $('#infoBox').dialog('open');
      
      return false;
		});
		
		$("#addCategoryForm").live('submit', function (){
      var reloadCategories = $(this).attr("redir");
			var pathToInsert = $(this).attr("action");
      
			if($("#Name").val().length > 2){
				$.post(pathToInsert,{categoryName : $("#Name").val()}, function(){
          $("#content").load(reloadCategories);
        });
			}
			else
			{
				alert("Kategori namnet är för kort");
			}
      $('#infoBox').dialog('close');
      return false;	
		});
    
    
    $(".removeCategoryBtn").live('click', function(){
			if(confirm("Vill du verkligen ta bort Kategorin?"))
			{
				var removePath = $(this).attr("href");
				$(this).parent().fadeTo("slow", 0.33);
				$(this).parent().append("<span class='categoryRemoved'>Item removed</span>");
				$.get(removePath);
				$(this).remove();
			}
			
			return false;
		});
});