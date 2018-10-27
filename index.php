<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <style>
    #content{
        font-size: 12px;
        color: #000000;
    }
</style>
<script>
    window.onload=function()
    {
        calcSumm();
    }

    function deleteRow(r)
    {
        var i=r.parentNode.parentNode.rowIndex;
        document.getElementById('table').deleteRow(i-1);
        count_rows--;
        num_rows--;
        npp();
        calcSumm();
    }

    function npp()
    {
        var inp = $('.form input[name^="num_pp"]');
        for(var i=0; i<inp.length;i++ )
        {
            inp[i].value=i+1;
        }
    }

    function calcSumm()
    {
        var completed = $('.form input[name^="completed"]');
        var checked_count = 0;
        for(var i = 0; i < completed.length; i++){
            if(completed[i].checked){
                checked_count++;
            }
        }
        $('input[name^="total"]').val(count_rows);
        $('input[name^="done"]').val(checked_count);
    }        
</script>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'todo-list-form',
    ));
    $count=0;
    $count_rows=0;?>
	       
        <h1><b>Список задач</b></h1></br>

        <table style="border:1px solid black;" >
            <thead>
                    <tr>
                        <th style="text-align: center;">№ п./п</th>
                        <th style="text-align: center;">Описание</th>
                        <th style="text-align: center;">Выполнено</th>
                        <th></th>
                    </tr>
            </thead>
            <tbody id="table"></tbody>
        </table>
<script>
    var newE=document.getElementById('table');
    
    newE.width="100%";
    var count_rows=0;
    var num_rows=1;


    function add_row()
    {
        var newRow=newE.insertRow(count_rows);
        var newCell = newRow.insertCell(0);
        newCell.innerHTML='<input type="text" name="num_pp_'+count_rows+'" size="3" value="'+num_rows+'" onkeypress="if(event.keyCode == 13) return false;"/>';
        var newCell = newRow.insertCell(1);
        newCell.innerHTML='<textarea  name="name_'+count_rows+'" onkeypress="if(event.keyCode == 13) {add_row(); return false;}" style="margin-bottom: -6px; height: 20px"/>';
        var newCell = newRow.insertCell(2);
        newCell.innerHTML='<input type="checkbox"  id="completed_'+count_rows+'" onclick="calcSumm();" name="completed">';
        var newCell = newRow.insertCell(3);
        newCell.innerHTML='<input type="button" value="Удалить" onclick="deleteRow(this)">'; 
        var newCell = newRow.insertCell(4);
        newCell.innerHTML='<input type="hidden" value="'+count_rows+'" name="count_rows">'; 

        count_rows++;
        num_rows++;

        calcSumm();
        
        var inp = $('.form textarea[name^="name"]');
        inp[inp.length-1].focus();
    }
</script>

<?php echo CHtml::Button('Добавить запись', array('onclick'=>'add_row(); return false;')); ?>
<?php echo CHtml::Button('Пересчитать', array('onclick'=>'npp(); return false;')); ?><br>
             
        <table style="border:1px solid black;" >
            <thead>
                    <tr>
                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"></th>
                    </tr>
            </thead>
            <tr>
                <td style="text-align: center; vertical-align: middle;">
                    <b>ИТОГО</b>
                </td>

                <td style="text-align: center;">
                        Всего
                </td>

                <td>
                    <input name="total" type="text" size="5" value="0" readonly>
                </td>

                <td style="text-align: center;">
                        Выполнено
                </td>

                <td>
                    <input name="done" type="text" size="5" value="0" readonly>
                </td>
            </tr>
        </table>

<?php $this->endWidget(); ?>

</div><!-- form -->
    </body>
</html>
