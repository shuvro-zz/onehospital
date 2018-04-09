$(document).ready(function(){
	var lote = new Lote("Lote");
	lote.newLote();
	processing();
	$.ajax({
			url: ajax,
			type: "post",
			data: {"caso":"inventario"},
			error: function(){
				window.location = "?view=hierro";
			},
			success: function(raw){
				var inventario = $.parseJSON(raw);
				var search = new userSelect("inventario",inventario, lote);
				search.show();
				unprocessing();
			}
	});
	
});