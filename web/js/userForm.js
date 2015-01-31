$(document).ready(function ()
{

	$("#userFormSendBtn").live("click",function(){
		
		 var valid = true; 
		
		$("#addUserForm input").each(function(){
		
			if($(this).hasClass("vemail"))
			{
				var Regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(!Regex.test($(this).val()))
				{
					valid = false;
					$(this).addClass("ui-state-error");
				}		
				
				
			}
			else if($(this).hasClass("required"))
			{
				if($(this).val() =="")
				{
					valid = false;
					$(this).addClass("ui-state-error");
				}
			}
			
		
		});

		if(!valid){
			return false;
		}
	});



});
