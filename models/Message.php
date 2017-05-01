<?php

namespace feedback\models;

use feedback\lib\Model,
    feedback\lib\TypeFile,
    feedback\lib\Config;

/**
 * Модель отправки сообщений
 *
 * @author Lexa
 */
class Message extends Model
{
    public function save($data, $id=null) 
    {
        if( !isset($data['name']) || !isset($data['email']) || !isset($data['message']) ) {
            return FALSE;
        }
        
        $id = (int)$id;
        $name = $data['name'];
        $email = $data['email'];
        $message = $data['message'];
        
        if ( !$id ){
            $sql = "insert into `messages`(`name`, `email`, `messages`) VALUES (?, ?, ?)";
            return $this->db->query($sql, [$name, $email, $message]);
        } else {
            $sql = "
                update messages
                   set name = ?,
                       email = ?,
                       messages = ?,
                       markAdmin = 1
                   where id = ?
            ";
            return $this->db->query($sql, [$name, $email, $message, $id]);
        }
    }

    public function saveWithImg($data) 
    {
        if( !isset($data['name']) || !isset($data['email']) || !isset($data['message']) || !isset($data['imgData']) ) {
            return FALSE;
        }
        
        $name = $data['name'];
        $email = $data['email'];
        $message = $data['message'];
        $imageData = $data['imgData'];
        try {
            $typeFile = new TypeFile(Config::get('type image'));
            if($typeFile->testTypeFile($imageData)===FALSE) {
                 throw new \Exception('Неверный формат файла');
            }
            $this->db->beginTransaction();
                $sql = "insert into `messages`(`name`, `email`, `messages`) VALUES (?, ?, ?)";
                if($this->db->query($sql, [$name, $email, $message])===FALSE){
                    throw new \Exception('Не выполнен запрос на вставку значений в БД');
                }
                $lastId = $this->db->getLastInsertId();
                $uri = substr($imageData,strpos($imageData,",")+1);
                $ext = substr($imageData,strpos($imageData,"/")+1,strpos($imageData,";")-strpos($imageData, '/')-1);
                $imgFileName = 'img_'.$lastId.'.'.$ext;
                $sql2 = "update `messages` set image=? where id=".$lastId;
                if($this->db->query($sql2, [$imgFileName])===FALSE){
                    throw new \Exception('Не выполнен вставки изображения в БД');
                }
                if(file_put_contents('uploads/'.$imgFileName, base64_decode($uri))===FALSE){
                    throw new \Exception('Не удалось записать файл в папку');
                }
            $this->db->commitTransaction();
            return TRUE;
        } catch (Exception $ex) {
            echo $ex;
            $this->db->rollbackTransaction();
        }
        
        
    }
    
    public function getList() 
    {
        $sql = 'select * from messages where status=1 order by pubDate desc';
        return $this->db->query($sql);
    }
    public function getListAdmin() 
    {
        $sql = 'select * from messages where 1 order by pubDate desc';
        return $this->db->query($sql);
    }
    
    public function getListByName() 
    {
        $sql = 'select * from messages where status=1 order by name';
        return $this->db->query($sql);
    }
    
    public function getListByEmail() 
    {
        $sql = 'select * from messages where status=1 order by email';
        return $this->db->query($sql);
    }
    
    public function getById($id) 
    {
        $param = [(int)$id];
        $sql = 'select * from messages where id=? limit 1';
        $result = $this->db->query($sql, $param);
        return isset($result[0]) ? $result[0] : null;
    }
    
    public function moderation($id, $operation) {
        $sql = 'update messages set status=? where id=?';
        if ($operation==0) {
            $param = [1,$id];
        } else {
            $param = [0,$id];
        }
        return $this->db->query($sql, $param);
    }
}
