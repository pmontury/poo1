<?php
// Programmation Orienté Objet n°1
   date_default_timezone_set('Europe/Paris');
   require('inc/functions/functions.php');

// appel de l'autoloader avec une fonction de la SPL PHP
   spl_autoload_register('classAutoloader');

   $pageTitle = 'PHP - Programmation Orientée Objet 2';

// Instanciation
   $voiture1 = new Voiture('Lada', 'Niva', 'moche', 1000);

   include('inc/html.php');
   include('inc/header.php');
?>
   <div class="wrap" id="content">
   <?php
      echo 'Après l\'instanciation';
      debug($voiture1);
      br();

      $voiture1->setCouleur('pas belle');
      echo 'Après le changement de couleur';
      debug($voiture1);
      br();

      $voiture1->changerVitesse(-10);
      echo 'Après le changement de vitesse';
      debug($voiture1);
      br();


      $voiture1->setMarque('Peugeot');
      echo 'Après le setter de la marque : ' . $voiture1->getMarque();
      br();
      $voiture1->setModele('403');
      echo 'Après le setter du modéle : ' . $voiture1->getModele();
      br();
      $voiture1->setCouleur('Violet');
      echo 'Après le setter de la couleur : ' . $voiture1->getCouleur();
      br();
      $voiture1->setMasse(1234);
      echo 'Après le setter de la masse : ' . $voiture1->getMasse();
      br();
      $voiture1->setVitesse(45);
      echo 'Après le setter de la vitesse : ' . $voiture1->getVitesse();
      br();

      $voiture2 = new Formule1('MacLaren', 'F512', 'Rouge et Blanche', 750);
      $voiture2->setVitesse(750);
      debug($voiture2);
      Log::logWrite('Bonjour');
      $voiture1->connexionBDD();
   ?>
   </div>

<?php
   include('inc/footer.php');
