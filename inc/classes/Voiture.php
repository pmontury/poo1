<?php
   class Voiture
   {  // Les propriétés
      public string $marque;
      public string $modele;
      public string $couleur;
      public int $masse;
      public int $vitesse = 0;

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
      // Setter
      public function setCouleur(string $newColor) : void
      {  $this->couleur = $newColor;
      }

      // Getter
      public function getCouleur() : string
      {  return $this->couleur;
      }

      // Fonctions
      public function accelerer(int $acceleration = 10)
      {  $this->vitesse += $acceleration;
      }

      public function freiner(int $freinage = 10)
      {  if (($this->vitesse -= $freinage) < 0)
         {  $this->vitesse = 0;
         }
      }

   } // class Voiture
