<?php
// models/Auth.php

class Auth {
    /**
     * Vérifie si un utilisateur est déjà enregistré.
     * Pour cet exemple, nous stockons les infos en session.
     */
    public static function isUserRegistered() {
        return isset($_SESSION['user_registered']) && $_SESSION['user_registered'] === true;
    }

    /**
     * Enregistre un utilisateur.
     * Dans une application réelle, pensez à hacher le mot de passe et à enregistrer en base.
     */
    public static function registerUser($email, $password) {
        // Hachage du mot de passe pour la sécurité
        $_SESSION['user_registered'] = true;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_password'] = password_hash($password, PASSWORD_DEFAULT);
        return true;
    }

    /**
     * Authentifie un utilisateur.
     */
    public static function authenticate($email, $password) {
        if (!self::isUserRegistered()) {
            return false;
        }
        return ($email === $_SESSION['user_email'] && password_verify($password, $_SESSION['user_password']));
    }
}

// controllers/AuthController.php
session_start();
require_once __DIR__ . '/../models/Auth.php';

class AuthController {

    /**
     * Affiche et traite le formulaire d'inscription.
     * Si l'utilisateur est déjà enregistré, il est redirigé vers le login.
     */
    public function register() {
        if (Auth::isUserRegistered()) {
            // L'utilisateur est déjà enregistré, rediriger vers le login
            header("Location: /index.php?action=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer et nettoyer les données du formulaire
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $password2 = trim($_POST['password2'] ?? '');

            // Vérifier que les deux mots de passe correspondent
            if ($password !== $password2) {
                $error = "Les mots de passe ne correspondent pas.";
                include __DIR__ . '/../views/auth/register.php';
                exit;
            }

            // Enregistrer l'utilisateur
            Auth::registerUser($email, $password);

            // On peut connecter directement l'utilisateur ou le rediriger vers la page de login
            $_SESSION['user_logged_in'] = true;
            header("Location: /index.php?action=login");
            exit;
        } else {
            // Afficher le formulaire d'inscription
            include __DIR__ . '/../views/auth/register.php';
        }
    }

    /**
     * Affiche et traite le formulaire de connexion.
     * Si aucun utilisateur n'est enregistré, il force l'inscription.
     */
    public function login() {
        if (!Auth::isUserRegistered()) {
            // Aucun utilisateur enregistré, rediriger vers register
            header("Location: /index.php?action=register");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (Auth::authenticate($email, $password)) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_email'] = $email;
                header("Location: /index.php?action=home");
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
                include __DIR__ . '/../views/auth/login.php';
                exit;
            }
        } else {
            include __DIR__ . '/../views/auth/login.php';
        }
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /index.php?action=login");
        exit;
    }
}
