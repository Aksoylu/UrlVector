<?php
class mainService{

    public $params;
    public function __construct($params = [])
    {  
        $this->params = $params;
    }

    public function isAvailable()
    {
        if(!$this->checkVariable($this->params->url_name))
            SERVICE::RESPONSE([
                "code" => 301,
                "msg" => $this->language->variable_not_available,
                "isAvailable" => FALSE
            ]);

        $available = FALSE;
        $query = new XQuery();
        $query->select('urls',['id'])->where('name={url_name}', ["url_name" => $this->params->url_name]);    //._param()
        $result = $query->fetch(1);
        if ($result)
            $userMessage = $this->language->not_available;
        else
        {
            $userMessage = $this->language->available;
            $available = TRUE;
        }
           
        SERVICE::RESPONSE([

            "code" => 200,
            "msg" => $userMessage,
            "isAvailable" => $available

        ]);
    }

    public function issueUrl()
    {
        $formatted = TEXT::FORMAT($this->language->variable_not_available, "val1", "val2", "val3");
        SERVICE::DEBUG($formatted);
        
        /*
        if(!$this->checkVariable([$this->params->target_path, $this->params->source_url, $this->params->password]))
            SERVICE::RESPONSE([
                "code" => 301,
                "msg" => "",//TEXT::FORMAT($this->language->variable_not_available, "key" => "value", "key2" => "value2"),
                "isAvailable" => FALSE
            ]);
        */
        if(!$this->checkVariable($this->params->source_url,12) )
            SERVICE::RESPONSE([
                "code" => 301,
                "msg" => "", //TEXT::FORMAT($this->language->variable_not_available, ),
                "isAvailable" => FALSE
            ]);

        $available = FALSE;
        $response_code;
        $userMessage;

        $query = new XQuery();
        $query->select('urls',['id'])->where('name={target_path}', ["target_path" => $this->params->target_path ]  );
        $result = $query->fetch(1);
        if ($result)
        {
            $userMessage = $this->language->not_available;
            $response_code = 305;
        }

        else
        {
            $query = new XQuery();

            if ($this->params->delay)
                $this->params->delay = 3;
            else
                $this->params->delay = 0;

            $query->insert('urls', [
                "name"=> $this->params->target_path,   
                "password" => md5($this->params->password),
                "navigation_url" => $this->params->source_url,
                "navigation_delay" => $this->params->delay,
                "navigation_text" => $this->params->user_message

            ]);
            $result = $query->run();
            if($result)
            {
                $userMessage = $this->language->issued;
                $response_code = 200;
            }
            else
            {
                $userMessage = $this->language->service_server_error;
                $response_code = 500;
            }
        }

        //TODO : Implement issuing query
        SERVICE::RESPONSE([
            "code" => $response_code,
            "msg" => $userMessage,
            "isAvailable" => $available
        ]);
        
    }

    function checkVariable($value, $limit = 3)
    {
        if (is_null($value))
            return FALSE;

        if(strlen($value) < $limit )
            return FALSE;
        
        if(strlen($value)> 64)
            return FALSE;
        
        return TRUE;
    }



}

?>