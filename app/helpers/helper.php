<?php


if (!function_exists('billingCodes')) {
    function billingCodes()
    {
        return [
            'F001'      => ['description' => 'INSTALL FIBER SERVICE - TRIPLE PLAY - FTTP - INSTALL FIBER SERVICE-TELEPHONE, INTERNET AND VIDEO', 'rate' => 154.00],
            'F002'      => ['description' => 'INSTALL FIBER SERVICE- DOUBLE PLAY -TELEPHONE AND INTERNET', 'rate' => 110.00],
            'F003'      => ['description' => 'FTTP - INSTALL FIBER SERVICE-INTERNET & VIDEO', 'rate' => 119.00],
            'F004'      => ['description' => 'FTTP - INSTALL FIBER SERVICE-VIDEO ADD/RECONNECT', 'rate' => 70.00],
            'F005'      => ['description' => 'FTTP - INSTALL FIBER SERVICE- ADDITIONAL SET TOP BOXES', 'rate' => 16.00],
            'F006'      => ['description' => 'FTTP - INSTALL FIBER SERVICE- PLACE AERIAL DROP', 'rate' => 24.00],
            'F007'      => ['description' => 'FTTP - INSTALL FIBER SERVICE- ADDITIONAL SPLICE DROP', 'rate' => 34.00],
            'F008'      => ['description' => 'FTTP - FIBER TROUBLE TICKET', 'rate' => 55.00],
            'F009'      => ['description' => 'FTTP - FIBER TROUBLE TICKET- REFER TO MAINTENANCE', 'rate' => 35.00],
            'F010'      => ['description' => 'FTTP - FIBER TROUBLE FOLLOW-UP', 'rate' => 23.00],
            'F011'      => ['description' => 'FTTP - FIBER TRIP CHARGE', 'rate' => 24.00],
            'F012'      => ['description' => 'FTTP - FIBER INSTALLATION HR', 'rate' => 35.00],
            'F015'      => ['description' => 'FTTP - RECONNECT/ADD -FIBER SERVICE-TELEPHONE, INTERNET, VIDEO', 'rate' => 109.00],
            'F016'      => ['description' => 'FTTP - RECONNECT/ADD -FIBER SERVICE-TELEPHONE AND INTERNET', 'rate' => 75.00],
            'F017'      => ['description' => 'FTTP - RECONNECT/ADD -FIBER SERVICE-INTERNET AND VIDEO', 'rate' => 86.00],
            'F018'      => ['description' => 'FTTP - RETRIEVAL-FIBER SERVICE-VIDEO SET TOP BOX', 'rate' => 24.00],
            'F019'      => ['description' => 'FTTP - INSTALL FIBER SERVICE-TELEPHONE ONLY', 'rate' => 82.00],
            'F020'      => ['description' => 'FTTP - RECONNECT/ADD -FIBER SERVICE-TELEPHONE ONLY', 'rate' => 56.00],
            'F021'      => ['description' => 'FTTP - INSTALL FIBER SERVICE-VIDEO ONLY', 'rate' => 98.00],
            'F014-1'    => ['description' => 'FTTP - INSTALL FIBER SERVICE-INTERNET/DATA ONLY', 'rate' => 118.00],
            '2-F014-1'  => ['description' => 'FTTP - RECONNECT-FIBER SERVICE-INTERNET/DATA', 'rate' => 79.00],
            '2-F014-2'  => ['description' => 'FTTP - RECONNECT-FIBER SERVICE-INTERNET/DATA ADD', 'rate' => 45.00],
            'F014-4'    => ['description' => 'FTTP - SWAP/UPGRADE SET TOP BOX (STB) FOR FIBER SERVICE', 'rate' => 45.00],
            '1-F014-5'  => ['description' => 'FTTP - INSTALL FIBER SERVICE-FIRST ADDITIONAL JACK WITHOUT EXISTING WIRING', 'rate' => 37.00],
            '2-F014-5'  => ['description' => 'FTTP - INSTALL FIBER SERVICE-ADDITIONAL JACK WITHOUT EXISTING WIRING, WORK WITH BVS0-2', 'rate' => 19.00],
            'F014-6'    => ['description' => 'FTTP - INSTALL FIBER SERVICE-ADD/MOVE/REPLACE OPTICAL NETWORK TERMINAL (ONT)', 'rate' => 36.00],
            'F014-7'    => ['description' => 'FTTP - INSTALL FIBER SERVICE-REMOVE AERIAL DROP', 'rate' => 20.00],
            'F014-9'    => ['description' => 'FTTP - INSTALL FIBER SERVICE-TELEPHONE & VIDEO', 'rate' => 121.00],
            'F014-10'   => ['description' => 'FTTP - INSTALL FIBER SERVICE- PLACE UG DROP IN CONDUIT/SUBDUCT', 'rate' => 0.54],
            'F014-11'   => ['description' => 'FTTP - INSTALL FIBER SERVICE-PLACE VATS TERMINAL', 'rate' => 27.00],
            '1-F014-12' => ['description' => 'FTTP - RECONNECT-FIBER SERVICE-TELEPHONE AND VIDEO', 'rate' => 83.00],
            '2-F014-12' => ['description' => 'FTTP - RECONNECT-FIBER SERVICE-TELEPHONE AND VIDEO ADD', 'rate' => 79.00],
            'F014-15'   => ['description' => 'FTTP - INSTALL FIBER SERVICE-MOVE ROUTER', 'rate' => 28.00],
            'F014-16'   => ['description' => 'FTTP - INSTALL FIBER SERVICE-RECONFIGURE COMPUTER', 'rate' => 34.00],
            'F014-17'   => ['description' => 'REPLACE POWER SUPPLY (PS) & BATTERY BACK UP (BBU) ONLY', 'rate' => 34.00],
            'F031'      => ['description' => 'MDU DROP', 'rate' => 0.68],
            'PD'        => ['description' => 'PER DIEM', 'rate' => 130.00],
            'LUNCH'     => ['description' => 'N/A', 'rate' => 0.00],
        ];
    }
}


