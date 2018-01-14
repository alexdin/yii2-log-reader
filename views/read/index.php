<?php
/**
 * Created by PhpStorm.
 * User: alex_
 * Date: 14.01.2018
 * Time: 13:20
 */

/** @var $this \yii\web\View */
/** @var $models array
 * $data[]=[
 * 'name'=>$filePath,
 * 'last_modif'=>filemtime($filePath),
 *   ];
 */
?>

<table class="table">
    <tr>
        <td>Name</td>
        <td>Last Modify</td>
        <td>Action</td>
    </tr>

    <?php foreach ($models as $id=>$log) { ?>
            <tr>
                <td><?=$log['name']?></td>
                <td><?=date("Y-m-d H:i:s",$log['last_modif'])?></td>
                <td>

                    <a href="/log-reader/read/view?id=<?=$id?>&lines=300" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-facetime-video"></span> last 300 lines
                    </a>
                    <a href="/log-reader/read/view-full?id=<?=$id?>" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-file"></span> Full file
                    </a
                </td>
            </tr>
    <?php }?>

</table>

