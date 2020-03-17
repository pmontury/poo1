<?php

   class Log
   {
      // Le mot clé static précise que l'on peut appeler la méthode sans instancier l'objet
      static function logWrite(string $data)
      {  $dir = 'logs/';
         if(!is_dir("logs"))
         {  mkdir("logs");
         }
         $file = date('Y-m-d') . '-log';
         $path =  $dir . $file;
         $data = date('H:i:s') . '-' . $data . PHP_EOL;
         $handle = fopen($path, 'a');

         if (flock($handle, LOCK_EX))
         {  fwrite($handle, $data);
            flock($handle, LOCK_UN);
         }
         fclose($handle);
      }

   }  // class Log
