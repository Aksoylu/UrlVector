<?php
class mainService{

    public $params;
    public function __construct($params = [])
    {  
        $this->params = $params;
    }

    public function isAvailable()
    {
        $available = FALSE;
        $query = new XQuery();
        $query->select('urls',['id'])->where('name='._param($this->params->url_name));
        $result = $query->fetch(1);
        if ($result)
            $userMessage = $this->language->not_available;
        else
        {
            $userMessage = $this->language->available;
            $available = TRUE;
        }
           
        SERVICE::RESPONSE([

            "code" => "200",
            "msg" => $userMessage,
            "isAvailable" => $available

        ]);
    }

    public function issueUrl()
    {
        $available = FALSE;

        //TODO: Check content for preventing sql injection or another security vulnables

        $query = new XQuery();
        $query->select('urls',['id'])->where('name='._param($this->params->url_name));
        $result = $query->fetch(1);
        if ($result)
            $userMessage = $this->language->not_available;
        else
        {
            $query = new XQuery();

            if ($this->params->delay)
                $this->params->delay = 3;
            else
                $this->params->delay = 0;

            $query->insert('urls', [
                "name"=> $this->params->url_name,   
                "password" => md5($this->params->password),
                "navigation_url" => $this->params->source_url,
                "navigation_delay" => $this->params->delay,
                "navigation_text" => $this->params->user_message

            ]);
            $query->run();
        }

        //TODO : Implement issuing query
        SERVICE::RESPONSE([

            "code" => "200",
            "msg" => $userMessage,
            "isAvailable" => $available

        ]);
        
    }


}

?>