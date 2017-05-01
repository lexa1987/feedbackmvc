<?php

namespace feedback\models;

use feedback\lib\Model;

/**
 * Модель для аутентификации и авторизации пользователей
 *
 * @author Lexa
 */
class User extends Model
{
    public function getByLogin($login)
    {
        $sql = "select * from users where login=? limit 1";
        $result = $this->db->query($sql, [$login]);
        if ( isset($result[0]) ) {
            return $result[0];
        }
        return FALSE;
    }
}
