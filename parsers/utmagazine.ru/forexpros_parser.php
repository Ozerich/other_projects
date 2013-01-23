<?php

require_once('wp-config.php');
require_once('wp-admin/admin-functions.php');

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');


abstract class Downloader
{

    protected $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.8.0.9) Gecko/20061206 Firefox/1.5.0.9";
    protected $proxy_string = "";

    public function setProxy($proxy)
    {
        $this->proxy_string = $proxy;
    }

    protected $referer = "";

    public function setReferer($_value)
    {
        $this->referer = $_value;
    }

    private $get_params = "";

    public function setGET($params)
    {
        $params = is_array($params) ? $params : array($params);
        foreach ($params as $param => &$value)
            $value = $param . '=' . urlencode($value);

        $this->get_params = implode('&', $params);
    }

    public function download($url, $ajax = false)
    {
        $url_download = $url;

        if (!empty($this->get_params)) {
            if (strpos($url, "?") !== false) {
                $url_download = $url . "&" . $this->get_params;
            } else {
                $url_download = $url . "?" . $this->get_params;
            }

        }

        return $this->do_download($url_download, $ajax);
    }

    abstract public function do_download($url, $ajax);
}

class CURL_Downloader extends Downloader
{
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 20);
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }


    public function do_download($url, $ajax)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);

        if (!empty($this->referer)) {
            curl_setopt($this->curl, CURLOPT_REFERER, $this->referer);
        }

        curl_setopt($this->curl, CURLOPT_USERAGENT, $this->user_agent);

        $headers = array();

        if ($ajax == true) {
            $headers[] = "X-Requested-With: XMLHttpRequest";
        }

        if (!empty($headers)) {
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        }

        $data = curl_exec($this->curl);

        return $data;
    }
}

abstract class Logger
{
    abstract function write($text);
}

class Simple_Logger extends Logger
{
    public function write($text)
    {
        echo $text . "<br/>\r\n";
        flush();
    }
}

class ForexprosParser
{

    private $downloader;
    private $logger;

    static $requestUrl = "http://www.forexpros.ru/common/economicCalendar/economicCalendar.data.php";

    private $timezone;

    public function setLogger(Logger $_logger)
    {
        $this->logger = $_logger;
    }

    public function setDownloader(Downloader $_downloader)
    {
        $this->downloader = $_downloader;
    }


    private function convertDate($timestamp)
    {
        $date = getdate($timestamp);
        return $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
    }

    private function getValuesParam($date_start, $date_finish, $currencies)
    {
        $result = 'dateFrom=' . $this->convertDate($date_start) . ',dateTo=' . $this->convertDate($date_finish);

        $currencies = is_array($currencies) ? $currencies : array($currencies);
        foreach ($currencies as $currency) {
            //  $result .= ',currency=' . $currency;
        }

        $result .= ',timeZone=' . $this->timezone . ",dts=off";

        return $result;
    }

    private function getStartWeek()
    {
        $date = getdate();
        $week = $date['wday'] == 0 ? 7 : $date['wday'];

        $monday = getdate(time() - 86400 * ($week - 1));
        return mktime(0, 0, 0, $monday['mon'], $monday['mday'], $monday['year']);
    }

    private function p($param)
    {
        $param = trim(strip_tags(html_entity_decode($param, ENT_QUOTES, 'UTF-8')));
        return $param;
    }

