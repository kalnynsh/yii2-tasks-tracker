<?php
return [
    [
        'user_id' => 2,
        'token' => 'token-correct',
        'expired_at' => time() + 3600,
    ],
    [
        'user_id' => 11,
        'token' => 'token-expired',
        'expired_at' => time() - 3600,
    ],
];
