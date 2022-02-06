<?php
/* Navigate Controller */
Class navigateController{


    public $params;

    public $pageState;
    public $userMessage;
    public $delay;
    public $navigationUrl;
    public $target;
    public function __construct($params = [])
    {  
        $this->params = $params;
        $this->fetchNavigationDetails();
    }

    function fetchNavigationDetails(){
        $this->target = SECURITY::ESCAPE($this->params->target);
        $query = new XQuery();
        $query->select('urls',['navigation_url', 'navigation_delay', 'navigation_text'])->where("name={name}", ["name" => $this->target]);
        $result = $query->fetch(1);
        if ($result)
        {
            $this->pageState = TRUE;
            $this->navigationUrl = $result['navigation_url'];
            $this->delay = $result['navigation_delay'];
            if ($this->delay == 0)
            {
                PROTON::EXECUTEJS(TEXT::FORMAT("window.location='{url}'", $this->navigationUrl));
            }
            else
            {
                $this->userMessage = $result['navigation_text'];
            }
            
        }
        else
        {   
            $this->pageState = FALSE;
        }

    }

    
        
}

?>