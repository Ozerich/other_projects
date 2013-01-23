<?php

require_once('wp-config.php');
require_once('wp-admin/admin-functions.php');

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

abstract class Downloader
{

    protected $user_agent = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17";
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
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 10);
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

class Item
{
    private $name;
    private $price;
    private $time;

    private $status; //0 before, 1 after

    public $method;

    public function setName($value)
    {
        $this->name = $value;
    }

    public function setPrice($value)
    {
        $this->price = $value;
    }

    public function setTime($value)
    {
        $this->time = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($value)
    {
        if ($value == 'bto') {
            $this->status = 0;
        } else if ($value == 'atc') {
            $this->status = 1;
        } else {
            throw new InvalidArgumentException("Incorrect status");
        }
    }

    public function getCode()
    {
        $code = substr($this->name, strrpos($this->name, '(') + 1);
        return substr($code, 0, strrpos($code, ')'));
    }

    public function __construct($name, $time, $price, $status)
    {
        $this->setName($name);
        $this->setTime($time);
        $this->setPrice($price);
        $this->setStatus($status);
        $this->setPrevYear('');
        $this->setEPS('');
        $this->setMkt('');
    }

    private $prev_year;

    public function setPrevYear($_value)
    {
        $this->prev_year = $_value;
    }

    public function getPrevYear()
    {
        return $this->prev_year;
    }

    private $mkt;

    public function setMkt($_value)
    {
        $this->mkt = $_value;
    }

    public function getMkt()
    {
        return $this->mkt;
    }

    private $eps;

    public function setEPS($_value)
    {
        $this->eps = $_value;
    }

    public function getEPS()
    {
        return $this->eps;
    }

    private $eps_cons;

    public function setEPS_cons($_value)
    {
        $this->eps_cons = $_value;
    }

    public function getEPS_cons()
    {
        return $this->eps_cons;
    }

    private $rev;

    public function setRev($_value)
    {
        $this->rev = $_value;
    }

    public function getRev()
    {
        return $this->rev;
    }

    private $rev_cons;

    public function setRev_cons($_value)
    {
	
        $this->rev_cons = $_value == 'N/A / N/A' ? 'N/A' : trim($_value);
    }

    public function getRev_cons()
    {
        return $this->rev_cons;
    }
}

abstract class Checker
{

    protected $downloader;
    protected $logger;

    public function __construct(Downloader $downloader, Logger $logger)
    {
        $this->downloader = $downloader;
        $this->logger = $logger;
    }

    abstract function check(Item $item, $date);
}

class StreetInsiderChecker extends Checker
{

    private $lists_before;
    private $lists_after;

    private function get_url($date)
    {
        return 'http://www.streetinsider.com/ec_earnings.php?day=' . date('Y-m-d', $date);
    }

    public function __construct(Downloader $downloader, Logger $logger)
    {
        parent::__construct($downloader, $logger);

        $this->lists_after = array();
        $this->lists_before = array();
    }

    public function check(Item $item, $date)
    {
        if (!isset($this->lists_after[$date])) {

            $this->lists_after[$date] = array();
            $this->lists_before[$date] = array();

            $text = $this->downloader->download($this->get_url($date));

            $cycle = array('lists_before' => 'Earnings Before the Market Opens', 'lists_after' => 'Earnings After the Market Close');
            foreach ($cycle as $param => $header) {
                if (!preg_match('#<h3>' . $header . '</h3><table(.+?)</table>#sui', $text, $data)) {
                    continue;
                }
                preg_match_all('#<tr class="is_future ">.+?<td.*?<td>.+?>(.+?)<#sui', $data[1], $items);

                if ($param == 'lists_before') {
                    $this->lists_before[$date] = $items[1];
                } elseif ($param == 'lists_after') {
                    $this->lists_after[$date] = $items[1];
                }
            }
        }

        $array = $item->getStatus() == 0 ? $this->lists_before[$date] : $this->lists_after[$date];
        return in_array($item->getCode(), $array);
    }

}

class BusinessWireChecker extends Checker
{
    private $list;

    private function get_url($date)
    {
        return 'http://www.wallstreethorizon.com/cal_gen/cal_gen.asp?opt=/BIZWIRE&date=' . date('n/j/Y', $date);
    }

    public function check(Item $item, $date)
    {
        if (!isset($this->list[$date])) {
            $text = $this->downloader->download($this->get_url($date));
            preg_match_all("#<td class='underline'\s\salign=left>(.+?)</td>#sui", $text, $items);
            $this->list[$date] = $items[1];
        }

        return in_array($item->getCode(), $this->list[$date]);
    }

}

class EarningsChecker extends Checker
{

