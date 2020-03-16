<?php
   class Voiture extends Vehicule
   {  // Les propriétés
      // public string $marque;
      // public string $modele;
      // public string $couleur;
      // private float $masse;
      // public float $vitesse = 0;

   // Constructors pour les paramètres que l'on passe à l'objet à l'instanciation
      public function __construct(string $brand, string $model, string $color, int $weigth)
      {  $this->marque = $brand;
         $this->modele = $model;
         $this->couleur = $color;
         $this->masse = $weigth;
      }

   // Destructors appelé automatiquement à la fin du script
      public function __destruct()
      {  echo 'Object destroyed!!';
      }

   // methodes
      // getter
      public function getMasse() : float
      {  return $this->masse;
      }

      // Setter
      public function setMasse(float $newMasse) : void
      {  $this->masse = (!($newMasse < 0)) ? $newMasse : 0;
      }

      // Fonctions
      public function setCouleur(string $newColor) : void
      {  $this->couleur = $newColor;
      }

      public function changerVitesse(float $variationVitesse)
      {  if (($this->vitesse += $variationVitesse) < 0)
         {  $this->vitesse = 0;
         }
      }



   } // class Voiture
