<?php
   class FormTest extends Formulaire
   {
      private function addLabel(array $label)
      {  $name = ((!empty($label['name'])) ? $label['name'] : '');
         $texte = ((!empty($label['texte'])) ? $label['texte'] : ''); ?>
         <label for="<?= $name ?>"><?= $texte?></label>
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
               default :
                  die('Erreur input type non supporté');
            }
         endforeach; ?>
         </form>
<?php }

   }  // class FormTest
