<?
function change_ptag_to_figure($text){
    
  $text = preg_replace( '!<p>\s*(<a [^>]+><img[^>]+></a>|<img[^>]+>)\s*</p>!', '<figure>$1</figure>', $text);
   return $text;
}
?>
