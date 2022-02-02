<?php
class mainService{

    public $params;
    public function __construct($params = [])
    {  
        $this->params = $params;
    }

    public function isAvailable()
    {
        //TODO: CHECK AVAILABLE
        
        $available = FALSE;
        $query = new XQuery();
        $query->select('urls',['id'])->where('name='._param($this->params->url_name));
        $result = $query->fetch(1);
        if ($result){
            $userMessage = $this->language->available;
            $available = TRUE;
        }
        else
            $userMessage = $this->language->not_available;

        SERVICE::RESPONSE([

            "code" => "200",
            "msg" => $userMessage,
            "isAvailable" => $available

        ]);
    }


}

?>