    private $cache;

    private function get_url(Item $item)
    {
        return 'http://www.earnings.com/company.asp?client=cb&ticker=' . $item->getCode();
    }

    public function check(Item $item, $date)
    {
        if (!isset($this->cache[$item->getCode()])) {

            $this->cache[$item->getCode()] = array();

            $text = $this->downloader->download($this->get_url($item));

            if (!preg_match('#<b>Earnings Releases</b>.+?</table>(.+?)</table>#si', $text, $data)) {
                return false;
            }

            preg_match_all('#<tr class="bgWhite".+?>.*?<td.*?>(.+?)</td>.*?<td.*?>(.+?)</td>.*?<td.*?>(.+?)</td>.*?<td.*?>(.+?)</td>.*?<td.*?>(.+?)</td>.*?<td.*?>(.+?)</td>.*?<td.*?>(.+?)</td>.*?</tr>#si', $data[1], $items);

            $dates = $items[6];
            array_shift($dates);

            foreach ($dates as $_date) {
                $_date = trim(strip_tags($_date));
                $_date = substr($_date, 0, 9);
                $_date = strtotime($_date);

                $this->cache[$item->getCode()][] = $_date;
            }
        }

        return in_array($date, $this->cache[$item->getCode()]);
    }

}


class Parser
{

    private $downloader;
    private $logger;

    private $checkers = array();

    public function addChecker(Checker $checker)
    {
        $this->checkers[] = $checker;
    }

    public function setLogger(Logger $_logger)
    {
        $this->logger = $_logger;
    }

    public function setDownloader(Downloader $_downloader)
    {
        $this->downloader = $_downloader;
    }

    private function get_today()
    {
        $text = $this->downloader->download('http://www.earningswhispers.com/calendar.asp');

        $preg_date = preg_match('#Scheduled Earnings Releases for .+?, ((.+?) (.+?), (\d+))#sui', $text, $date);
        if (!$preg_date) {
            throw new Exception("Cannot get today date at earningswhispers.com");
        }

        return strtotime($date[1]);
    }

    private function get_url($date)
    {
        $diff = $date - $this->get_today();
        if ($diff < 0) {
            //   throw new Exception("Only current or future date");
        }
        return "http://www.earningswhispers.com/calendar.asp?way=N&day=-" . floor($diff / 86400) . "&s=t";
    }

    private function p($param)
    {
        $param = trim(strip_tags(html_entity_decode($param, ENT_QUOTES, 'UTF-8')));
        return str_replace('  -  ', '-', $param);
    }

    private function parse($url)
    {

        $result = array();
        $text = $this->downloader->download($url);

        $cycle = array('bto', 'atc');
        foreach ($cycle as $c) {
            preg_match('#function ' . $c . '.+?<table.+?>(.+?)</table>#sui', $text, $table);
            preg_match_all('#<tr.*?><td.*?>(.+?)</td><td.*?>(.+?)</td><td.*?>(.+?)</td><td.*?>(.+?)</td><td.*?>(.+?)</td><td.*?>(.+?)</td></tr>#sui', $table[1], $items, PREG_SET_ORDER);

            foreach ($items as $item) {
                $name = $this->p($item[2]);

                $result[] = new Item(
                    $this->p($name),
                    $this->p($item[4]),
                    $this->p($item[6]),
                    $c
                );
            }
        }

        return $result;
    }

    private function write_to_file($list, $filename)
    {
        $f = fopen($filename, "w+");

        foreach ($list as $item) {
            fputcsv($f, array(
                $item->getName(),
                $item->getTime(),
                $item->getPrice(),
                $item->method
            ));
        }

        fclose($f);
    }

    private function parseStreetInsider($code)
    {

        $url = 'http://www.streetinsider.com/ec_earnings.php?q=' . $code;
		$url = 'http://www.ozis.by/utmagazine/download_streetinsider.php?q='.$code;
		
        $text = $this->downloader->download($url);
		
        $result = array(
            'eps' => '',
            'eps_cons' => '',
            'rev' => '',
            'rev_cons' => ''
		);

        if (preg_match('#<tr class="LiteHover".*?>.*?<td.*?>(.*?)</td>.*?<td.*?>(.*?)</td>.*?<td.*?>(.*?)</td>.*?<td.*?>(.*?)</td>.*?<td.*?>(.*?)</td>.*?<td.*?>(.*?)</td>.*?<td.*?>(.*?)</td>.*?<td.*?>(.*?)</td>#sui', $text, $lines)) {
            $result = array(
                'eps' => trim(strip_tags($lines[4])),
                'eps_cons' => trim(strip_tags($lines[5])),
                'rev' => trim(strip_tags($lines[7])),
                'rev_cons' => trim(strip_tags($lines[8]))
            );
        }
		
        return $result;

    }

