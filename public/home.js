$(document).ready(function () {
    $data = 
    {
    teste: "teste de mustache",
    }
    $('#box').append($data.teste);

    $('#getLojas').click(function (e) { 
        e.preventDefault();

        $.ajax({
            dataType:"json",
            type: "GET",
            url: "http://localhost/code/loja",
            data: "",
            success: function (data) {
                console.log(data);
            //     if ($('#listaLojas').text("")){
            //     $.each(data, function(i, loja) {
            //         $('#listaLojas').append("<tbody><tr><td>"+loja[i].id+"</td>"+"<td>"+loja[i].nome+"</td>"+
            //         "<td>"+loja[i].endereco+"</td>"+"<td>"+loja[i].telefone+"</td></tr></tbody>");
            //     });
            // }
            $('#listaLojas').append('<h1> teste </h1>');
            },
            error: function (data) {
                alert('Erro na requisicao');
                // em caso de erro...
            },
            complete: function(){
               
            }
        });  
    });
    $('#getProdutos').click(function (e) { 
        e.preventDefault();

        $.ajax({
            dataType:"json",
            type: "GET",
            url: "http://localhost/code/produto",
            data: "",
            success: function (data) {
                console.log(data);
               
                
            },
            error: function (data) {
                alert('Erro na requisicao');
                // em caso de erro...
            },
            complete: function(){
               
            }
        });  
    });
    
    $("#linkTeste").click(function(e){
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: 'req.php',
            data:'req',
            success: function (data) {
                console.log(data);
                var texto = data;
                $('#ajax01').append("<p>"+texto+"</p>");
            },
            error: function (data) {
                alert('Erro na requisicao');
                // em caso de erro...
            },
            complete: function(){
                // ao final da requisição...
                
            }
        });
    });
    
    
});
