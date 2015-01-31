	$(function() {
    
		$(".courseListWidget-item").droppable({
			accept: ".book",
			hoverClass: 'ui-state-hover',

			tolerance: 'pointer',
		//	activeClass: 'ui-state-hover',
			drop: function(event, ui) {
		//		addTocart(ui.draggable);
		//alert(ui.draggable.attr("id")+"€"+$(this).attr("id"));	
		$(this).append("<div id='test' style='display:none'></div>")	
		$(this).find("#test").load($(this).attr("redir"),{'courseId': $(this).attr("id"), 'isbn10': ui.draggable.attr("id")  ,'year': "2009"});
			}


		});
	});