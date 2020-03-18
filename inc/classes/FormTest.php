<?php
   class FormTest extends Formulaire
   {
      private function addLabel(array $label)
      {  $name = ((!empty($label['name'])) ? $label['name'] : '');
         $texte = ((!empty($label['texte'])) ? $label['texte'] : '');
         $class = ((!empty($label['class'])) ? $label['class'] : ''); ?>
         <label class="<?= $class ?>" for="<?= $name ?>"><?= $texte?></label>
<?php }

      private function addInputText(array $input)
      {  $name = ((!empty($input['name'])) ? $input['name'] : '');
         $id = ((!empty($input['id'])) ? $input['id'] : $input['name']);
         $value = ((!empty($name)) ?$this->getRequestValue($name) :''); ?>
         <input type="text" id="<?= $id ?>" name="<?= $name ?>" value="<?= $value ?>">
         <p class="error"><?= $this->validations->getError($name) ?></p>
<?php }

      private function addInputSubmit(array $input)
      {  $name = ((!empty($input['name'])) ? $input['name'] : '');
         $value = ((!empty($input['value'])) ? $input['value'] :''); ?>
         <input type="submit" name="<?= $name ?>" value="<?= $value ?>">
<?php }

      private function addSelect(array $input, array $options)
      {  $name = ((!empty($input['name'])) ? $input['name'] : '');
         $id = ((!empty($input['id'])) ? $input['id'] : $input['name']);
         $selected = ((!empty($name)) ?$this->getRequestValue($name) :''); ?>
         <select class="" name="<?= $name ?>" id="<?= $id ?>">
            <option value="">-- Sélectionnez une option --</option>
<?php       foreach ($options as $option) :
               if ($option == $selected) : ?>
                  <option value="<?= $option ?>" selected><?= ucfirst($option) ?></option>
<?php          else : ?>
                  <option value="<?= $option ?>"><?= ucfirst($option) ?></option>
<?php          endif;
            endforeach; ?>
         </select>
         <p class="error"><?= $this->validations->getError($name) ?></p>
<?php }

      private function addTextarea(array $input)
      {  $name = ((!empty($input['name'])) ? $input['name'] : '');
         $id = ((!empty($input['id'])) ? $input['id'] : $input['name']);
         $rows = ((!empty($input['rows'])) ? $input['rows'] : 8);
         $cols = ((!empty($input['cols'])) ? $input['cols'] : 80);
         $value = ((!empty($name)) ?$this->getRequestValue($name) :''); ?>
         <textarea name="<?= $name ?>" id="<?= $id ?>" rows="<?= $rows ?>" cols="<?= $cols ?>"><?= $value ?></textarea>
         <p class="error"><?= $this->validations->getError($name) ?></p>
<?php }

      function buildForm()
      {  ?>
         <form class="<?= $this->class ?>" action="<?= $this->action ?>" method="<?= $this->method ?>" enctype="<?= $this->enctype ?>">
<?php    foreach ($this->inputs as $input) :
            if (array_key_exists('label', $input))
            {  $this->addLabel($input['label']);
            }
            switch($input['input']['type'])
            {  case 'text' :
                  $this->addInputText($input['input']);
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
            }
         endforeach; ?>
         </form>
<?php }

   }  // class FormTest
