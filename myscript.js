$('.input-pos').change(function(e){
    $name = $(this).find('option:selected').text();
    $type = $(this).find('option:selected').data('type');
    $this = $(this); //$(this) = $('.input-pos)', storing it in var required to use it in a wrap velow
    $.post('api.php',{'pos-name':$name,'type':$type}).then(function(data){
        $this.parents('tr').find('.input-price').val(data);
    })
});

$('.input-qnty').change(function() {
    $this = $(this);
    $quant = $this.val();
    $row = $this.parents('tr');
    $price = $row.find('.input-price').val();
    $row.find('.input-sum').val($quant*$price);
    if ($row.is(':last-child')) { //I love jQuery, it's like plain english
      $clone = $row.clone();
      $clone.find('input').val(null);
      $clone.insertAfter($row);
    }
    //DEGENERATION BELOW
    // $payload = {};
    // $payload["pos-quantity"] = $quant;
    // $payload["price"] = $price;
    // $.post('api.php', $payload).then(function (res) {
    //     $this.parents('tr').find('.input-sum').val(res);
    // })
});


$('#demo-form2').submit(function (e) { //use submit() instead of click() and it's bound to the form itself, not the button
    e.preventDefault(); //e is the default browser submit event, it's prevented
    $record = $(this).serializeArray(); //auto collects form data into array;
    $record.push({type:$('#posiziya').find('option:selected').data('type')});
    console.log($record);
    $.post('api.php', $record).then(function (res) {
        console.log(res);
    });
})
