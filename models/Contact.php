<?php 

    class Contact {

        private $categorie;
        private $fonction;
        private $prenom;
        private $nom;
        private $id;

        public function __construct($id, $nom, $prenom, $fonction, $categorie) {

            $this -> setCategory($categorie);
            $this -> setFonction($fonction);
            $this -> setPrenom($prenom);
            $this -> setNom($nom);
            $this -> setId($id);

        }

        public function setCategory($categorie) {
            $this -> categorie = $categorie;
        }
        public function setFonction($fonction) {
            $this -> fonction = $fonction;
        }
        public function setPrenom($prenom) {
            $this -> prenom = $prenom;
        }
        public function setNom($nom) {
            $this -> nom = $nom;
        }
        public function setId($id) {
            $this -> id = $id;
        }

        public function getCategory() {
            return $this -> categorie;
        }
        public function getFonction() {
            return $this -> fonction;
        }
        public function getPrenom() {
            return $this -> prenom;
        }
        public function getNom() {
            return $this -> nom;
        }
        public function getId() {
            return $this -> id;
        }


    }