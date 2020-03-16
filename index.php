<?php
// Programmation Orienté Objet n°1
   require('inc/func.php');
   require('inc/classes/Voiture.php');

   $pageTitle = 'Programmation Orientée Objet 2';
   $errors = array();

   $voiture1 = new Voiture('Lada', 'Niva', 'moche', 1000);
//   $voiture2 = new Voiture();

   // $voiture1->marque = 'Lada';
   // $voiture1->modele = 'Niva';
   // $voiture1->couleur = 'moche';
   // $voiture1->masse = 1000;

   $voiture1->accelerer(20);
   // $voiture2->accelerer(30);
   $voiture1->accelerer(20);
   // $voiture2->accelerer();

   $voiture1->freiner(20);
   $voiture1->freiner(30);

   // $voiture2->setCouleur('blue');

   include('inc/html.php');
   include('inc/header.php');
   include('inc/body.php');
   include('inc/footer.php');
