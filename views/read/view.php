<?php
/**
 * Created by PhpStorm.
 * User: alex_
 * Date: 14.01.2018
 * Time: 11:48
 */

?>
<style>
    .file-content{
        width: 100%;
        min-height: 700px;
    }

</style>

<textarea id="log-context-textarea" class="file-content">
    <?=$content?>
</textarea>
<script>
    var textArea = document.getElementById('log-context-textarea');
    textArea.scrollTop = textArea.scrollHeight;
</script>
