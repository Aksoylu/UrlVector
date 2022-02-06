<?php
/* Example Language File */

class mainLanguage{

    public $tr = [
      "header" => "UrlVector",
      "subHeader" => "Aksoylu URL kısaltma sunucusuna hoşgeldiniz.",
      "start_here" => "Başlamak için bu linke tıkla :",
      "about_page" => "Hakkında Sayfası",
      "credits" => "Powered by UrlVector ",
      "checkout" => "Link kısaltması için kontrol edin",
      "check" => "Kontrol et",

      "navigation_url" => "Yönlendirilecek URL",
      "navigation_placeholder" => "http://seninsiten.com/link",
      "navigation_url_sub" => "(Hedef URL)",
      "pin_placeholder" => "4 haneli pin kodu",
      "pin" => "Pin",
      "pin_sub" => "Pin kodu, daha sonra URL'i yönetebilmenizi sağlar", 
      "navigation_delay" => "Yönlendirme beklemesi (3 Saniye)",
      "user_message_header" => "Yönlendirme Mesajı",
      "user_message_placeholder" => "Mesaj...",
      "user_message_text" => "Ziyaretçiler yönlendirmeden önce bu mesajı görecektir",
      "ok_button" => "Tamamla",
      
      /* Service */
      "available" => "Bu URL kısaltmasını kullanabilirsiniz.",
      "not_available" => "Maalesef bu URL daha önce alınmış.",
      "issued" => "URL yönlendirmeniz başarıyla oluşturuldu ",
      "service_server_error" => "Sunucu tarafında bir sorun oluştu. İşlem başarısız. Bunun için üzgünüz.",
      "variable_not_available" => "Lütfen beklendiği gibi {area} alanını en az {min} en çok {max} olarak doldurun",
      "url_not_valid" => "'{url}' adresi doğru gözükmüyor. Lütfen kontrol edin.",
      "text_target_path" => "Hedef link",
      "text_source_url" => "Kaynak url",
      "text_password" => "Pin",

      /* Navigation */
      "navigating_text" => "<b> {url} </b> adresine yönlendiriliyorsunuz...",
      "time_left" => " Saniye",
      "not_found" => "Ziyaret etmek istediğiniz URL mevcut değil. Dilerseniz siz oluşturabilirsiniz",
    ];

    public $en = [
      "header" => "Url.Aksoylu.Space",
      "subHeader" => "Welcome to Aksoylu URL shortener servers.",
      "start_here" => "Click here for start :",
      "about_page" => "About Page",
      "credits" => "Proton Framework Official Web Site :",
      "checkout" => "Checkout for generating an url shortcut",
      "check" => "Check",

      "navigation_url" => "Navigate URL",
      "navigation_placeholder" => "http://yoursite.com/link",
      "navigation_url_sub" => "(Target URL)",
      "pin_placeholder" => "Pin (4 Digits)",
      "pin" => "Pin",
      "pin_sub" => "Pin code allows you to manage url after issuing", 
      "navigation_delay" => "Navigation Delay (3 Sec)",
      "user_message_header" => "Routing Message",
      "user_message_placeholder" => "Message...",
      "user_message_text" => "Visitors will see this message before redirecting",
      "ok_button" => "Save",

      /* Service */
      "available" => "You can use this URL shortener.",
      "not_available" => "Sorry, this URL has already been taken.",
      "issued" => "Your URL has been successfully created",
      "service_server_error" => "There was a problem on the server side. The operation failed. We are sorry for that.",
      
      "variable_not_available" => "Please fill in {area} as minimum {min} and maximum {max} as expected",
      "url_not_valid" => "'{url}' not seems like a valid url. Please check.",
      "text_target_path" => "Target link",
      "text_source_url" => "Source url",
      "text_password" => "Pin",

      /* Navigation */
      "navigating_text" => "You are navigating to <b> {url} </b> ...",
      "time_left" => " Seconds",
      "not_found" => "The URL you want to visit does not exist. If you wish, you can create",
    ];



}


?>