<?php
   class Voiture extends Vehicule
   {
   // Propriétés
      protected $nbRoues = 4;

   // Destructors appelé automatiquement à la fin du script
      public function __destruct()
      {  echo 'Object destroyed!!';
      }

   // methodes
      public function changerVitesse(float $variationVitesse)
      {  if (($this->vitesse += $variationVitesse) < 0)
         {  $this->vitesse = 0;
         }
      }

      public function connexionBDD()
      {  try
         {  $pdo = new PDO('mysql:host=localhost;dbname=connexion', "root", "", array(
               PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
               PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            ));
         }
         catch (PDOException $e)
         {  Log::logWrite('Erreur de connexion : ' . $e->getMessage());
         }
      }

   } // class Voiture
