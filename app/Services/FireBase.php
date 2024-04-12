<?php

namespace App\Services;

class FireBase
{
    public static function sendPush(string $token, string $message, string $title, string $icon = '', string $image = ''): mixed
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $YOUR_API_KEY = 'AAAAdD8M9Qw:APA91bGGae8ceFXzpBvH-RaItAHo0qcogeJ1C4VhcbbkIny6v38NGL1TQ_fHCtRoV_hUrtGYFMq4oOOduGNmdFnqL7s3v5Jy4dayblDlB8ENuwwjO6VSgEAxACj2eI_V2CoZW2xzgypB'; // Server key
        $YOUR_TOKEN_ID = $token;

        $request_body = [
            'to' => $YOUR_TOKEN_ID,
            'notification' => [
                'title' => $title,
                'body' => $message,
                'click_action' => 'http://ya.ru',
            ],
        ];
        $request_body['notification']['image'] = ($image !== '') ? $image : null;
        $request_body['notification']['icon'] = ($icon !== '') ? $icon : '/clock.png';
        $request_body['notification']['data'] = 'some payload';
        $fields = json_encode($request_body);

        $request_headers = [
            'Content-Type: application/json',
            'Authorization: key=' . $YOUR_API_KEY,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = json_decode(curl_exec($ch));
        if (!$response) throw new \Exception('Curl error: ' . curl_error($ch));
        if (!$response->success) throw new \Exception('Не удалось отправить сообщение');
        curl_close($ch);
        return json_decode($response->success);
    }
}
