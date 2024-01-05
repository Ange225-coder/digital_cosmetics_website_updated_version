<?php

    declare(strict_types = 1);

    namespace App\model\usersManager;

    use App\model\database\DbManager;

    class UsersManager extends DbManager
    {
        /**
         * this function insert new user in db in the same time
         * that user spend an order
         */
        public function setUser(string $full_name, string $email, string $phone): bool
        {
            $db = $this->dbConnect();
            $queryInsertUser = $db->prepare('INSERT INTO users(`u_full-name`, u_email, u_number, registration_date) VALUES (?, ?, ?, NOW())');

            return $queryInsertUser->execute(array($full_name, $email, $phone));
        }

        
        /**
         * this function get user's full name, and it email in db
         * and check for if already exist in it since setUserNSetProductInCartCtrl
         */
        public function getUserData(): array
        {
            $db = $this->dbConnect();
            $queryGetUserData = $db->prepare('SELECT id, `u_full-name`, u_email, u_number FROM users');
            $queryGetUserData->execute();

            return $queryGetUserData->fetchAll();
        }

        /**
         * function which get one user full name in db
         * and check if the email associated is right
         */
        public function getUserDataForLogin(string $full_name)
        {
            $db = $this->dbConnect();
            $queryGetUserForLogin = $db->prepare('SELECT * FROM users WHERE `u_full-name` = ?');
            $queryGetUserForLogin->execute(array($full_name));

            return $queryGetUserForLogin->fetch();
        }

        /**
         * function which get orders in process
         * based on a user session
         */
        public function getOrderInProcess(string $buyer_name): bool|array
        {
            $db = $this->dbConnect();
            $queryGetOrderInProcess = $db->prepare('SELECT *, DATE_FORMAT(order_date, "%d/%m/%Y à %Hh:%imin:%ss") as orderDate_fr FROM product_order WHERE buyer_name = ? ORDER BY order_date DESC');
            $queryGetOrderInProcess->execute(array($buyer_name));

            return $queryGetOrderInProcess->fetchAll();
        }

        /**
         * function which get full name and check for if it
         * exists in db during email modification
         */
        public function getFullName(): array
        {
            $db = $this->dbConnect();
            $queryGetFullName = $db->prepare('SELECT `u_full-name` FROM users');
            $queryGetFullName->execute();

            return $queryGetFullName->fetchAll();
        }


        /**
         * reset password about user session
         */
        public function resetEmail(string $email, string $full_name): bool
        {
            $db = $this->dbConnect();
            $queryResetEmail = $db->prepare('UPDATE users SET u_email = ? WHERE `u_full-name` = ?');

            return $queryResetEmail->execute(array($email, $full_name));
        }

    }