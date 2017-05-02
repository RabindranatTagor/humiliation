<?php
    ini_set('display_errors','On');
     error_reporting('E_ALL');
    require 'init.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/TimeHelper.php';

    $id = $_REQUEST['id'];
    //order query
    $query = "SELECT * FROM zakaz WHERE idzakaz = $id";
    if ($result = mysqli_query($link, $query)) {
      $order = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
    } else echo '<br>MySQLi error: '.mysqli_error($link);
    //customer query
    $custid = $order['customer'];
    $query = "SELECT * FROM customers WHERE id = $custid";
    if ($result = mysqli_query($link, $query)) {
      $cust = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
    } else echo '<br>MySQLi error: '.mysqli_error($link);
    //positions query
    $query = "SELECT zakaz_contents.quantity, materials.name, materials.price FROM zakaz_contents, materials WHERE zakaz_contents.id_materials = materials.idmaterials AND zakaz_contents.idzakaza='$id'
              UNION ALL
              SELECT zakaz_contents.quantity, road_signs_catalog.name, road_signs_catalog.price FROM zakaz_contents, road_signs_catalog WHERE zakaz_contents.id_road_signs = road_signs_catalog.idroad_signs_catalog AND zakaz_contents.idzakaza='$id'";
    if ($result = mysqli_query($link, $query)) {
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
             $rows[] = $row;
             }
    } else echo '<br>MySQLi error: '.mysqli_error($link);
    $ORDER_NAME     = $order['name'];
    $ORDER_SUM      = $order['sum'];
    $CUSTOMER_NAME  = $cust['name'];
    $INN            = $cust['INN'];
    $KPP            = $cust['KPP'];
    $COUNTER        = 1;
    // setlocale(LC_ALL, 'ru-RU');
    $mydate = strtotime($order['date']);
    $fdate = date('Y-m-d', $mydate);

    $RUDATE = TimeHelper::create($fdate, 'Y-m-d')->longDate(true, false);

    ini_set('display_errors','Off');
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="/invoice.css" />

<article id="invoice">

		<h4 class = "inv-txt">
			Организация: ООО «Росдорзнак»
		</h4>
		<hr class = "black-line">
		<strong>тел.8 (3452) 60-30-21</strong>
    <table>
      <tr colspan="2">
        <td>
          ИНН 7203283131
        </td>
        <td>
          КПП 720301001
        </td>
        <td rowspan="2">
          Расч.Сч.<br>№
        </td>
        <td rowspan="2">
          40702810838320000386
        </td>
      </tr>
      <tr>
        <td colspan="2">
          Получатель<br><br>
          ООО "Росдорзнак"
        </td>
      </tr>
      <tr>
        <td rowspan="2" colspan="2">
          Банк получателя<br>
          ФИЛИАЛ "Екатеринбургский" АО "АЛЬФА-БАНК"<br>
          г.Екатеринбург
        </td>
        <td>
          БИК
        </td>
        <td>
          046577964
        </td>
      </tr>
      <tr>
        <td>
          Кор.Сч. №
        </td>
        <td>
          30101810100000000964
        </td>
      </tr>
    </table>



        <p class = "inv-txt"><strong>СЧЕТ №<?php echo $ORDER_NAME ?><br> от <?php echo "$RUDATE г."?></strong></p>
        <p class = "inv-txt"><strong>Поставщик:</strong> ООО "Росдорзнак" 625000, г.Тюмень, ул. Герцена, 72, оф. 409</p>
        <hr class="black-line">
        <p class = "inv-txt"><strong>Покупатель:</strong> <?php echo $CUSTOMER_NAME ?> ИНН/КПП <?php echo $INN.'/'.$KPP ?></p>

        <table>
            <thead>
                <tr>
                    <th>
                        №п/п
                    </th>
                    <th>
                        Наименование
                    </th>
                    <th>
                        Кол-во
                    </th>
                    <th>
                        Цена
                    </th>
                    <th>
                        Стоимость
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $row){?>
                <tr>
                    <td><?php echo $COUNTER++ ?></td>
                    <td><?php echo $row[1] ?></td>
                    <td><?php echo $row[0] ?></td>
                    <td><?php echo $row[2] ?></td>
                    <td><?php echo $row[2]*$row[0]?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td rowspan="2" colspan="3" class="unseen"></td>
                    <td><strong>ИТОГО:</strong></td>
                    <td><?php echo $ORDER_SUM ?></td>
                </tr>
                <tr>
                    <td><strong>В т.ч. НДС</strong></td>
                    <td>0</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
          Руководитель  предприятия                                                            <span class="execname">А. В. Палкин</span>
        </div>

        <div class="footer">
          Главный бухгалтер:                                                                   <span class="execname">А. В. Палкин</span>
        </div>

      </article>
