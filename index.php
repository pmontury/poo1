<?php
// Programmation Orienté Objet n°1
   date_default_timezone_set('Europe/Paris');
   require('inc/functions/functions.php');

// appel de l'autoloader avec une fonction de la SPL PHP
   spl_autoload_register('classAutoloader');

   $pageTitle = 'PHP - Programmation Orientée Objet 2';

// Instanciation
   $formInfos = new FormTest('conf.ini');

   if ($formInfos->getRequestValue('submitted'))
   {  $nom = $formInfos->getRequestValue('nom');
      $prenom = $formInfos->getRequestValue('prenom');
      $couleur = $formInfos->getRequestValue('couleur');
      $message = $formInfos->getRequestValue('message');

      $formInfos->validations->verifText($nom, 'nom', 3, 100);
      $formInfos->validations->verifText($prenom, 'prenom', 3, 100);
      $formInfos->validations->verifSelect($couleur, 'couleur');
      $formInfos->validations->verifText($message, 'message', 10, 1000);

      if (!$formInfos->validations->hasError())
      {  echo 'ça marche';
      }
   }

   include('inc/html.php');
   include('inc/header.php');
?>
   <div class="wrap" id="content">
<?php
      $formInfos->buildForm();
?>
   </div>

<?php
   include('inc/footer.php');
