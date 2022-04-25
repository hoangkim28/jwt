<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
class Payment2Controller extends Controller
{
    //Post vpc_OrderInfo , vpc_Amount
    public function create()
    {
        $response = \OnePayDomestic::purchase([
            'AgainLink' => 'https://mtf.onepay.vn/onecomm-pay/vpc.op',
            'vpc_MerchTxnRef' => microtime(false),
            'vpc_ReturnURL' => 'https://jwt.test/api/complete-purchase',
            'vpc_TicketNo' => '127.0.0.1',
            'vpc_Amount' => $_POST["vpc_Amount"],
            'vpc_OrderInfo' => $_POST["vpc_OrderInfo"],
            'vpc_Locale' => 'vn'
        ])->send();

        if ($response->isRedirect()) {
            $redirectUrl = $response->getRedirectUrl();
            echo $redirectUrl;
        }

    }
    //?vpc_AdditionData=970425&vpc_Amount=100&vpc_Command=pay&vpc_CurrencyCode=VND&vpc_Locale=vn&vpc_MerchTxnRef=202204231612021202937556&vpc_Merchant=ONEPAY&vpc_OrderInfo=JSECURETEST01&vpc_TransactionNo=2031219&vpc_TxnResponseCode=0&vpc_Version=2&vpc_SecureHash=CD3289309E821761A489E21A833F1556470066DDE0354B4F1119AB960BB45729
    public function respone()
    {
        $gateway = Omnipay::create('OnePay_Domestic');
        $gateway->initialize([
            'vpc_Merchant' => 'ONEPAY',
            'vpc_AccessCode' => 'D67342C2',
            'vpc_HashKey' => 'A3EFDFABA8653DF2342E8DAC29B51AF0',
        ]);
        $response = $gateway->completePurchase()->send();

        if ($response->isSuccessful()) {
            // TODO: xử lý kết quả và hiển thị.
            print $response->vpc_Amount;
            print $response->vpc_MerchTxnRef;
            
            print $response->getData(); // toàn bộ data do OnePay gửi sang.
            
        } else {

            print $response->getMessage();
        }
    }

    function getResponseDescription($responseCode) {
	
        switch ($responseCode) {
            case "0" :
                $result = "Giao dịch thành công - Approved";
                break;
            case "1" :
                $result = "Ngân hàng từ chối giao dịch - Bank Declined";
                break;
            case "3" :
                $result = "Mã đơn vị không tồn tại - Merchant not exist";
                break;
            case "4" :
                $result = "Không đúng access code - Invalid access code";
                break;
            case "5" :
                $result = "Số tiền không hợp lệ - Invalid amount";
                break;
            case "6" :
                $result = "Mã tiền tệ không tồn tại - Invalid currency code";
                break;
            case "7" :
                $result = "Lỗi không xác định - Unspecified Failure ";
                break;
            case "8" :
                $result = "Số thẻ không đúng - Invalid card Number";
                break;
            case "9" :
                $result = "Tên chủ thẻ không đúng - Invalid card name";
                break;
            case "10" :
                $result = "Thẻ hết hạn/Thẻ bị khóa - Expired Card";
                break;
            case "11" :
                $result = "Thẻ chưa đăng ký sử dụng dịch vụ - Card Not Registed Service(internet banking)";
                break;
            case "12" :
                $result = "Ngày phát hành/Hết hạn không đúng - Invalid card date";
                break;
            case "13" :
                $result = "Vượt quá hạn mức thanh toán - Exist Amount";
                break;
            case "21" :
                $result = "Số tiền không đủ để thanh toán - Insufficient fund";
                break;
            case "99" :
                $result = "Người sủ dụng hủy giao dịch - User cancel";
                break;
            default :
                $result = "Giao dịch thất bại - Failured";
        }
        return $result;
    }
}
