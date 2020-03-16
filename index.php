<?php
// Programmation Orienté Objet n°1
   date_default_timezone_set('Europe/Paris');
   require('inc/func.php');
   require('inc/classes/Vehicule.php');
   require('inc/classes/Voiture.php');

   $pageTitle = 'PHP - Programmation Orientée Objet 2';
   $errors = array();

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

      echo 'Avec le getter de la masse :' . $voiture1->getMasse();
      br();
      $voiture1->setMasse(1234);
      echo 'Après le setter de la masse :' . $voiture1->getMasse();
      br();



   ?>
   </div>

<?php
   include('inc/footer.php');
