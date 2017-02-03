$('#posiziya').change(function(e){ 
    $name = $(this).find('option:selected').text(); 
    $type = $(this).find('option:selected').data('type'); 
    // console.log($name, $type); 
    $.post('api.php',{'pos-name':$name,'type':$type}).then(function(data){ 
        // console.log(data); 
        $('#price').val(data); 
    }) 
});

$('#qnty').change(function (s) {
    $quant = $(this).val();
    $price = $('#price').val();
    $payload = new Object;
    $payload["pos-quantity"] = $quant;
    $payload["price"] = $price;
    $.post('api.php', $payload).then(function (res) { //got to send price back to api; lame but will do
        console.log(res);
        $('#sum').val(res);
    })
});