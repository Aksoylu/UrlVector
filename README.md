
# Url Vector
<center>
<img src="/assets/img/logo.png" alt="Proton Framework Logo" width="50%"/>
</center>
An URL Shortening Service Created with Proton Framework <br>
<img src="/assets/img/proton.png" alt="Proton Framework Logo" width="30%"/>
<br>
<a href="http://proton.aksoylu.space">Click for Proton Framework</a>

## How to install & staring up the project ?
1) Import the **/urlvector__migrate.sql** file on your MySQL (or MariaDb) server
2) Specify the database credentials in **/config.php**. (Also give attention for your database's true charset format, mine was utf-8)
3) Also you have to configure **PROJECT_NAME** and **DOMAIN** fields for your conditions.
4) If you are using SSL certificate, you have to change **PROTOCOL** to **https** from **http**
5) Don't touch anything other than these.

Note that this is an open source project with GPL licence soi  don't guarantee your security. You have to pay attention on your own server security.

## Usage (DEMO)

You can check a running demo on <a href="http://url.aksoylu.space">URL.AKSOYLU.SPACE</a> (My own Url shortener service)

<center>
<img src="http://proton.aksoylu.space/view/assets/img/demo.gif" alt="Url Vector Demo" width="80%"/>
</center>