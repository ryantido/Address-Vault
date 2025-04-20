<?php 

    abstract class App{
        private static $bd;

        private static function setBd() {

            self::$bd = new PDO("mysql:host=localhost;dbname=contacts", "ryan", "Leslyspurple3.0");
            self::$bd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$bd -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        }

        protected function getBd(){
            
            if(self::$bd === null){
                self::setBd();
            }

            return self::$bd;

        }

    }