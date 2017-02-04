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
    $payload = {}; //the same as new Object;
    $payload["pos-quantity"] = $quant;
    $payload["price"] = $price;
    $.post('api.php', $payload).then(function (res) { //got to send price back to api; lame but will do
        //console.log(res);
        $('#sum').val(res);
    })
});

//$(document).ready(function () { //you dont really need document-ready wrap when your script is initilized in the footer
$('#demo-form2').submit(function (e) { //use submit() instead of click() and it's bound to the form itself, not the button
    e.preventDefault(); //e is the default browser submit event, it's prevented
    $record = $(this).serializeArray(); //auto collects form data into array;
    $record.push({type:$('#posiziya').find('option:selected').data('type')});    
    console.log($record);
    $.post('api.php', $record).then(function (res) {
        console.log(res);
    });
})
//});