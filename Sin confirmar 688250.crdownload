$(document).ready(function(){

$('#area').on('change',function(){
    var id_area = $(this).val();
    if(id_area){
    $.ajax({
        type:'POST',
        url: 'ajax.php',
        data: 'idArea='+ id_area, 
        success:function(html){
            $('#operacion').html(html);
            $('#complejidad').html(html);                   
                                }
            });
                } 
        else {
    $('#operation').html('<option value ="">Selecciona Area primero</option>');
             }
                                });
    
    $('#operacion').on('change',function(){
    var id_operacion = $(this).val();
    if(id_operacion){
    $.ajax({
        type:'POST',
        url: 'ajax.php',
        data: 'idOperacion='+id_operacion, 
        success:function(html){
            $('#complejidad').html(html);                   
        }
            });
                }  
                 });

                         });
    




    $(document).ready(function(){
    $('#idEmpleado').on('change', function(){
    var id_empleado = $(this).val();
    if(id_empleado){
    $.ajax({
        type: 'POST', 
        url: 'ajax2.php',
        data: 'idEmpleado=' +id_empleado, 
        success: function(html){
            $('#nameEmpleado').html(html);
            $('#idArea').html('<option value ="">SELECCIONA NOMBRE DE EMPLEADO PRIMERO</option>');
           
            
        }               
            });
                    } 
                    
                    });
                                


                         });