    public function run($date)
    {

        global $wpdb;

        $wpdb->query("DELETE FROM " . $wpdb->prefix . "reports WHERE day = " . $date);

        $url = $this->get_url($date);
        $list = $this->parse($url);

        $result_list = array();

        foreach ($list as $item) {

            $this->logger->write("Start checking: " . $item->getCode());

            $approved = false;

            foreach ($this->checkers as $ind => $checker) {
                if ($checker->check($item, $date)) {
                    $approved = true;
                    $this->logger->write("Check " . ($ind + 1) . ": OK");
                    $item->method = $ind + 1;
                    break;
                }

                $this->logger->write("Check " . ($ind + 1) . ": Failed");
            }

            if ($approved) {
                $result_list[] = $item;
            }
        }

        foreach ($result_list as &$item) {

            $item_code = $item->getCode();

            $item->setPrevYear($this->parsePrevYear($item_code));
            $item->setMkt($this->parseMkt($item_code));

            $street_insider_data = $this->parseStreetInsider($item_code);

            $item->setEPS($street_insider_data['eps']);
            $item->setEPS_cons($street_insider_data['eps_cons']);
            $item->setRev($street_insider_data['rev']);
            $item->setRev_cons($street_insider_data['rev_cons']);
        }

        $this->save($result_list, $date);
    }

    private function parsePrevYear($code)
    {
        $url = 'http://www.earnings.com/company.asp?client=cb&ticker=' . $code;
        $text = $this->downloader->download($url);

        if (!preg_match('#<b>Earnings Releases</b>.+?</table>.+?<tr class="bgWhite">.+?<td.+?<td.+?>Q(\d+)\&\#160;(\d+)</td>#si', $text, $first)) {
            return "";
        }

        $str = 'Q' . $first[1] . '\&\#160\;' . ($first[2] - 1);
        if (!preg_match('#<td.+?>' . $str . '</td>.*?<td.+?<td.+?<td.+?<td.*?>(.+?)</td>#si', $text, $result)) {
            return "";
        }
        return str_replace('&#160;', '', $result[1]);
    }

    private function parseMkt($code)
    {
        $url = 'http://finviz.com/quote.ashx?t=' . $code;
        $text = $this->downloader->download($url);

        if (!preg_match('#Market Cap</td><td.*?>(.+?)</td>#sui', $text, $result)) {
            return '';
        }

        return strip_tags(trim($result[1]));
    }

    private function save($data, $day)
    {
        global $wpdb;
        $exist = array();
        foreach ($data as $item) {
            if (in_array($item->getCode(), $exist)) {
                continue;
            }
            $exist[] = $item->getCode();
            $wpdb->query("DELETE FROM " . $wpdb->prefix . "reports WHERE ticket = '" . $item->getCode() . "' AND day = " . $day);

			$wpdb->insert($wpdb->prefix . "reports",
                array(
                    'day' => $day,
                    'ticket' => $item->getCode(),
                    'time' => $item->getTime(),
                    'name' => $item->getName(),
                    'price' => $item->getPrice(),
                    'status' => $item->getStatus(),
                    'prev_year' => $item->getPrevYear(),
                    'mkt' => $item->getMkt(),
                    'eps' => $item->getEPS(),
					'eps_cons' => $item->getEPS_cons(),
					'rev' => $item->getRev(),
					'rev_cons' => $item->getRev_cons()
                ),
                array('%d', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
            );
        }
    }
}

$parser = new Parser();

$parser->addChecker(new StreetInsiderChecker(new CURL_Downloader(), new Simple_Logger()));
$parser->addChecker(new BusinessWireChecker(new CURL_Downloader(), new Simple_Logger()));
$parser->addChecker(new EarningsChecker(new CURL_Downloader(), new Simple_Logger()));

$parser->setLogger(new Simple_Logger());
$parser->setDownloader(new CURL_Downloader());

$now = getdate(time());
$date = mktime(0, 0, 0, $now['mon'], $now['mday'] - 1, $now['year']) + 86400;

for ($i = 0; $i < 30; $i++, $date += 86400)
    $parser->run($date);

?>