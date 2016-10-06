<?php
class Redbox_Logcamp_HomeController extends Mage_Core_Controller_Front_Action
{ 

	public function indexAction(){
	if(!empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
	    //Determine if admin user needs to log in or not
            if(Mage::getSingleton('admin/session')->isLoggedIn()){
                $this->loadLayout();
                $this->renderLayout();
	    }
            else
            {
                  $this->_redirect('*/index');
            }
	}  else {
		$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: ' . $redirect);
	}
	
}
}
