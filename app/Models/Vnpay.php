<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vnpay extends Model
{
    use HasFactory;

    // Khai báo các thuộc tính của lớp
    private $vnp_Returnurl;
    private $vnp_apiUrl;
    private $vnp_Url;
    private $apiUrl;
    private $startTime;
    private $expire;
    private $vnp_hashSecret;
    private $vnp_TmnCode;
    private $vnp_IpAddr;
    private $vnp_TxnRef;
    private $vnp_RequestId;

    public function __construct() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->vnp_Returnurl = env("VNP_RETURN_URL");
        $this->vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $this->vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $this->apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $this->startTime = date("YmdHis");
        $this->expire = date('YmdHis',strtotime('+15 minutes',strtotime($this->startTime)));
        $this->vnp_hashSecret = env("VNP_HASH_SECRET");
        $this->vnp_TmnCode = env("VNP_TMN_CODE");
        $this->vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $this->vnp_TxnRef = rand(1,10000);
        $this->vnp_RequestId = rand(1,10000);
    }

    function callAPI_auth($method, $url, $data)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }

    public function create_payment($vnp_Amount, $vnp_Locale) {
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 1000,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $this->vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD tai: $this->vnp_TxnRef",
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $this->vnp_Returnurl,
            "vnp_TxnRef" => $this->vnp_TxnRef,
            "vnp_ExpireDate" => $this->expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp_Url . "?" . $query;
        if (isset($this->vnp_hashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $this->vnp_hashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();

    }
    public function create_payment_url($vnp_Amount, $vnp_Locale,$return_url){
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 1000,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $this->vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD tai: $this->vnp_TxnRef",
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $return_url,
            "vnp_TxnRef" => $this->vnp_TxnRef,
            "vnp_ExpireDate" => $this->expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp_Url . "?" . $query;
        if (isset($this->vnp_hashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $this->vnp_hashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();

    }

    public function create_link_payment_url($vnp_Amount, $vnp_Locale,$return_url){
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 1000,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $this->vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD tai: $this->vnp_TxnRef",
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $return_url,
            "vnp_TxnRef" => $this->vnp_TxnRef,
            "vnp_ExpireDate" => $this->expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp_Url . "?" . $query;
        if (isset($this->vnp_hashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $this->vnp_hashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;

    }


    public function ipn_payment (){

    }

    public function search_payment ($txnRef,$transactionDate){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);
        $datarq = array(
            "vnp_RequestId" => $this->vnp_RequestId,
            "vnp_Version" => "2.1.0",
            "vnp_Command" => "querydr",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_TxnRef" => $txnRef,
            "vnp_OrderInfo" => "Query transaction",
            //$vnp_TransactionNo= ;
            "vnp_TransactionDate" => $transactionDate,
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_IpAddr" => $this->vnp_IpAddr
        );
        $format = '%s|%s|%s|%s|%s|%s|%s|%s|%s';


        $dataHash = sprintf(
            $format,
            $datarq['vnp_RequestId'], //1
            $datarq['vnp_Version'], //2
            $datarq['vnp_Command'], //3
            $datarq['vnp_TmnCode'], //4
            $datarq['vnp_TxnRef'], //5
            $datarq['vnp_TransactionDate'], //6
            $datarq['vnp_CreateDate'], //7
            $datarq['vnp_IpAddr'], //8
            $datarq['vnp_OrderInfo']//9
        );

        $checksum = hash_hmac('SHA512', $dataHash, $this->vnp_HashSecret);
        $datarq["vnp_SecureHash"] = $checksum;
        $txnData = $this->callAPI_auth("POST", $this->apiUrl, json_encode($datarq));
        $ispTxn = json_decode($txnData, true);
        return $txnData;

    }

    public function refrund($txnRef,$transactionDate,$CreateBy,$TransactionType,$Amount){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);
        $format = '%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s';
        $ispTxnRequest = array(
            "vnp_RequestId" => $this->vnp_RequestId,
            "vnp_Version" => "2.1.0",
            "vnp_Command" => "refund",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_TransactionType" => $TransactionType,
            "vnp_TxnRef" => $txnRef,
            "vnp_Amount" => $Amount,
            "vnp_OrderInfo" => "Hoan Tien Giao Dich",
            "vnp_TransactionNo" => $this->vnp_TxnRef,
            "vnp_TransactionDate" => $transactionDate,
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CreateBy" => $CreateBy,
            "vnp_IpAddr" => $this->vnp_IpAddr
        );
        $dataHash = sprintf(
            $format,
            $ispTxnRequest['vnp_RequestId'], //1
            $ispTxnRequest['vnp_Version'], //2
            $ispTxnRequest['vnp_Command'], //3
            $ispTxnRequest['vnp_TmnCode'], //4
            $ispTxnRequest['vnp_TransactionType'], //5
            $ispTxnRequest['vnp_TxnRef'], //6
            $ispTxnRequest['vnp_Amount'], //7
            $ispTxnRequest['vnp_TransactionNo'],  //8
            $ispTxnRequest['vnp_TransactionDate'], //9
            $ispTxnRequest['vnp_CreateBy'], //10
            $ispTxnRequest['vnp_CreateDate'], //11
            $ispTxnRequest['vnp_IpAddr'], //12
            $ispTxnRequest['vnp_OrderInfo'] //13
        );

        $checksum = hash_hmac('SHA512', $dataHash, $this->vnp_HashSecret);
        $ispTxnRequest["vnp_SecureHash"] = $checksum;
        $txnData = $this->callAPI_auth("POST", $this->apiUrl, json_encode($ispTxnRequest));
        $ispTxn = json_decode($txnData, true);
        return $txnData;


    }
}
