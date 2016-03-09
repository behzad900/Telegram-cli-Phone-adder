# Telegram-cli-Phone-adder
add batch phone number with php into telegram-cli 

This class help to you for addphone number from your telegrambot into telegram-cli 

    public $webhook; //This is webhook address for connection bot and your telegram-cli "IMPORTANT YOUR LINK MUST SUPORTED SSL";
    public $phone; //Phone number for adding no to telegram-cli
    public $botapicode; //Bot api code you can take this from @Botfather into telegram-chat just put without Bot
    public $name; // Your name this is opetion for registerd phone never used in telegram you can set default info for fill from bot
    public $lastname; // see /|\ top
    public $password; // This password default if  your telgram phone have two step verificatiob code must be set password to fill auto fill
    public $telegram_cli_path; // This is very important you must set full path telegram-cli to for use and run
    public $chat_id; // This is for give your report and use multi user add phone number , if you want evry one message to this bot can make phone
    public $ConfigPath; // Config path telegram-cli must have a config file this  config just for make this phone;
    public $CodeMakerPath; // This address for save  code and chatid for registered phone
  
  How to use?
  
        include("TelegBotZILA.php");
        $Telegram = new TelegBotZILA;
        $Telegram->setPhone("00639434279383");
        $Telegram->Start();

 upload hook.php into ssl site and put the hook link into TelegBotZila.php

 if have any question pm me into telegram  @behzadz
  
