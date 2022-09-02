<?php
$db = mysqli_connect('localhost','root','root','mydb') or 
die(mysqli_connect_error());
mysqli_set_charset($db,'utf-8');

// mysqli_query($db,'INSERT INTO my_items SET maker_id=1,item_name="もも",price=210, keyword="缶詰,ピンク,甘い", sales=0,
// created="2010-08-01", modified="2010-08-01"') or die(mysqli_error($db));


$recordSet = mysqli_query($db,'SELECT * FROM my_items');
$data = mysqli_fetch_assoc($recordSet);

while($data = mysqli_fetch_assoc($recordSet)){
    echo $data['item_name'];
    echo '<br />';
}


?>