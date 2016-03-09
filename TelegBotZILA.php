<?php
class TelegBotZILA
{
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
    public function __construct($data)
    {
        $this->webhook           = "https://bot.passwoord.com/html/"; //telegram bot webhook link
        $this->phone             = ""; //phone number
        $this->botapicode        = "botapi";
        $this->name              = "behzad";
        $this->lastname          = "monfared";
        $this->password          = "123";
        $this->telegram_cli_path = "/root/tg/bin/telegram-cli";
        $this->chat_id           = 99740855;
        $this->ConfigPath        = "/var/www/html/telegram-php/";
        $this->CodeMakerPath     = "/var/www/html/telegram-php/code/";
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function resetFile()
    {
        //reset phone this is for chek if config file and chatid temperory code if maked delete all

        if (file_exists($this->CodeMakerPath . $this->phone)) {
            shell_exec("rm " . $this->CodeMakerPath . $this->phone);
        } //file_exists($this->CodeMakerPath . $this->phone)
        if (file_exists($this->ConfigPath . "config.txt")) {
            shell_exec("rm " . $this->ConfigPath . "config.txt");
        } //file_exists($this->ConfigPath . "config.txt")
        return;
    }

    public function chekavr($string)
    {
        //This option for advanced verion and not completed now you can use addnew.
        switch ($string) {
            case "incorrect":
                if (strpos($s, $val) != false) {
                    $validcode = "incorrect Password";
                    $this->sendMessage($validcode);
                    $this->resetFile();
                    $this->webhook();
                    return $write = $this->ChekCode();
                } //strpos($s, $val) != false
                break;
            case "phone":
                $validcode = "Phone number";
                sendMessage($validcode);
                return $this->phone;
                break;
            case "register":
                if (strpos($s, $val) != false) {
                    $validcode = "Register ";
                    sendMessage($this->chat_id, $validcode);
                    return $write = $this->name;
                } //strpos($s, $val) != false
                break;
            case "for phone code":
                if (strpos($s, $val) != false) {
                    $validcode = "Please enter Code";
                    $this->sendMessage($validcode);
                    $this->resetFile();
                    $this->webhook();
                    return $write = $this->ChekCode();
                } //strpos($s, $val) != false
                break;
            case "was online [":
                $write = "D";
                break;
        } //$string
    }
    public function addnew()
    {

        //START to run telegram-cli with phone number and chatid .

        //Step1 -> first make one file into CodeMakerPath from this class file name is user chat_id and content file just phone!
        file_put_contents('/var/www/html/telegram-php/code/' . $this->chat_id, $this->phone);
        //run reset file for delete all temp similler file for past;
        $this->resetFile();
        //Make config file for telegram-cli
        $this->MakeConfig();
        //Step 3 ProcOpen connectors array
        $descriptors = array(
            0 => array(
                "pipe",
                "r",
            ),
            1 => array(
                "pipe",
                "w",
            ),
        );
        //AND we must fill full telegram-cli patj and execute to run for make new phone id
        /*
        -U : this option for run from rootuser
        -p : for profile name $this->MakeConfig(); make config file for phone number and config file name for phone is q+phonenumber
        -k : tg-server.pub
        -c : config file for read telegram-cli and start proc open
         */
        $process = proc_open($this->telegram_cli_path . " -U root -w -p q$this->phone -k " . $this->telegram_cli_path . " -c config.txt", $descriptors, $pipes);
        if (is_resource($process)) {
            //we have one for for read all number from telegram-cli to execute.
            for ($i = 0; $i < 20; $i++) {

                stream_set_blocking(STDIN, 0);

                //and all data put the $s; LINE by Line;

                $s = fread($pipes[1], 16384 * 4);
                echo $s;

                // set option for all question cli from user
                /*
                Phone Number : first one for add phone into telegram-cli fill a phone number but telegram-cli havent fixed time for tell user when enter your phone number . we make on line for wating for my word if used in line and execute command.

                Register:  if you fill $this->lastname & $this->name;
                fill it to info

                password : YOU MUST SET PASSWORD TO THIS VERISON YOU CANT live enter password;
                for phone code): this for code 5 digit number if you see this comment remember i said we must make one file name=chat_id and content = phone number . if line strpos = phone code mean this code sended to mobile or telegramclient to this step you should send just 5 digit number into your bot and down but How?  if you scroll down and see line 242 we have one function sethook evryrun this class your webhook webhook is changed to webhook code . webhook.php as soon as send user chat id
                for send me code if user send code to bot bot chek this if CodeConfig file have a chatid file open chatid file and get_content phone number for end make on file is name phonenumber and content 5 digit code and bot is down

                we going next...

                 */

                if (strpos($s, "phone number:") != false) {
                    $text = "";
                    //echo "phone";
                    fwrite($pipes[0], $this->phone . "\n");
                    $text .= "Phone number";
                    $this->sendMessage($text);
                } //strpos($s, "phone number:") != false
                if (strpos($s, "register") != false) {
                    //  echo "Register";
                    $text .= "register with name and lastname";
                    fwrite($pipes[0], "y\n");
                    $text .= " نام y
                ";
                    fwrite($pipes[0], "$this->name\n");
                    $text .= " نام فامیل y
                ";
                    fwrite($pipes[0], "$this->lastname\n");
                } //strpos($s, "register") != false
                if (strpos($s, "password:") != false) {
                    fwrite($pipes[0], "$this->phone\n");
                    sleep(1);
                    $text .= "Please enter Passwords ";
                } //strpos($s, "password:") != false

                //this text for send realtime alarm for line by line executer runed .
                // this is one loop for run with sleep2 and chek if into config-code path have phone file
                // this mean user write code so get content code and pass it to codeb for run telegram-cli

                if (strpos($s, "for phone code)") != false) {
                    $text .= "YOUR code For use ";
                    //  echo "Register";
                    $this->sendMessage($text);
                    $codeb = $this->ChekCode();
                    fwrite($pipes[0], "$codeb\n");
                    sleep(1);
                    //  $validx = 1;
                } //strpos($s, "for phone code)") != false

                //this is end line for chek if see was online your telegram-cli phone number maked evry work from this class runed into 10 second i add 30.000 phone id from 1 day.

                if (strpos($s, "was online [") != false) {
                    $textz = "YOUR PHONE REGISTERED";
                    $this->sendMessage($textz);
                } //strpos($s, "was online [") != false
                sleep(1);
            } //$i = 0; $i < 20; $i++
            fclose($pipes[0]);
            $return_value = proc_close($process);
        } //is_resource($process)
    }
    public function MakeConfig()
    {
        //address for path to temp make config for telegram-cli
        $configfile = 'q' . $this->phone . ' = {config_directory = "/root/.telegram-cli/q' . $this->phone . '";};';
        $x          = "echo '$configfile' >> " . $this->ConfigPath . "config.txt\n";
        shell_exec($x);
        return;
    }
    public function sendMessage($text)
    {
        //send report message for report
        $replyMarkup = array(
            'keyboard' => array(
                array(
                    "behzad900",
                ),
            ),
        );
        $encodedMarkup = json_encode($replyMarkup);
        $content       = array(
            'chat_id' => $this->chat_id,
            'reply_markup' => $encodedMarkup,
            'text' => "$text",
        );
        $url  = "https://api.telegram.org/bot" . $this->botapicode . "/sendMessage";
        $keyb = array(
            'ReplyKeyboardMarkup' => array(
                'keyboard' => array(
                    array(
                        "A",
                        "B",
                    ),
                ),
            ),
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($content));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }
    public function sethook()
    {
        file_get_contents("http://api.telegram.org/bot" . $this->botapicode . "/setWebhook?url=");
        file_get_contents("http://api.telegram.org/bot" . $this->botapicode . "/setWebhook?url=" . $this->webhook);
        return;
    }
    public function ChekCode()
    {
        if (file_exists($this->CodeMakerPath . $this->phone)) {
            $codeb = file_get_contents($this->CodeMakerPath . $this->phone);
            return $codeb;
        } //file_exists("/var/www/html/telegram-php/code/" . $this->phone)
        else {
            return $this->timeloo();
        }
        return;
    }
    public function timeloo()
    {
        sleep(3);
        return $this->ChekCode();
    }
}
$b = new TelegBotZILA;
$b->setPhone("00639434279383");
$b->addnew();
