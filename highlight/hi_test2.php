<?php
include_once 'init.inc.php';

if (!empty($_POST['text'])){
    
    echo '<link rel="stylesheet" href="hilight.css" />';
    echo '<div style="border: solid 1px orange; padding: 20px; margin: 20px">';
    
    require_once 'Text/Highlighter.php';
    $highlighter =& Text_Highlighter::factory('php');
    echo $highlighter->highlight($_POST['text']);
    
    echo '</div>';
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <textarea name="text" style="width: 300px; height: 200px"><?php echo @$_POST['text']; ?></textarea>
    <br />
    <input type="submit" />
</form>