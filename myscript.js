posHandle = function(el){
    $name = $(el).find('option:selected').text();
    $type = $(el).find('option:selected').data('type');
    $.post('api.php',{'pos-name':$name,'type':$type}).then(function(data){
        $(el).parents('tr').find('.input-price').val(data);
    });
};

qtHandle = function(el) { //el = short of element
    $this = $(el);
    $quant = $this.val();
    $row = $this.parents('tr');
    $price = $row.find('.input-price').val();
    $row.find('.input-sum').val($quant*$price);
    if ($row.is(':last-child')) { //I ♥ jQuery, it's like plain english
      $clone = $row.clone();
      $clone.find('input').val(null);
      $clone.find('input').prop('required',false);
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
