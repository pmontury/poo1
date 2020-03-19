<?php
// Programmation Orienté Objet n°1
   date_default_timezone_set('Europe/Paris');
   require('inc/functions/functions.php');

// appel de l'autoloader avec une fonction de la SPL PHP
   spl_autoload_register('classAutoloader');

   $pageTitle = 'PHP - Programmation Orientée Objet 2';

// Instanciation
   $form = new Formulaire('./conf/conf.ini', 'index.php', 'multipart/form-data');

   include('inc/html.php');
   include('inc/header.php');
?>
   <div class="wrap" id="content">
      <h1>Formulaire et contrôles en mode objet</h1>
<?php
      if (!$form->validForm()) :
         $form->addForm();
      else :
         echo 'ça marche';
      endif;
?>
   </div>

<?php
   include('inc/footer.php');
