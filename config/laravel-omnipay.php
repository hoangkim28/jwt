<?php

return [
    // Cấu hình cho các cổng thanh toán tại hệ thống của bạn, các cổng không xài có thể xóa cho gọn hoặc không điền.
    // Các thông số trên có được khi bạn đăng ký tích hợp.

    'gateways' => [
        'MoMoAIO' => [
            'driver' => 'MoMo_AllInOne',
            'options' => [
                'accessKey' => '',
                'secretKey' => '',
                'partnerCode' => '',
                'testMode' => false,
            ],
        ],
        'MoMoQRCode' => [
            'driver' => 'MoMo_QRCode',
            'options' => [
                'accessKey' => '',
                'secretKey' => '',
                'partnerCode' => '',
                'testMode' => false,
            ],
        ],
        'MoMoAIA' => [
            'driver' => 'MoMo_AppInApp',
            'options' => [
                'accessKey' => '',
                'secretKey' => '',
                'partnerCode' => '',
                'publicKey' => '',
                'testMode' => false,
            ],
        ],
        'MoMoPOS' => [
            'driver' => 'MoMo_POS',
            'options' => [
                'accessKey' => '',
                'secretKey' => '',
                'partnerCode' => '',
                'publicKey' => '',
                'testMode' => false,
            ],
        ],
        'OnePayDomestic' => [
            'driver' => 'OnePay_Domestic',
            'options' => [
                'vpcMerchant' => 'ONEPAY',
                'vpcAccessCode' => 'D67342C2',
                'vpcUser' => '',
                'vpcPassword' => '',
                'vpcHashKey' => 'A3EFDFABA8653DF2342E8DAC29B51AF0',
                'testMode' => true,
            ],
        ],
        'OnePayInternational' => [
            'driver' => 'OnePay_International',
            'options' => [
                'vpcMerchant' => '',
                'vpcAccessCode' => '',
                'vpcUser' => '',
                'vpcPassword' => '',
                'vpcHashKey' => '',
                'testMode' => false,
            ],
        ],
        'VTCPay' => [
            'driver' => 'VTCPay',
            'options' => [
                'websiteId' => '',
                'securityCode' => '',
                'testMode' => false,
            ],
        ],
        'VNPay' => [
            'driver' => 'VNPay',
            'options' => [
                'vnpTmnCode' => '',
                'vnpHashSecret' => '',
                'testMode' => false,
            ],
        ],
    ],
];