if (!function_exists('adminEmail')) {
    function adminEmail()
    {
        return 'aatifshehzad668@gmail.com';
    }
}

function WorkType()
{
    return [
        'Install Broadband + Service Line + All Connections'           => ['unit' => 'F100', 'w2' => 218.00],
        'Install Broadband + Temp Service Line + All Connections'     => ['unit' => 'F110', 'w2' => 152.00],
        'Install Broadband + Connections'                              => ['unit' => 'F120', 'w2' => 128.00],
        'Fiber Drop Placement'                                         => ['unit' => 'F600', 'w2' => 109.00],
        'Install Voice Only'                                           => ['unit' => 'F155', 'w2' => 74.00],
        "Drop Adder - Aerial 501' to 1000'"                            => ['unit' => 'F160', 'w2' => 58.00],
        "Drop Adder - Aerial 1001' to 1500'"                           => ['unit' => 'F170', 'w2' => 101.00],
        "Drop Adder - Aerial 1501' to 2000'"                           => ['unit' => 'F180', 'w2' => 144.00],
        "Drop Adder - Conduit Pull up to 200'"                         => ['unit' => 'F190', 'w2' => 58.00],
        "Drop Adder - Conduit Pull 201' to 1000'"                      => ['unit' => 'F200', 'w2' => 89.00],
        'Voice Adder'                                                  => ['unit' => 'F210', 'w2' => 27.00],
        'Trouble Unit Charge'                                          => ['unit' => 'F220 A', 'w2' => 109.00],
        'Trouble Unit Charge w/ Drop Replacement'                      => ['unit' => 'F220 B', 'w2' => 109.00],
        'Copper Trouble'                                               => ['unit' => 'F870', 'w2' => 156.00],
        'Training Time'                                                => ['unit' => 'F230', 'w2' => 17.00],
        'No Access/Trip Charge'                                        => ['unit' => 'F240', 'w2' => 35.00],
        'Per Diem - Zone 4'                                            => ['unit' => 'F280', 'w2' => 160.00],
        'Per Diem'                                                     => ['unit' => 'F290', 'w2' => 100.00],
        'Saturday, Sunday, Holiday Adder'                              => ['unit' => 'F310', 'w2' => 27.00],
        'Defect'                                                       => ['unit' => 'F400', 'w2' => 118.00],
        'Inventory Chargeback'                                         => ['unit' => 'F410', 'w2' => null],
        "Drop Adder - Aerial 501' to 1000' (Dup)"                      => ['unit' => 'F601', 'w2' => 58.00],
        "Drop Adder - Aerial 1001' to 1500' (Dup)"                     => ['unit' => 'F602', 'w2' => 101.00],
        "Drop Adder - Aerial 1501' to 2000' (Dup)"                     => ['unit' => 'F603', 'w2' => 144.00],
        "Drop Adder - Conduit Pull up to 200' (Dup)"                   => ['unit' => 'F604', 'w2' => 58.00],
        "Drop Adder - Conduit Pull 201' to 1000' (Dup)"                => ['unit' => 'F605', 'w2' => 89.00],
        'Triage Helper'                                                => ['unit' => 'F610', 'w2' => 55.00],
        'Lunch'                                                        => ['unit' => '0', 'w2' => 0.00],
    ];
}
