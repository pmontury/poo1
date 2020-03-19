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
      return '<label class="' . $class . '" for="' . $name . '">' . $texte . '</label>';
   }

   private function addInput(array $input)
   {  $name = ((!empty($input['name'])) ? $input['name'] : '');
      $id = ((!empty($input['id'])) ? $input['id'] : $input['name']);
      $type = ((!empty($input['type'])) ? $input['type'] : 'text');
      $class = ((!empty($input['class'])) ? $input['class'] : '');
      $value = ((!empty($name) AND $type !== 'password') ?$this->getRequestValue($name) :'');
      $html = '<input class="'.$class.'" type="'.$type.'" id="'.$id.'" name="'.$name.'" value="'.$value.'">';
      $html .= '<p class="error">'.$this->getError($name).'</p>';
      return $html;
   }

   private function addInputSubmit(array $input)
   {  $name = ((!empty($input['name'])) ? $input['name'] : '');
      $value = ((!empty($input['value'])) ? $input['value'] :'submit');
      $html = '<input type="submit" name="'.$name.'" value="'.$value.'">';
      return $html;
   }

   private function addSelect(array $input, array $options)
   {  $name = ((!empty($input['name'])) ? $input['name'] : '');
      $id = ((!empty($input['id'])) ? $input['id'] : $input['name']);
      $class = ((!empty($input['class'])) ? $input['class'] : '');
      $selected = ((!empty($name)) ?$this->getRequestValue($name) :'');
      $html = '<select class="'.$class.'" name="'.$name.'" id="'.$id.'">';
      $html .= '<option value="">-- Sélectionnez une option --</option>';
      foreach ($options as $option) :
         if ($option === $selected) :
            $html .= '<option value="'.$option.'" selected>'.ucfirst($option).'</option>';
         else :
            $html .= '<option value="'.$option.'">'.ucfirst($option).'</option>';
         endif;
      endforeach;
      $html .= '</select>';
      $html .= '<p class="error">'.$this->getError($name).'</p>';
      return $html;
   }

   private function addTextarea(array $input)
   {  $name = ((!empty($input['name'])) ? $input['name'] : '');
      $id = ((!empty($input['id'])) ? $input['id'] : $input['name']);
      $rows = ((!empty($input['rows'])) ? $input['rows'] : 8);
      $cols = ((!empty($input['cols'])) ? $input['cols'] : 80);
      $value = ((!empty($name)) ?$this->getRequestValue($name) :'');
      $html = '<textarea name="'.$name.'" id="'.$id.'" rows="'.$rows.'" cols="'.$cols.'">'.$value.'</textarea>';
      $html .= '<p class="error">'.$this->getError($name).'</p>';
      return $html;
   }

   public function addForm()
   {  $html = '<form class="'.$this->class.'" action="'.$this->action.'" method="'.$this->method.'" enctype="'.$this->enctype.'">';
      foreach ($this->inputs as $input) :
         if (array_key_exists('label', $input))
         {  $html .= $this->addLabel($input);
         }
         switch($input['input']['type'])
         {  case 'text' :
            case 'file' :
            case 'password' :
               $html .= $this->addInput($input['input']);
               break;
            case 'submit' :
               $html .= $this->addInputSubmit($input['input']);
               break;
            case 'select' :
               $html .= $this->addSelect($input['input'], $input['option']);
               break;
            case 'textarea' :
               $html .= $this->addTextarea($input['input']);
               break;
            default :
               die('Erreur input type non supporté');
               break;
         }
      endforeach;
      $html .= '</form>';
      echo $html;
   }

   public function validForm()
   {  if ($this->getRequestValue($this->inputs['submit']['input']['name']))
      {  foreach ($this->inputs as $input)
         {  if ($input['input']['type'] !== 'submit')
            {  $key = $input['input']['name'];
               $verifProc  = $input['validation']['proc'];
               $obligatoire = ((!empty($input['validation']['obligatoire'])) ? $input['validation']['obligatoire'] : false );
               $maxsize = ((!empty($input['validation']['maxsize'])) ? $input['validation']['maxsize'] : 100 );
               $minsize = ((!empty($input['validation']['minsize'])) ? $input['validation']['minsize'] : 1 );
               $value = $this->getRequestValue($key);
               switch ($verifProc)
               {  case 'text':
                     $this->verifText($value, $key, $minsize, $maxsize, $obligatoire);
                     break;
                  case 'select':
                     $this->verifSelect($value, $key, $obligatoire);
                     break;
                  case 'password':
                     $this->verifPassword($value, $key);
                     break;
                  case 'file':
                     $this->verifFile($key);
                     break;
                  default:
                     die('Erreur input type non supporté');
                     break;
               }
            }
         }
         if (!$this->hasError())
         {  return true;
         }
      }
      return false;
   }

}  // class Formulaire
