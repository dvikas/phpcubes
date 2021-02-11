<?php
class HightLightHtlmlJs
{
    private $pointer = 0; //Cursor position.
    private $content = null; //content of document.
    private $colorized = null;

    function setContent($curDocName){
      $docHandle = fopen($curDocName,"r");
      $docStrContent = fread($docHandle,filesize($curDocName));
      fclose($docHandle);
      $this->content = $docStrContent;
    }

    function colorComment($position){
        $buffer = "&lt;<span class='HTMLComment'>";
        for($position+=1;$position < strlen($this->content) && $this->content[$position] != ">" ;$position++){
            $buffer.= $this->content[$position];
        }
        $buffer .= "</span>&gt;";
        $this->colorized .= $buffer;
        return $position;
    }
    function colorTag($position){
        $buffer = "&lt;<span class='tagName'>";
        $coloredTagName = false;
        //As long as we're in the tag scope
        for($position+=1;$position < strlen($this->content) && $this->content[$position] != ">" ;$position++){
            if($this->content[$position] == " " && !$coloredTagName){
                $coloredTagName = true;
                $buffer.="</span>";
            }else if($this->content[$position] != " " && $coloredTagName){
                //Expect attribute
                $attribute = "";
                //While we're in the tag
                for(;$position < strlen($this->content) && $this->content[$position] != ">" ;$position++){
                    if($this->content[$position] != "="){
                        $attribute .= $this->content[$position];
                    }else{
                        $value="";
                        $buffer .= "<span class='tagAttribute'>".$attribute."</span>=";
                        $attribute = ""; //initialize it
                        $inQuote = false;
                        $QuoteType = null;
                        for($position+=1;$position < strlen($this->content) && $this->content[$position] != ">" && $this->content[$position] != " "  ;$position++){
                            if($this->content[$position] == '"' || $this->content[$position] == "'"){
                                $inQuote = true;
                                $QuoteType = $this->content[$position];
                                $value.=$QuoteType;
                                //Read Until next quotation mark.
                                for($position+=1;$position < strlen($this->content) && $this->content[$position] != ">" && $this->content[$position] != $QuoteType  ;$position++){
                                    $value .= $this->content[$position];
                                }
                                $value.=$QuoteType;
                            }else{//No Quotation marks.
                                $value .= $this->content[$position];
                            }
                        }
                        $buffer .= "<span class='tagValue'>".$value."</span>";
                        break;
                    }

                }
                if($attribute != ""){$buffer.="<span class='tagAttribute'>".$attribute."</span>";}
            }
            if($this->content[$position] == ">" ){break;}else{$buffer.= $this->content[$position];}

        }
        //In case there were no attributes.
        if($this->content[$position] == ">" && !$coloredTagName){
            $buffer.="</span>&gt;";
            $position++;
        }
        $this->colorized .= $buffer;
        return --$position;
    }
    function colorize($filePath){
        $this->setContent($filePath);
        $this->colorized="";
        $inTag = false;
        for($pointer = 0;$pointer<strlen($this->content);$pointer++){
            $thisChar = $this->content[$pointer];
            $nextChar = $this->content[$pointer+1];
            if($thisChar == "<"){
                if($nextChar == "!"){
                    $pointer = $this->colorComment($pointer);
                }else if($nextChar == "?"){
                    //colorPHP();
                }else{
                    $pointer = $this->colorTag($pointer);
                }
            }else{
                $this->colorized .= $this->content[$pointer];
            }
        }

        $this->colorized = str_replace('(','<span class="parenthesis">(</span>' ,$this->colorized);
        $this->colorized = str_replace(')','<span class="parenthesis">)</span>' ,$this->colorized);
        $this->colorized = str_replace('{','<span class="braces">{</span>' ,$this->colorized);
        $this->colorized = str_replace('}','<span class="braces">}</span>' ,$this->colorized);
        $this->colorized = str_replace('document','<span class="tagName">document</span>' ,$this->colorized);
        $this->colorized = str_replace('ready','<span class="tagAttribute">ready</span>' ,$this->colorized);
        $this->colorized = str_replace('alert','<span class="tagAttribute">alert</span>' ,$this->colorized);
        $this->colorized = str_replace('if ','<span class="tagValue">if </span>' ,$this->colorized);
        $this->colorized = str_replace('else ','<span class="tagValue">else </span>' ,$this->colorized);
        $this->colorized = str_replace('for ','<span class="tagValue">for </span>' ,$this->colorized);
        $this->colorized = str_replace('function','<span class="tagValue">function</span>' ,$this->colorized);
        $this->colorized = str_replace('html()','<span class="tagValue">html()</span>' ,$this->colorized);
        $this->colorized = str_replace('val()','<span class="tagValue">val()</span>' ,$this->colorized);

        $this->colorized = str_replace('click','<span class="funName">click</span>' ,$this->colorized);
        $this->colorized = str_replace('hasClass','<span class="funName">hasClass</span>' ,$this->colorized);
        $this->colorized = str_replace('addClass','<span class="funName">addClass</span>' ,$this->colorized);
        $this->colorized = str_replace('removeClass','<span class="funName">removeClass</span>' ,$this->colorized);
        $this->colorized = str_replace('next','<span class="funName">next</span>' ,$this->colorized);
      //  $this->colorized = str_replace('parent','<span class="funName">parent</span>' ,$this->colorized);
        $this->colorized = str_replace('find','<span class="funName">find</span>' ,$this->colorized);
      //  $this->colorized = str_replace('children','<span class="funName">children</span>' ,$this->colorized);
        $this->colorized = str_replace('closest','<span class="funName">closest</span>' ,$this->colorized);

        $this->colorized = str_replace('each','<span class="funName">each</span>' ,$this->colorized);
        $this->colorized = str_replace('(this)','<span class="funName">(this)</span>' ,$this->colorized);
        $this->colorized = str_replace('var ','<span class="funName">var </span>' ,$this->colorized);
        $this->colorized = str_replace('return ','<span class="funName">return </span>' ,$this->colorized);
        $this->colorized = str_replace('$','<span class="funName">$</span>' ,$this->colorized);
        $this->colorized = str_replace('option ','<span class="tagName">option </span>' ,$this->colorized);

        return "<pre>".html_entity_decode(htmlentities( $this->colorized))."</pre>";
    }
}
