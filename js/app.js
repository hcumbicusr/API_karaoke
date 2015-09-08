$(document).ready(function(){
//    $("#btn_enviar").click(function(){
//        $.ajax({
//            type: "post",
//            url: "v1/pedidos/pedidos.php",
//            dataType: "json",
//            cache: false,
//            data: {
//                accion: "add",
//                id_table: $("#table").val(),
//                id_music: $("#music").val(),
//                fullname: "pedro perez",
//                email: "email@email.com",
//                level: "'2'"
//            },
//            beforesend: function(data) {
//                
//            },
//            success: function(result){
//                console.log(result.message)
//            }
//        });
//    });
    
    $("#btn_enviar").click(function(){
        $.ajax({
            type: "post",
            url: "v1/mesas/mesas.php",
            dataType: "json",
            cache: false,
            data: {
                accion: "add",
                number: $("#table").val(),
                id_music: $("#music").val(),
                fullname: "pedro perez",
                email: "email@email.com",
                level: "'2'"
            },
            beforesend: function(data) {
                
            },
            success: function(result){
                console.log(result.message)
            }
        });
    });
    
    $("#btn_lista").click(function(){
        $.ajax({
            type: "GET",
            url: "v1/pedidos/pedidos.php",
            dataType: "json",
            cache: false,
            data: {
                accion: "list",
                detalle: "mesa",
                param: $("#table").val(),
                id_music: $("#music").val(),
                fullname: "pedro perez",
                email: "email@email.com",
                level: "'2'"
            },
            beforesend: function(data) {
                
            },
            success: function(result){
                console.log(result.message)
            }
        });
    });
});