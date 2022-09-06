<link rel="stylesheet" href="style.css">
<?php
require('dbconnect.php');
$page = $_REQUEST['page'];
if($page==''){
    $page = 1;
}
$page = max($page,1);

$sql = 'SELECT COUNT(*) AS cnt FROM my_items';
$recordSet = mysqli_query($db,$sql);
$table = mysqli_fetch_assoc($recordSet);
$maxPage = ceil($table['cnt']/5);
$page = min($page,$maxPage);

$start = ($page-1)*5;


// mysqli_query($db,'INSERT INTO my_items SET maker_id=1,item_name="もも",price=210, keyword="缶詰,ピンク,甘い", sales=0,
// created="2010-08-01", modified="2010-08-01"') or die(mysqli_error($db));

/*データを順次に取り出す
$recordSet = mysqli_query($db,'SELECT * FROM my_items');
$data = mysqli_fetch_assoc($recordSet);

while($data = mysqli_fetch_assoc($recordSet)){
    echo $data['item_name'];
    echo '<br />';
}
*/

// $recordSet = mysqli_query($db,'SELECT * FROM my_items ORDER BY id DESC');
$recordSet = mysqli_query($db,'SELECT m.name,i.* FROM makers m,my_items i WHERE m.id = i.maker_id ORDER BY id DESC LIMIT ' .$start. ',5');

?>

<p><a href="input.php">新しい商品を登録する</a></p>

<table width="100%">
    <tr>
        <th>ID</th>
        <th>メーカー</th>
        <th>商品名</th>
        <th>価格</th>
        <th scope="col">編集・削除</th>
    </tr>
    <?php
        while($table = mysqli_fetch_assoc($recordSet)){
    ?>
    <tr>
        <td><?php print(htmlspecialchars($table['id'])); ?></td>
        <td><?php print(htmlspecialchars($table['name'])); ?></td>
        <td><?php print(htmlspecialchars($table['item_name'])); ?></td>
        <td><?php print(htmlspecialchars($table['price'])); ?></td>
        <td>
            <a href="update.php?id=<?php print(htmlspecialchars($table['id'])); ?>">編集</a>
            <a href="delete.php?id=<?php print(htmlspecialchars($table['id'])); ?>" onclick="return confirm('削除してもよろしいですか？');">削除</a>
        </td>
    </tr>
    <?php
        }
    ?>
</table>

<ul class="paging">
    <?php
    if($page > 1){
    ?>
        <li><a href="index.php?page=<?php print($page-1); ?>">前のページへ</a></li>
    <?php
    } else {
    ?>
    <li>前のページへ</li>
    <?php
    }
    ?>

    <?php
    if($page < $maxPage){
    ?>
    <li><a href="index.php?page=<?php print($page+1); ?>">次のページへ</a></li>
    <?php
    } else {
    ?>
    <li>次のページへ</li>
    <?php
    }
    ?>


</ul>