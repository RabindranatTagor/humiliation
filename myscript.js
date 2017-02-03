$('#posiziya').change(function(e){ 
    $name = $(this).find('option:selected').text(); 
    $type = $(this).find('option:selected').data('type'); 
    // console.log($name, $type); 
    $.post('api.php',{'pos-name':$name,'type':$type}).then(function(data){ 
        // console.log(data); 
        $('#price').val(data); 
    }) 
});

$('#qnty').change(function(s){
    $quant = $(this).val();
    $.post('api.php', 'pos-quantity':$quant).then(function(res){
        $('#sum').val(res);
    })
});