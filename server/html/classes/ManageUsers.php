<?php

class ManageUsers {
        public $AddUser = 'AddUser';

        function AddUser($pdo, $username, $email, $pwd) {
                try {
                        $tmp_query = "INSERT INTO users (username, email, pwd, enabled) VALUES (?, ?, ?, ?)";
                        $tmp_result = $pdo->prepare($tmp_query);
                        if ($tmp_result->execute([$username, $email, $pwd, 1])) {
                                echo "Success";
                        } else {
                                echo "Failure";
                        }
                } catch (\PDOException $e) {
                        var_dump($e->geTMessage());
                }
        }

        function ListUsers($pdo) {
                return $pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
        }

        function RemoveUser($pdo, $email) {
                try {
                $tmp_query = "UPDATE users SET enabled=0 WHERE email='" . $email . "';";
                $tmp_result = $pdo->prepare($tmp_query);
                if ($tmp_result->execute()) {
                        echo "Success";
                } else {
                        echo "Failure";
                }
                } catch (\PDOException $e) {
                        var_dump($e->geTMessage());
                }
        }

        function GetUserInfos($pdo, $email) {
                return $pdo->query("SELECT id, username, email, enabled FROM users WHERE email='totostudio@epitech.fr'")->fetchAll(PDO::FETCH_ASSOC);
        }
}