<?php
class Redbox_Logcamp_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){
        if($_SERVER['HTTPS'] !== "off" || empty($_SERVER['HTTPS'])){
            if(!$_POST['username'] && !$_POST['password']){
                //Determine if admin user needs to log in or not
                if(Mage::getSingleton('admin/session')->isLoggedIn()){
                    $redirect = 'https://' . $_SERVER['HTTP_HOST'];
                    header('HTTP/1.1 301 Moved Permanently');
                    header('Location: ' . $redirect . '/logcamp/home#var/log');
                } else { //Render Login Form and POST to self
                    $this->loadLayout();
                    $this->renderLayout();
                }
            } else {
                //Handle POST data to Authenticate and then Login with Session so we can validate isLoggedIn
                if (Mage::getModel('admin/user')->authenticate($_POST['username'],$_POST['password'])) {
                    Mage::getSingleton('admin/session')->login($_POST['username'],$_POST['password']);
                    $redirect = 'https://' . $_SERVER['HTTP_HOST'];
                    header('HTTP/1.1 301 Moved Permanently');
                    header('Location: ' . $redirect . '/logcamp/home#var/log');
                } else {
                    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    header('HTTP/1.1 301 Moved Permanently');
                    header('Location: ' . $redirect);
                }
            }
        } else {
            $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $redirect);
        }
    }
}
