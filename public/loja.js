$(document).ready(function () {
    $network = "undefined";
    $data = 
    {
    teste: "teste de mustache",
    }
    $('#box').append($data.teste);

    $('#getLojas').click(function (e) { 
        e.preventDefault();
        
            if ($network == "undefined"){

                
            $.ajax({
                dataType:"json",
                type: "GET",
                url: "http://localhost/code/loja",
                data: "",
                success: function (data) {
                    console.log(data);
                    lojas = data;
                    $network = data;
                    if ($('.table').text("")){
                    $.each(lojas,function(i, loja){
                    $('.table').append("<tbody><tr><td>"
                    +lojas[i].id+"</td><td>"+lojas[i].nome+"</td><td>"+lojas[i].telefone+
                    "</td><td>"+lojas[i].endereco+"</td></tr></tbody>");
                    });
                    $('.table').prepend('<thead><tr>'+
                      '<th scope="col">ID</th>'+
                      '<th scope="col">NOME</th>'+
                      '<th scope="col">TELEFONE</th>'+
                      '<th scope="col">ENDERECO</th>'+
                     '</tr></thead>');
                    }

                }
                ,
                error: function (data) {
                    alert('Erro na requisicao');
                    // em caso de erro...
                },
                complete: function(){
                
                }
                
            });
            }
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
