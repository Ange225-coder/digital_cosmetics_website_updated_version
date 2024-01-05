<?php

    declare(strict_types = 1);

    namespace App\exceptions\usersManagerExceptions;

    use RuntimeException;

    class UsersSettingsExceptions extends RuntimeException
    {
        public static function errorEmailAlreadyExist(): string
        {
            return ' existe déjà, choisissez un autre';
        }


        public static function errorEmailFormat(): string
        {
            return 'Le format de cet email n\'est pas prise en compte sur ce site';
        }


        public static function errorPhoneAlreadyExists(): string
        {
            return 'Ce contact est utilisé par un autre utilisateur';
        }

        public static function errorPhoneFormat(): string
        {
            return 'Format du numéro incorrect. Entrer un numéro ivoirien ou contacter l\'administrateur';
        }


        public static function errorEmail(): string
        {
            return 'Email incorrect, impossible de supprimer le compte';
        }
    }