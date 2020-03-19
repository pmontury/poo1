<?php
// Programmation Orienté Objet n°1
   date_default_timezone_set('Europe/Paris');
   require('inc/functions/functions.php');

// appel de l'autoloader avec une fonction de la SPL PHP
   spl_autoload_register('classAutoloader');

   $pageTitle = 'PHP - Programmation Orientée Objet 2';

// Instanciation
   $form = new Formulaire('./conf/conf.ini', 'index.php', 'multipart/form-data');

   if ($form->getRequestValue('submitted'))
   {  $nom = $form->getRequestValue('nom');
      $prenom = $form->getRequestValue('prenom');
      $couleur = $form->getRequestValue('couleur');
      $message = $form->getRequestValue('message');
      $password = $form->getRequestValue('password');

      $form->verifText($nom, 'nom', 3, 100);
      $form->verifText($prenom, 'prenom', 3, 100);
      $form->verifSelect($couleur, 'couleur');
      $form->verifText($message, 'message', 10, 1000);
      if (empty($password))
      {  $form->setError('password', 'Veuillez saisir votre mot de passe');
      }

      $validFile = $form->verifFile('photo');
      $nameOriginal = $validFile['nameOriginal'];
      $ext = $validFile['ext'];
      if (!$form->hasError())
      {  echo 'ça marche';
      }
   }

   include('inc/html.php');
   include('inc/header.php');
?>
   <div class="wrap" id="content">
      <h1>Formulaire et contrôles en mode objet</h1>
<?php
      $form->addForm();
?>
   </div>

<?php
   include('inc/footer.php');
