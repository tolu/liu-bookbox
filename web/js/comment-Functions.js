$(function() {
	
  $('#commentFieldForm input').live('click', submitComment);
  $(".removeCommentBtn").live('click', removeComment);
  
  function submitComment()
  {
    var sendPath = $(this).parent().attr("action");
		var redirPath = $(this).parent().attr("redir");
    
		$.post(sendPath, {commentContent : $("#commentContent").val()},function(){
      $('#infoBoxContent').load(redirPath);
    });

    return false;
  }
	
  function removeComment(){
    if(confirm("Vill du verkligen ta bort kommentaren?"))
    {
      var removePath = $(this).attr("href");
      $(this).parent().fadeTo("slow", 0.33);
    
      $.get(removePath);
      $(this).parent().html("Kommentaren borttagen");
    }
    return false;
  }
  
});