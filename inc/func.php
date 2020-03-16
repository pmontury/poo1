<?php

function br()
{  echo '<br>';
}

function debug($array)
{  echo '<pre>';
   print_r($array);
   echo '</pre>';
}

function debug2($array)
{  echo '<pre>';
   var_dump($array);
   echo '</pre>';
}

function getRequestValue($key)
{  if (isset($_REQUEST[$key]) OR !empty($_REQUEST[$key]))
      return htmlspecialchars(stripslashes(trim($_REQUEST[$key])));
   else
      return false;
}
