<?php

return [
    'micro' => [
        'ceiling'              => 83600, // plafond du régime micro (services / libéral)
        'vat_threshold'        => 37500, // franchise en base de TVA
        'vat_threshold_raised' => 41250, // seuil majoré
        'activity_start'       => '2026-05-06',  // 'AAAA-MM-JJ' : proratise le plafond la 1re année
    ],

    // 'monthly' ou 'quarterly'
    'declaration' => 'monthly',
];
