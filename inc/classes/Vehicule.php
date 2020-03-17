<?php
   abstract class Vehicule
   {
      // les propriétés
      protected string  $marque;
      protected string  $modele;
      protected string  $couleur;
      protected float   $masse;
      protected float   $vitesse = 0;

   // Constructors pour les paramètres que l'on passe à l'objet à l'instanciation
      public function __construct(string $brand, string $model, string $color, float $weigth)
      {  $this->marque  = $brand;
         $this->modele  = $model;
         $this->couleur = $color;
         $this->masse   = $weigth;
      }

   // getter
      public function getMarque() : string
      {  return $this->marque;
      }
      public function getModele() : string
      {  return $this->modele;
      }
      public function getCouleur() : string
      {  return $this->couleur;
      }
      public function getMasse() : float
      {  return $this->masse;
      }
      public function getVitesse() : float
      {  return $this->vitesse;
      }

   // setter
      public function setMarque(string $newMarque) : void
      {  $this->marque = $newMarque;
      }
      public function setModele(string $newModele) : void
      {  $this->modele = $newModele;
      }
      public function setCouleur(string $newCouleur) : void
      {  $this->couleur = $newCouleur;
      }
      public function setMasse(float $newMasse) : void
      {   $this->masse = (!($newMasse < 0)) ? $newMasse : 0;
      }
      public function setVitesse(float $newVitesse) : void
      {   $this->vitesse = (!($newVitesse < 0)) ? $newVitesse : 0;
      }

   } // class Vehicule
