<?php

return [
    'micro' => [
        'ceiling'              => 83600, // plafond annuel standard (services / libéral)
        'ceiling_by_year'      => [
            2026 => 54970, // plafond proratisé de la première année
        ],
        'vat_threshold'        => 37500,
        'vat_threshold_raised' => 41250,
    ],

    // 'monthly' ou 'quarterly'
    'declaration' => 'monthly',
];
