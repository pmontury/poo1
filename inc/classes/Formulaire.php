<?php

class Formulaire
{
   use Validations;

   // les propriétés
   protected string  $action;
   protected string  $method;
   protected string  $enctype;
   protected string  $class;
   protected string  $id;
   protected array   $inputs;

   // Constructors pour les paramètres que l'on passe à l'objet à l'instanciation
   public function __construct(string $iniFile, string $url = '#', string $formEnctype = '', string $formClass = '', string $formId = '', string $formMethod = 'post')
   {  $this->inputs  = parse_ini_file($iniFile, true);
      $this->action = $url;
      $this->method = $formMethod;
      $this->enctype = $formEnctype;
      $this->class = $formClass;
      $this->id = $formId;
   }

   public function getRequestValue($key)
   {  if (isset($_REQUEST[$key]) OR !empty($_REQUEST[$key]))
         return htmlspecialchars(stripslashes(trim($_REQUEST[$key])));
      else
         return false;
   }

   private function addLabel(array $input)
   {  $label = $input['label'];
      $validation = $input['validation'];
      $name = ((!empty($label['name'])) ? $label['name'] : '');
      $texte = ((!empty($label['texte'])) ? $label['texte'] : '');
      if(!empty($texte) AND !empty($validation['obligatoire']) AND $validation['obligatoire'])
      {  $texte .= '<span>*</span>';
      }
      $class = ((!empty($label['class'])) ? $label['class'] : '');
?>
      <label class="<?= $class ?>" for="<?= $name ?>"><?= $texte?></label>
<?php
   }

   private function addInput(array $input)
   {  $name = ((!empty($input['name'])) ? $input['name'] : '');
      $id = ((!empty($input['id'])) ? $input['id'] : $input['name']);
      $type = ((!empty($input['type'])) ? $input['type'] : 'text');
      $class = ((!empty($input['class'])) ? $input['class'] : '');
      $value = ((!empty($name) AND $type !== 'password') ?$this->getRequestValue($name) :''); ?>
      <input class="<?= $class ?>" type="<?= $type ?>" id="<?= $id ?>" name="<?= $name ?>" value="<?= $value ?>">
      <p class="error"><?= $this->getError($name) ?></p>
<?php
   }

   private function addInputSubmit(array $input)
   {  $name = ((!empty($input['name'])) ? $input['name'] : '');
      $value = ((!empty($input['value'])) ? $input['value'] :''); ?>
      <input type="submit" name="<?= $name ?>" value="<?= $value ?>">
<?php
   }

   private function addSelect(array $input, array $options)
   {  $name = ((!empty($input['name'])) ? $input['name'] : '');
      $id = ((!empty($input['id'])) ? $input['id'] : $input['name']);
      $class = ((!empty($input['class'])) ? $input['class'] : '');
      $selected = ((!empty($name)) ?$this->getRequestValue($name) :''); ?>
      <select class="<?= $class ?>" name="<?= $name ?>" id="<?= $id ?>">
         <option value="">-- Sélectionnez une option --</option>
<?php    foreach ($options as $option) :
            if ($option == $selected) : ?>
               <option value="<?= $option ?>" selected><?= ucfirst($option) ?></option>
<?php       else : ?>
               <option value="<?= $option ?>"><?= ucfirst($option) ?></option>
<?php       endif;
         endforeach; ?>
      </select>
      <p class="error"><?= $this->getError($name) ?></p>
<?php
   }

   private function addTextarea(array $input)
   {  $name = ((!empty($input['name'])) ? $input['name'] : '');
      $id = ((!empty($input['id'])) ? $input['id'] : $input['name']);
      $rows = ((!empty($input['rows'])) ? $input['rows'] : 8);
      $cols = ((!empty($input['cols'])) ? $input['cols'] : 80);
      $value = ((!empty($name)) ?$this->getRequestValue($name) :''); ?>
      <textarea name="<?= $name ?>" id="<?= $id ?>" rows="<?= $rows ?>" cols="<?= $cols ?>"><?= $value ?></textarea>
      <p class="error"><?= $this->getError($name) ?></p>
<?php
   }

   public function addForm()
   {  ?>
      <form class="<?= $this->class ?>" action="<?= $this->action ?>" id="<?= $this->id ?>" method="<?= $this->method ?>" enctype="<?= $this->enctype ?>">
<?php foreach ($this->inputs as $input) :
         if (array_key_exists('label', $input))
         {  $this->addLabel($input);
         }
         switch($input['input']['type'])
         {  case 'text' :
            case 'file' :
            case 'password' :
               $this->addInput($input['input']);
               break;
            case 'submit' :
               $this->addInputSubmit($input['input']);
               break;
            case 'select' :
               $this->addSelect($input['input'], $input['option']);
               break;
            case 'textarea' :
               $this->addTextarea($input['input']);
               break;
            default :
               die('Erreur input type non supporté');
               break;
         }
      endforeach; ?>
      </form>
<?php
   }

   public function validForm()
   {  foreach ($inputs as $input)
      {  $key = $input['input']['name'];
         $verifProc  = $input['validation']['proc'];
         $value = $this->getRequestValue($key);
         switch ($verifProc)
         {  case 'text':
               $this->verifText($value, $key, $input['validation']['minsize'], $input['validation']['maxsize']);
               break;
            default:
               die('Erreur input type non supporté');
               break;
         }
      }
   }


}  // class Formulaire
