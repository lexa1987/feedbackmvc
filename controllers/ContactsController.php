<?php

namespace feedback\controllers;

use feedback\lib\Controller,
    feedback\models\Message,
    feedback\lib\Alert,
    feedback\lib\Router;

/**
 * Контроллер контактной формы 
 *
 * @author Lexa
 */
class ContactsController extends Controller
{
    public function __construct($data = []) 
    {
        parent::__construct($data);
        $this->model = new Message();
    }

    public function index() 
    {
        if ( $_POST ){
            if ($_POST['imgData']!=="") {
                if ($this->model->saveWithImg($_POST)){   
                    $_POST = NULL;
                    echo 'Ok';
                    die();
                    //Router::redirect('/contacts/index/ok');
                }
            } else {
                if ($this->model->save($_POST)){   
                    $_POST = NULL;
                    echo 'Ok';
                    die();
                    //Router::redirect('/contacts/index/ok');
                }
            }    
        }
        
//        if ($this->params[0]==='ok') {
//            Alert::setFlash('Ваше сообщение успешно отправлено');
//        }
        
        switch (strtolower($this->params[0])){
            case "sortbyname":
                $this->data['db'] = $this->model->getListByName();
                $this->data['sort'] = 'sortbyname';
                break;
            case "sortbyemail":
                $this->data['db'] = $this->model->getListByEmail();
                $this->data['sort'] = 'sortbyemail';
                break;
            default:
                $this->data['db'] = $this->model->getList();
                $this->data['sort'] = 'default';
        } 
    }
        
    
    public function admin_index()
    {
        $this->data = $this->model->getListAdmin();
    }
    
    public function admin_edit()
    {
        if($_POST){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $id);
            if($result) {
                Alert::setFlash('Изменения внесены');
            } else {
                Alert::setFlash('Ошибка');
            }
            Router::redirect('/admin/contacts/');
        }
        
        if( isset($this->params[0]) ) {
            $this->data['contacts'] = $this->model->getById($this->params[0]);
        } else {
            Alert::setFlash('Направильный индентификатор');
            Router::redirect('/admin/contacts/');
        }
    }
    
    public function admin_moderation()
    {
        if (isset($_POST['id']) && isset($_POST['operation'])) {
            echo $this->model->moderation($_POST['id'],$_POST['operation']);
            die();
        }
        Router::redirect('/admin/contacts/');
    }

}
