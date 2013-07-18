<?
set_time_limit(0);

define('MAIN_COOKIE', 'eda=ozicoder%40gmail.com%3A5KxQQeWSegcBo; expires=Sat, 28-Jul-2012 22:59:48 GMT; path=/; domain=.eda.by');
define('REGISTER_COOKIE', 'mobile=no; PHPSESSID=e4279cc2afa1dacb101abb69dcdda485; __utma=125156309.610870279.1343431633.1343592210.1343673386.18; __utmb=125156309.13.10.1343673386; __utmc=125156309; __utmz=125156309.1343431633.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); _ym_visorc=w');

list($usec, $sec) = explode(' ', microtime());
srand((float)$sec + ((float)$usec * 100000));

class RegisterException extends Exception
{
}

class AttackException extends Exception
{
}

class Downloader
{
    private $curl;

    static $user_agent = "Mozilla 4 (compatible; MSIE 6.0; LAS Linux)";

    public $response_cookie;

    private function init_curl($url, $post, $request_cookie, $referer = "http://www.eda.by/")
    {
        $this->curl = curl_init($url);

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 10);

        if ($post) {
            curl_setopt($this->curl, CURLOPT_POST, 1);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $post);
        }

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
            'Accept-Language:ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
            'Cookie:'.REGISTER_COOKIE,
            'Host:www.eda.by',
            'Origin:http://www.eda.by',
            'Referer:http://www.eda.by/my/register/',
            'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.904.0 Safari/535.7',
        ));
    }

    public function download($url, $post = "", $request_cookie = "", $referer = "http://www.eda.by/")
    {

        /* echo "Downloading: ".$url."<br/>\n";
        echo "POST: ".$post."<br/>\n";
        echo "Cookie: ".$request_cookie."<br/>\n\n";
        flush();
        */
        $this->init_curl($url, $post, $request_cookie, $referer);

        curl_setopt($this->curl, CURLOPT_HEADER, true);

        $response = curl_exec($this->curl);
        $header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        print_r($response);
        exit();

        $response_header = substr($response, 0, $header_size);
        $response_body = substr($response, $header_size);

        preg_match_all("/Set-Cookie: (.*?)=(.*?);/i", $response_header, $res);

        $this->response_cookie = '';
        foreach ($res[1] as $key => $value)
            $this->response_cookie .= $value . '=' . $res[2][$key] . '; ';

        curl_close($this->curl);

        return $response_body;
    }

    public function fast_download($url, $post = "", $request_cookie)
    {
        $this->init_curl($url, $post, $request_cookie);
        $response = curl_exec($this->curl);

        curl_close($this->curl);

        return $response;
    }
}

class User
{
    var $target;
    var $cookie_code;
    var $email;
    var $is_final;
    var $phone;
    var $name;
    var $password;
    var $delay = 0;
    var $last_run = 0;

    static $email_length = 8;
    static $email_letters = "qwertyuiopasdfghjkzxcvbnm1234567890";
    static $email_domains = array('tut.by', 'gmail.com', 'mail.ru', 'yandex.ru');

    static $phone_codes = array('29', '33', '44', '17');
    static $names = array('Игорь');

    static $default_password = "password";

    public function __construct($email = '', $cookie_code = '')
    {
        $this->email = $email;
        $this->cookie_code = $cookie_code;
    }

    public function rand()
    {
        $this->email = "";

        for ($i = 0; $i < self::$email_length; $i++)
            $this->email .= self::$email_letters[(rand() % (strlen(self::$email_letters)))];

        $this->email .= '@' . self::$email_domains[rand() % (count(self::$email_domains))];

        $this->name = self::$names[rand() % (count(self::$names))];

        $this->phone = '+375 (' . self::$phone_codes[rand() % (count(self::$phone_codes))] . ') ';
        foreach (array(3, 2, 2) as $ind => $num) {
            if ($ind > 0)
                $this->phone .= '-';
            for ($i = 0; $i < $num; $i++)
                $this->phone .= ((rand() % 9) + 1);
        }

        $this->password = self::$default_password;

    }

    public function register()
    {
        $downloader = new Downloader();

        $post = 'us_email=' . urlencode($this->email) . '&password1=' . $this->password . '&password2=' . $this->password . '&us_name=' . urlencode($this->name) . '&us_mobile=' . urlencode($this->phone) . '&us_phone=&us_address=&hb=&act=register';

        $text = $downloader->download('http://www.eda.by/enter.php', $post, REGISTER_COOKIE, 'http://www.eda.by/my/register/');

        if (strpos($text, 'Пользователь с таким e-mail уже существует') !== FALSE)
            throw new RegisterException('Пользователь с таким e-mail уже существует');

        if (strpos($text, 'Вы уже регистрировались с этим номером телефона') !== FALSE)
            throw new RegisterException('Пользователь с таким телефоном уже существует');

        if (strpos($text, 'Вы не ввели свой номер мобильного телефона') !== FALSE)
            throw new RegisterException('Пользователь с таким телефоном уже существует');

        if (strpos($text, 'Вы не ввели свое имя') !== FALSE)
            throw new RegisterException('Вы не ввели свое имя');

        if (strpos($text, 'Вы не ввели пароль') !== FALSE)
            throw new RegisterException('Вы не ввели пароль');


        $this->cookie_code = substr($downloader->response_cookie, strpos($downloader->response_cookie, '%3A5') + 1);
        $this->cookie_code = substr($this->cookie_code, 0, strlen($this->cookie_code) - 2);

        $text = $downloader->download('http://www.eda.by', '', MAIN_COOKIE);
        if (strpos($text, '<a href="http://www.eda.by/logout.php" class="logout"></a>') === FALSE)
            throw new RegisterException('Регистрация не прошла');

    }

