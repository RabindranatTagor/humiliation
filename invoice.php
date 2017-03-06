<?php
    require 'init.php';

    include $root.'/header.php';
?>

		<p class = "inv-txt">
			<strong>Организация: ООО «Росдорзнак»</strong>
		</p>
		<hr class = "black-line">
		<p class = "inv-txt">
			<strong>тел.8 (3452) 60-30-21</strong>
		</p>
        <div class ="hat">
            <div class="col-md-7">
                <div class="row">
                    ИНН 7203283131
                    КПП 720301001
                </div>
                <div class="row">
                    Получатель
                    ООО "Росдорзнак"
                </div>
                <div class="row">
                    Банк получателя
                    ФИЛИАЛ "Екатеринбургский" АО "АЛЬФА-БАНК"
                    г.Екатеринбург
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    Расч.Сч. №
                </div>
                <div class="row">
                    БИК
                </div>
                <div class="row">
                    Кор.Сч. №
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    40702810838320000386                
                </div>
                <div class="row">
                    046577964                
                </div>
                <div class="row">
                    30101810100000000964                
                </div>
            </div>
        </div>
        <p class = "inv-txt"><strong>СЧЕТ № $ORDER_NAME<br> от $ORDER_DATE</strong></p>
        <p class = "inv-txt"><strong>Поставщик:</strong> ООО "Росдорзнак" 625000, г.Тюмень, ул. Герцена, 72, оф. 409</p>
        <hr class="black-line">
        <p class = "inv-txt"><strong>Покупатель:</strong> $CUSTOMER_NAME ИНН/КПП $INN/$KPP</p>
        
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
                <tr>
                    <td>$COUNTER</td>
                    <td>$OP_NAME</td>
                    <td>$OP_QNTY</td>
                    <td>$OP_PRICE</td>
                    <td>$OP_QNTY*$OP_PRICE</td>
                </tr>
                <tr>
                    <td><strong>ИТОГО:</strong></td>
                    <td>$ORDER_SUM</td>
                </tr>
                <tr>
                    <td><strong>В т.ч. НДС</strong></td>
                    <td>0</td>
                </tr>
            </tbody>
        </table>
        <div class="add-info">
            <p class="inv-txt">К оплате: $ORDER_SUM прописью</p>
            <hr class="black-line">
            <p class="inv-txt">Примечание</p>
        </div>

        <p class="inv-txt">Руководитель  предприятия                                                            А. В. Палкин<br>

                           Главный бухгалтер:                                                                   А. В. Палкин
        </p>
        
<?php
include $root.'\footer.php';
?>