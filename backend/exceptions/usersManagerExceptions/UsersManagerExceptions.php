<?php

    declare(strict_types = 1);

    namespace App\exceptions\usersManagerExceptions;

    use RuntimeException;

    class UsersManagerExceptions extends RuntimeException
    {

        public static function errorFormatFullName(): string
        {
            return 'Format du nom complet incorrect (EX: Jhon Doe)';
        }


        public static function errorFormatEmail(): string
        {
            return 'Ce format d\'email n\'est pas accepté sur ce site';
        }


        public static function errorEmailAlreadyExist(): string
        {
            return ' existe déjà';
        }


        public static function errorFullNameAlreadyExist(): string
        {
            return ' exist déjà peut-être en base';
        }


        public static function errorPhoneNumberAlreadyExist(): string
        {
            return ' est déjà associé à un autre utilisateur';
        }


        public static function errorFormatPhoneNumber(): string
        {
            return 'Format de numéro incorrect Ex: 01 02 03 04 05';
        }


        public static function errorWrongDatas(): string
        {
            return 'Données invalide ';
        }


        public static function errorMissingUserSession(): string
        {
            return 'Impossible de voir les commandes session inexistante';
        }


        /** using in getEmailCtrl for forgottenPwd */

        public static function errorFullNameNotExists(): string
        {
            return ' est déjà utilisé par un autre utilisateur';
        }

    }