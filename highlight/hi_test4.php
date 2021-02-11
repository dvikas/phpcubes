<?php
include_once 'init.inc.php';

$languages = array(
    'php', 'cpp', 'css', 'diff', 'dtd', 'javascript', 
    'mysql', 'perl', 'python', 'ruby', 'sql', 'xml'
);

if (!empty($_POST['text'])){
    
    if (empty($_POST['language']) || !in_array($_POST['language'], $languages)) {
        $_POST['language'] = $languages[0];
    }
    
    echo '<link rel="stylesheet" href="hilight.css" />';
    echo '<div style="border: solid 1px orange; padding: 20px; margin: 20px">';
    echo 'Highlighted as <strong>' . $_POST['language'] . '</strong>: ';
    
    require_once 'Text/Highlighter.php';
    require_once 'Text/Highlighter/Renderer/Html.php';

    $options = array(
            'numbers' => HL_NUMBERS_TABLE,
            'tabsize' => 4,
        );
    
    $renderer =& new Text_Highlighter_Renderer_HTML($options);
    $highlighter =& Text_Highlighter::factory($_POST['language']);
    $highlighter->setRenderer($renderer);
    echo $highlighter->highlight($_POST['text']);
    
    echo '</div>';
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <textarea name="text" style="width: 300px; height: 200px"><?php echo @$_POST['text']; ?></textarea>
    <br />
    The code is: 
    <select name="language">
        <?php
        foreach ($languages AS $l) {
            echo '<option';
            echo ($l == @$_POST['language']) ? ' selected="selected">' : '>';
            echo $l ,'</option>';
        }
        ?>
    </select>
    <input type="submit" />
</form>