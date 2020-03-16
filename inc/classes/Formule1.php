<?php

   final class Formule1 extends Voiture
   {
      private string $caracteristique = 'monoplace';

      public function setCaracteristique(string $caracteristique) : void
      {  $this->caracteristique = $caracteristique;
      }

      public function getCaracteristique() : string
      {  return $this->caracteristique;
      }

   } // class Formule1
