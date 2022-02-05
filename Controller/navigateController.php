<?php
/* Navigate Controller */
Class navigateController{


    public $params;
    public $userMessage;
    public $delay;
    public $navigationUrl;
    public function __construct($params = [])
    {  
        $this->params = $params;
        $this->fetchNavigationDetails();
    }

    function fetchNavigationDetails(){
        $this->userMessage = "user Message";
        $this->navigationUrl = "Navigation URL";
        $this->delay = "Delay";
        
    }

    
        
}

?>