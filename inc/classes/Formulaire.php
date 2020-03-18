<?php

abstract class Formulaire
{
   // les propriétés
   protected string  $action  = '';
   protected string  $method  = 'post';
   protected string  $enctype = '';
   protected string  $class   = '';
   protected string  $id;
   public array   $inputs;

   // Constructors pour les paramètres que l'on passe à l'objet à l'instanciation
   public function __construct(string $iniFile)
   {  $this->validations = new Validations;
      $this->inputs  = parse_ini_file($iniFile, true);
   }

   public function setAction($action)
   {  $this->action = $action;
   }
   public function setMethod($method)
   {  $this->method = $method;
   }
   public function setEnctype($enctype)
   {  $this->enctype = $enctype;
   }
   public function setClass($class)
   {  $this->class = $class;
   }

   function getRequestValue($key)
   {  if (isset($_REQUEST[$key]) OR !empty($_REQUEST[$key]))
         return htmlspecialchars(stripslashes(trim($_REQUEST[$key])));
      else
         return false;
   }

}  // class Formulaire
