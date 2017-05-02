//check uniqueness
$('#ordername').change(function (e) {
    $order = $(this).val();
    //console.log($order);
    $.post('api.php', { 'ordname': $order }).then(function (data) {
        //console.log(data);
        if(data){
            $('#name-info').text(data);
            $('#name-alert').fadeIn(300);
        }

    });
});


//materials check supposed to return alert if materials.quantity in db is less than the input quantity or less than 10;
mCheck = function (el) {
    $row = $(el).parents('tr'); //wrapping el in $() makes it a jQuery object which is required to use jQuery magic like .parents() or .val()
    $name = $row.find('option:selected').text();
    $type = $row.find('option:selected').data('type');
    $qnty = $(el).val();
    if ($type == "materials") {
        $.post('api.php', { 'pos-name2': $name, 'pos-quant': $qnty }).then(function (data) {
            if(data){
                $('#qnty-info').text(data);
                $('#qnty-alert').fadeIn(300);
            }
        });
    }
};

//removal

rmRow = function(el){
    $this = $(el);
    $row = $this.parents('tr');
    $this.click(function () {
        $row.remove();
    });
}

posHandle = function (el) {
    $name = $(el).find('option:selected').text();
    $type = $(el).find('option:selected').data('type');
    $.post('api.php', { 'pos-name': $name, 'type': $type }).then(function (data) {
        $(el).parents('tr').find('.input-price').val(data);
        $(el).parents('tr').find('#from-table').val($type);
    });

    $row = $(el).parents('tr');

};

qtHandle = function (el) { //el = short of element
    $this = $(el);
    $quant = $this.val();
    $row = $this.parents('tr');
    $price = $row.find('.input-price').val();
    $curr = parseInt($quant * $price); //parse a number from a string
    $row.find('.input-sum').val($curr);

    $tot = 0;
    $('.input-sum').each(function () {
        $tot += $(this).val()*1;
    });
    $('#sumtotal').val($tot);


    if ($row.is(':last-child')) { //I ♥ jQuery, it's like plain english
        $clone = $row.clone();
        $clone.find('input').val(null);
        $clone.find('input').prop('required', false);
        $clone.insertAfter($row);
        handleStuff(); //recursion! we have to call this again inside cause newly inserted rows are not watched by original .change()
    }
};

handleStuff = function () {
    $('.input-pos').change(function (event) {
        posHandle(event.target);
    });

    $('.input-qnty').change(function (event) {
        qtHandle(event.target);
        mCheck(event.target); //binding the function to quantity change event
    });

    $('.remove').click(function (event) {
        rmRow(event.target);
    });
}

handleStuff();


//show div in newtovar
$('input.goods').on('ifChecked', function(event){ //event provided by iCheck plugin used in the template
  $type = $(this).val();
  console.log($type);
  if ($type == "materials") {
      $('#for-rsc').hide();
      $('#for-mats').fadeIn(300);
  }
  else if ($type == "road_signs_catalog") {
      $('#for-mats').hide();
      $('#for-rsc').fadeIn(300);
  }
});

//print iframe contents
$('#printgen').click(function(event){
    var iframe = $('#invoiceframe')[0];
    iframe.contentWindow.print();
});

//print pdf - jspdf or dompdf???
