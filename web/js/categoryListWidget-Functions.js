	$(function() {
    
		$(".categoryListWidget-item").droppable({
			accept: ".book",
			hoverClass: 'ui-state-hover',

			tolerance: 'pointer',
			drop: function(event, ui) {
	
		$(this).find("#test").load($(this).attr("redir"),{'categoryId': $(this).attr("id"), 'isbn10': ui.draggable.attr("id")  ,'year': "2009"});
			}


		});
	});