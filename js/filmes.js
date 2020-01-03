$(function(){
	$("#btnLoad").click(function(){
		var id_filme = $("#id_filme").val();
		var url = "services/comentarios.php?id_filme="+id_filme;
		
		$.ajax({
			url:url,
			method: 'POST',
			dataType: 'json',
			sucess: function(retorno){
				console.log(retorno)
				
				$("#tempComentarios").remove();
				
				var html = ""; 
				for(var i = 0; i < retorno.lenght; i++){
					html += ` 


					<div class="coment">
					<p>Data: ${retorno[i].data}</p>

					<h5 id="nomeComent">Nome: ${retorno[i].autor}</h5>
					<h5>Mensagem</h5>
					${retorno[i].texto}
					<br><br>
					</div>
					`;
				}
				$(".loadComentarios").html(html);
			}

		});
	});
	
});
alert(teste);