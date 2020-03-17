<?php

   class RequeteSQL
   {
      private $pdo;
      private $host = 'mysql:host=localhost;dbname=jardin';
      private $login = 'root';
      private $password = '';

   // Constructors pour la connexion automatique à l'instanciation
      public function __construct()
      {  try
         {  $this->pdo = new PDO($this->host, $this->login, $this->password, array(
               PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
               PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            ));
         }
         catch (PDOException $e)
         {  Log::logWrite('Erreur de connexion : ' . $e->getMessage());
         }
      }

   // Destructors appelé automatiquement à la fin du script
      public function __destruct()
      {  unset($this->pdo);
      }

      private function getPDOType($var)
      {  switch (gettype($var))
         {  case 'string':
               return PDO::PARAM_STR;
            case 'integer':
               return PDO::PARAM_INT;
         }
      }

      public function insertInto(string $table, array $datas)
      {  $colonnes = '(id';
         $valeurs = '(NULL';
         foreach ($datas as $key => $value)
         {  $colonnes .= ', ' . $key;
            $valeurs .= ", :" . $key;
         }
         $colonnes .= ')';
         $valeurs .= ')';

         $sql = 'INSERT INTO ' . $table . ' ' . $colonnes . ' VALUES ' . $valeurs;
         $query = $this->pdo->prepare($sql);
         foreach ($datas as $key => $value)
         {  $query->bindValue(":" . $key, $value, $this->getPDOType($value));
         }
         $result = $query->execute();
      }

   } // class RequeteSQL
