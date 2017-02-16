$('#ordername').change(function (e) {
    $order = $(this).val();
    //console.log($order);
    $.post('api.php', { 'ordname': $order }).then(function (data) {
        //console.log(data);
        alert(data);
    });
});


//materials check supposed to return alert if materials.quantity in db is less than the input quantity or less than 10;
mCheck = function(el){
    $name = $(el).find('option:selected').text();
    $type = $(el).find('option:selected').data('type');
    $qnty = $(el).parents('tr').find('.pos-quantity').val();
    if($type == "materials"){
        $.post('api.php',{'pos-name1':$name, 'pos-quant':$qnty}).then(function(data){
        $alert(data);
    });
    }
};



posHandle = function(el){
    $name = $(el).find('option:selected').text();
    $type = $(el).find('option:selected').data('type');
    $.post('api.php',{'pos-name':$name,'type':$type}).then(function(data){
        $(el).parents('tr').find('.input-price').val(data);
    });
};

qtHandle = function (el) { //el = short of element
    $this = $(el);
    $quant = $this.val();
    $row = $this.parents('tr');
    $price = $row.find('.input-price').val();
    $row.find('.input-sum').val($quant * $price);

    $curr = $row.find('.input-sum').val($quant * $price); //expected dynamically calculated total sum of the order
    $tot = $('#sumtotal').val();
    $res = $curr + $tot;
    $('#sumtotal').val($curr+$tot);

    if ($row.is(':last-child')) { //I ♥ jQuery, it's like plain english
        $clone = $row.clone();
        $clone.find('input').val(null);
        $clone.find('input').prop('required', false);
        $clone.insertAfter($row);
        handleStuff(); //recursion! we have to call this again inside cause newly inserted rows are not watched by original .change()
    }
};

handleStuff = function() {
  $('.input-pos').change(function(event){
    posHandle(event.target);
  });

  $('.input-qnty').change(function(event){
    qtHandle(event.target);
  });
}

handleStuff();



