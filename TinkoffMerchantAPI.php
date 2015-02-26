<?php
//spl_autoload('Debug');


/**
 * Class TinkoffMerchantAPI
 *
 * @author Shuyskiy Sergey s.shuyskiy@tinkoff.ru
 * @version 1.00
 * @property bool orderId
 * @property bool Count
 */
class TinkoffMerchantAPI
{
    private $api_url;
    private $terminalKey;
    private $secretKey;
    private $paymentId;
    private $status;
    private $error;
    private $response;
    private $paymentUrl;

    /**
     * @param $terminalKey string Your Terminal name
     * @param $secretKey string Secret key for terminal
     * @param string $api_url Url for API
     */
    function __construct($terminalKey, $secretKey, $api_url)
    {
        $this->api_url = $api_url;
        $this->terminalKey = $terminalKey;
        $this->secretKey = $secretKey;
    }

    function __get($name)
    {
        switch ($name) {
            case 'paymentId':
                return $this->paymentId;
            case 'status':
                return $this->status;
            case 'error':
                return $this->error;
            case 'paymentUrl':
                return $this->paymentUrl;
            case 'response':
                return htmlentities($this->response);
            default:
                if ($this->response) {
                    if ($json = json_decode($this->response, true)) {
                        foreach ($json as $key => $value) {
                            if (strtolower($name) == strtolower($key)) {
                                return $json[ $key ];
                            }
                        }
                    }
                }

                return false;
        }
    }

    /**
     * @param $args mixed You could use associative array or url params string
     * @return bool
     * @throws HttpException
     */
    public function init($args)
    {
        return $this->buildQuery('Init', $args);
    }

    public function getState($args)
    {
        return $this->buildQuery('GetState', $args);
    }

    public function confirm($args)
    {
        return $this->buildQuery('Confirm', $args);
    }

    public function charge($args)
    {
        return $this->buildQuery('Charge', $args);
    }

    /**
     * Deprecated method
     * @param $args
     * @return mixed
     */
    public function addCustomer($args)
    {
        return $this->buildQuery('AddCustomer', $args);
    }

    public function getCustomer($args)
    {
        return $this->buildQuery('GetCustomer', $args);
    }

    public function removeCustomer($args)
    {
        return $this->buildQuery('RemoveCustomer', $args);
    }

    public function getCardList($args)
    {
        return $this->buildQuery('GetCardList', $args);
    }

    public function removeCard($args)
    {
        return $this->buildQuery('RemoveCard', $args);
    }

    public function resend()
    {
        return $this->buildQuery('Resend', array());
    }

    public function buildQuery($path, $args)
    {
        $url = $this->api_url;
        if (is_array($args)) {
            if ( ! array_key_exists('TerminalKey', $args)) $args['TerminalKey'] = $this->terminalKey;
            if ( ! array_key_exists('Token', $args)) $args['Token'] = $this->_genToken($args);
        }
        $url = $this->_combineUrl($url, $path);


        return $this->_sendRequest($url, $args);
    }

    private function _genToken($args)
    {
        $token = '';
        $args['Password'] = $this->secretKey;
        ksort($args);
        foreach ($args as $arg) {
            $token .= $arg;
        }
        $token = hash('sha256', $token);

        return $token;
    }

    private function _combineUrl()
    {
        $args = func_get_args();
        $url = '';
        foreach ($args as $arg) {
            if (is_string($arg)) {
                if ($arg[ strlen($arg) - 1 ] !== '/') $arg .= '/';
                $url .= $arg;
            } else {
                continue;
            }
        }

        return $url;
//        Debug::trace(func_get_args());
    }

    private function _sendRequest($api_url, $args)
    {
        $this->error = '';
//        Debug::trace($args);
        //$proxy = 'http://192.168.5.22:8080';
        //$proxyAuth = '';
        if (is_array($args)) $args = http_build_query($args);
        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, $api_url);
//          curl_setopt($curl, CURLOPT_PROXY, $proxy);
//          curl_setopt($curl, CURLOPT_PROXYUSERPWD, $proxyAuth);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $args);
            $out = curl_exec($curl);

            $this->response = $out;
            $json = json_decode($out);
//            Debug::trace($out);
//            Debug::trace($json->Success, true);
            if ($json) {
                if (@$json->ErrorCode !== "0") {
                    $this->error = @$json->Details;
                } else {
                    $this->paymentUrl = @$json->PaymentURL;
                    $this->paymentId = @$json->PaymentId;
                    $this->status = @$json->Status;
                }
            }

            curl_close($curl);

            return $out;

        } else {
            throw new HttpException('Can not create connection to ' . $api_url . ' with args ' . $args, 404);
        }
    }
}