    private function parse($html)
    {
        $result = array();

        preg_match_all('#whiteFont.+?<td.+?>(.+?)</td>#sui', $html, $days, PREG_SET_ORDER);

        foreach ($days as $day) {

            $weekday = $day[1];

            $html = substr($html, strpos($html, $weekday));
            $day_text = strpos($html, 'whiteFont') !== false ? substr($html, 0, strpos($html, 'whiteFont')) : $html;
            $result[$weekday] = array();

            preg_match_all('#<tr onmouseout=.+?<td.+?>(.+?)</td><td.+?>(.+?)</td><td.+?>(.+?)</td><td.+?>(.+?)</td><td.+?>(.+?)</td><td.+?>(.+?)</td><td.+?>(.+?)</td><td.+?>(.+?)</td><td.+?>(.+?)</td></tr>#sui', $day_text, $items, PREG_SET_ORDER);

            $flags = array(
                'China' => 'asian',
                'United_Kingdom' => 'england',
                'Germany' => 'german',
                'Japan' => 'japan',
                'United_States' => 'usa',
                'Russian_Federation' => 'russia',
                'Europe' => 'eurounion',
                'New_Zealand' => 'austr',
                'Canada' => 'canada',
            );

            foreach ($items as $item) {
                preg_match('#class\=\"ceFlags (.+?)\"#sui', $item[2], $flag);
                $flag = isset($flag[1]) && isset($flags[$flag[1]]) ? $flags[$flag[1]] : 'blank';
                preg_match('#red_(\d+)_BullishIcon#sui', $item[3], $bulls);
                $bulls = $bulls[1];

                if ($flag == 'usa' || $bulls == 3) {
                    $result[$weekday][] = array(
                        'time' => $this->p($item[1]),
                        'currency' => $this->p($item[2]),
                        'bulls' => $bulls,
                        'name' => $this->p($item[4]),
                        'fact' => $this->p($item[5]),
                        'forecast' => $this->p($item[6]),
                        'prev' => $this->p($item[7]),
                        'flag' => $flag
                    );
                }
            }
        }
        return $result;
    }

    private function reset($start, $end)
    {
        global $wpdb;

        $posts = $wpdb->get_results("SELECT id FROM " . $wpdb->prefix . "posts WHERE `post_type` = 'events'");
        foreach ($posts as $post) {
            $post_id = $post->id;
            if (get_post_meta($post_id, 'timezone', true) == $this->timezone) {
                $wpdb->query("DELETE FROM " . $wpdb->prefix . "posts WHERE id = " . $post_id);
            }
        }
    }

    public function run($currencies, $timezone)
    {
        $this->timezone = $timezone;

        $start_week = $this->getStartWeek();
        $end_week = $start_week + 7 * 86400 - 1;
        $this->reset($start_week, $end_week);

        $valueParams = $this->getValuesParam($start_week, $end_week, $currencies);

        $this->downloader->setGET(
            array(
                'action' => 'filter',
                'elemntsValues' => $valueParams,
                'timeFrame' => 'weekly'
            )
        );

        $data = $this->downloader->download(self::$requestUrl, true);
        $items = $this->parse($data);

        $this->save_items($items);
    }

    private function save_items($items)
    {
        $start_week = $this->getStartWeek();
        $day_names = array('Понедельник' => 0, 'Вторник' => 1, 'Среда' => 2, 'Четверг' => 3, 'Пятница' => 4, 'Суббота' => 5, 'Воскресенье' => 6);

        foreach ($items as $day => $data) {
            $day_name = substr($day, 0, strpos($day, ','));
            $day_num = $day_names[$day_name];
            $day_start = $start_week + 86400 * $day_num;

            foreach ($data as $item) {
                $item_time = $day_start + (substr($item['time'], 0, 2) * 3600 + substr($item['time'], 3, 2) * 60);

                $post_id = wp_insert_post(array(
                    'post_date' => date('Y-m-d H:i:s', $item_time),
                    'post_title' => $item['name'],
                    'post_type' => 'events',
                    'post_status' => 'publish',
                ));

                update_post_meta($post_id, 'calwait', $item['forecast']);
                update_post_meta($post_id, 'calprev', $item['prev']);
                update_post_meta($post_id, 'calreal', $item['fact']);
                update_post_meta($post_id, 'calselect', $item['bulls'] > 1 ? 'yes' : 'no');
                update_post_meta($post_id, 'calcountry', 'cal' . $item['flag']);
                update_post_meta($post_id, 'timezone', $this->timezone);
                update_post_meta($post_id, 'bulls', $item['bulls']);

            }
        }
    }
}


$parser = new ForexprosParser();

$parser->setLogger(new Simple_Logger());
$parser->setDownloader(new CURL_Downloader());

$parser->run(5, 8);
$parser->run(5, 18);
?>