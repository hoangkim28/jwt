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
    public function complete_purchase(Request $request)
    {
        $completePurchaseResponse = $request->attributes->get('completePurchaseResponse');

        if ($completePurchaseResponse->isSuccessful()) {
            // xử lý logic thanh toán thành công.
            return response()->json([
                'status' => '0',
                'message' => 'Thanh toán thành công!',
            ]);
        } elseif ($completePurchaseResponse->isCancelled()) {
            // khi khách hủy giao dịch.
            return response()->json([
                'status' => '1',
                'message' => 'Khách hàng huỷ giao dịch!',
            ]);
        } else {
            // các trường hợp khác
            return response()->json([
                'status' => '1',
                'message' => 'Lỗi!',
            ]);
        }
    }
}
