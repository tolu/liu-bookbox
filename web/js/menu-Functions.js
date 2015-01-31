
	$(function() {

		
		$("#menu").tabs();

	$(".menuAjaxLink").live("click", function(){
      
      //show loader animation, add crazy class for easy selection
      $("#content").html($('#ajaxLoaderImage').clone().show().addClass('mongoBongo'));
      $('.mongoBongo').wrap('<div style="text-align:center;margin-top:5em;"></div>');
      
      var keyword = $(this).html();
      
			$("#content").load($(this).attr("href"),{}, function(){
        $('#content .ui-widget-header').find('b').html('Sökresultat: ⇒ '+keyword);
      });
			return false;

		});
		

	});
	
	