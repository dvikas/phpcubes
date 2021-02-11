 <?php
 //http://www.w3clubs.com/sp/hilite/PEAR/

 require_once 'Text/Highlighter.php';
 $hlSQL = Text_Highlighter::factory('SQL',array('numbers'=>true));
 echo $hlSQL->highlight('SELECT * FROM table a WHERE id = 12');
