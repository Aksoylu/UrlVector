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

        $userMessage;
        if ($available)
            $userMessage = $this->language->available;
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