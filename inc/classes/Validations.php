<?php

trait Validations
{
   private array  $errors    = array();
   public  array  $validFile = array();

   public function hasError()
   {  return ((count($this->errors)) ? true : false);
   }

   public function setError(string $key, string $msgError)
   {  $this->errors[$key] = $msgError;
   }

   public function getError(string $key)
   {  return (($this->hasError() AND !empty($this->errors[$key])) ? $this->errors[$key] : '');
   }

   public function verifText($field, $key, $minSize, $maxSize, $obligatoire = true)
   {  if (empty($field))
      {  if ($obligatoire)
         {  $this->errors[$key] = 'Veuillez renseigner le champ ';
         }
      }
      elseif (mb_strlen($field) < $minSize)
      {  $this->errors[$key] = 'Veuillez saisir au moins ' . $minSize . ' caractères pour le champ ';
      }
      elseif (mb_strlen($field) > $maxSize)
      {  $this->errors[$key] = 'Saisie limitée à ' . $maxSize . ' caractères';
      }
   }

   public function verifFile($key, $obligatoire = true, $maxSize = 2000000, $validExtensions = array('jpg','jpeg','png','gif'), $validMimetypes = array('image/jpeg','image/png','image/jpg','image/gif'))
   {  $imageIn = $_FILES[$key];
      $ext = '';
      $nameOriginal = '';

      if (empty($imageIn))
      {  if ($obligatoire)
         {  $this->errors[$key] = 'Veuillez choisir une image';
         }
      }
      else
      {  if ($imageIn['error'] > 0)
         {  if ($imageIn['error'] != 4)
            {  $this->errors[$key] = 'Erreur fichier ' . $_FILES[$key]['error'];
            }
            else
            {  if ($obligatoire)
               {  $this->errors[$key] = 'Aucune image n\'a été téléchargée';
               }
            }
         }
         else
         {  $file_name = $imageIn['name']; // le nom du fichier
            $file_size = $imageIn['size']; // taille (peu fiable)
            $file_tmp = $imageIn['tmp_name']; // chemin fichier temporaire
            // verif taille du fichier
            if ($file_size > $maxSize OR filesize($file_tmp) > $maxSize)
            {  $this->errors[$key] = 'Le fichier est trop gros (max ' . $maxsize . 'o)';
            }
            else
            // les extensions
            {  $path = pathinfo($file_name);
               $ext = $path['extension'];
               $nameOriginal = $path['filename'];
               // verif de l'extension
               if (!in_array($ext, $validExtensions))
               {  $this->errors[$key] = 'Veuillez télécharger une image de type jpg ou jpeg ou png ou gif';
               }
               else
               // verif du mimetype
               {  $finfo = finfo_open(FILEINFO_MIME_TYPE);
                  $mimeType = finfo_file($finfo, $file_tmp);
                  finfo_close($finfo);
                  if (!in_array($mimeType, $validMimetypes))
                  {  $this->errors[$key] = 'Veuillez télécharger une image de type jpg ou jpeg ou png ou gif';
                  }
               }
            }
         }
      }
      $this->validFile['ext'] = $ext;
      $this->validFile['nameOriginal'] = $nameOriginal;
   }

   public function verifCodePostal($codepostal, $key, $obligatoire = true)
   {  $pattern = '/^(([0-8][0-9])|(9[0-5])|(9[7-8]))[0-9]{3}$/';
      if (empty($codepostal))
      {  if ($obligatoire)
         {  $this->errors[$key] = 'Veuillez renseigner le code postal';
         }
      }
      elseif (!preg_match($pattern, $codepostal))
      {  $this->errors[$key] = 'Code postal invalide';
      }
   }

   public function verifInt($value, $key, $min, $max, $obligatoire = true)
   {  if (filter_var($value, FILTER_VALIDATE_INT) === 0 OR filter_var($value, FILTER_VALIDATE_INT))
      {  if ($value < $min)
         {  $this->errors[$key] = 'Le champ ' . $key . ' doit être supérieur à ' . $min;
         }
         elseif ($value > $max)
         {  $this->errors[$key] = 'Le champ ' . $key . ' doit être inférieur à ' . $max;
         }
      }
      else
      {  if (empty($value))
         {  if ($obligatoire)
            {  $this->errors[$key] = 'Veuillez renseigner le champ ' . $key;
            }
         }
         else
         {  $this->errors[$key] = 'Le champ ' . $key . ' doit être un nombre entier';
         }
      }
   }

   public function verifSelect($value, $key, $obligatoire = true)
   {  if (empty($value) AND $obligatoire)
      {  $this->errors[$key] = 'Veuillez choisir une option';
      }
   }

   public function verifPassword($value, $key)
   {  if (empty($value))
      {  $this->errors[$key] = 'Veuillez saisir votre mot de passe';
      }
   }

   public function verifMail($value, $key, $obligatoire = true)
   {  if (empty($value))
      {  if ($obligatoire)
         {  $this->errors[$key] = 'Veuillez renseigner l\'adresse mail';
         }
      }
      elseif (!filter_var($value, FILTER_VALIDATE_EMAIL))
      {  $this->errors[$key] = 'Adresse mail invalide';
      }
   }

} // class Validation
