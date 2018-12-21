<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hadoken extends Model
{
    protected static function hadoken(string $src, int $pf): void
    {
        $json = json_encode([
            'detect' => [
                'sourceip' => $src,
                'serverip' => env('SERVER_IP'),
                'is_infect' => (string)$pf,
                'timestamp' => (string)time(),
            ],
        ]);
        $url = env('HADOKEN_URL');
        $header = [
            "Content-Type: application/json",
            "Content-Length: " . strlen($json),
        ];
        $context = [
            "http" => [
                "method" => "POST",
                "header" => implode("\r\n", $header),
                "content" => $json,
            ],
        ];
        file_get_contents($url, false, stream_context_create($context));
    }

    static function success(string $src)
    {
        self::hadoken($src, 1);
    }

    static function fail(string $src)
    {
        self::hadoken($src, 0);
    }
}