    public function delay($seconds = 0)
    {
        $this->last_run = time();
        $this->delay = $seconds;
    }

    public function get_click_cookie()
    {
        return 'mobile=no; eda=' . urlencode($this->email) . '%' . $this->cookie_code . ';';
    }

}


class Log
{
    public static function write($text = "")
    {
        $date = getdate(time());
        echo $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . ' - ' . $text . "<br/>\n";
        flush();
    }
}

class Bot
{
    static $MAX = array(300, 300, 100, 100);
    static $minutes_delay = 7;
    static $start_waiting = 10;
    static $stop_clicking = 10;


    private $users = array();
    private $target;
    private $max;
    private $final_user;

    private $attack_target;

    private $downloader;

    public function __construct($bots, $user)
    {
        if (is_array($bots))
            $this->users = $bots;
        else
            throw new Exception();
        $this->target = $user->target;
        $this->attack_target = $this->target + 4;
        $this->max = self::$MAX[$this->target - 1];

        $this->final_user = $user;

        $this->downloader = new Downloader();
    }

    private function click(User $user)
    {
        if (empty($user->target) || !isset(self::$MAX[$user->target - 1]))
            throw new AttackException('User target is incrorrect');

        if (empty($user->cookie_code))
            throw new AttackException('User cookie code is incrorrect');

        $text = $this->downloader->download('http://www.eda.by/enter.php', 'act=crazyg&r=' . $this->attack_target, $user->get_click_cookie());

        if (strpos($text, 'Уже') !== FALSE)
            Log::write("Click " . $user->email . ": " . $text);

        if (strpos($text, 'Осталось') !== false)
            return 10;
        else
            return 0;
    }

    private function attack(User $user)
    {
        /*   if (empty($user->target) || !isset(self::$MAX[$user->target - 1]))
               throw new AttackException('User target is incrorrect');

           if (empty($user->cookie_code))
               throw new AttackException('User cookie code is incrorrect');

        */


        //    do {
        $text = $this->downloader->fast_download('http://www.eda.by/enter.php', 'act=crazyg&r=' . $this->attack_target, $user->get_click_cookie());
        //        print_r($text);exit();
        //     } while (strpos($text, 'Осталось') === FALSE && strpos($text, 'Победили') === FALSE);

        Log::write("Attack " . $user->email . " (" . $user->phone . "): " . $text);
        return strpos($text, 'Победили') === TRUE;
    }

    public function run()
    {
        Log::write('Click mode');


        $need_waiting = false;
        while (!$need_waiting) {
            $count = $this->get_count();

            foreach ($this->users as &$user) {

                if ($this->max - $count < self::$start_waiting) {
                    $need_waiting = true;
                    break;
                }

                if (time() < $user->last_run + $user->delay)
                    continue;
                $user->delay($this->click($user));
            }
        }

        $this->waiting();
    }

    public function waiting()
    {
        Log::write('Waiting mode');
        $old_count = 0;

        while (1) {
            $count = $this->max - $this->get_count();
            Log::write($count);
            if ($count == 1) {
                $this->attack($this->final_user);
                break;
            }
            if ($old_count != $count) {
                Log::write("waiting " . $count);
                $old_count = $count;
            }
        }

        $this->finish();
        $this->run();
    }


    private function get_count()
    {
        $text = $this->downloader->fast_download('http://www.eda.by/', '', MAIN_COOKIE);
        preg_match_all('#onmouseout=\"UnTip\(\)\"><p>(\d+)#si', $text, $items);
        return $items[1][$this->target - 1];
    }

    private function finish()
    {
        Log::write('Finish');
        exit();
    }


}


/*$user = new User();
$user->rand();
$user->register();

print_r($user);exit();        */

$final_user = new User('kodie666@mail.ru', '3A5KkOsyJkmM2u6');
$final_user->phone = '670-47-90';
$final_user->target = 1;

/*foreach ($bots as &$bot)
    $bot->target = 1;

               
$count = 0;
while ($count++ < 100) {
    $user = new User();
    $user->rand();
    $user->register();
    echo "new User('" . $user->email . "', '" . $user->cookie_code . "'),\n";
    flush();
}
exit();*/

$app = new Bot($bots, $final_user);
$app->run();


?>