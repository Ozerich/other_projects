<?

class Downloader
{
    private $curl;
    protected $user_agent = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17";


    public function __construct()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 10);
    }


    private function do_download($url, $ajax)
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


    public function __destruct()
    {
        curl_close($this->curl);
    }


}



?>