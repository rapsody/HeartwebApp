<?php
Class UserList {
    
    private $objUserListModel;

    public function __construct()
    {
        include ROOT_DIR.'models'.DS.__class__.'.class.php';
        $class_name = __class__.'_Model';
        $this->objUserListModel = new $class_name;
    }
        
    public function getUserList() 
    {
        $userlist = $this->objUserListModel->loadUserList();
        return $userlist;
    }

}