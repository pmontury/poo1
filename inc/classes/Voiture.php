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

   } // class Voiture
