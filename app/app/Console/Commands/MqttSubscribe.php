<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe to MQTT topic and receive messages';

    public function handle()
    {
        $client = new MqttClient(
            env('MQTT_HOST'),
            (int) env('MQTT_PORT'),
            'subscriber-' . uniqid()
        );

        $settings = (new ConnectionSettings)
            ->setUsername(env('MQTT_USERNAME'))
            ->setPassword(env('MQTT_PASSWORD'));

        $client->connect($settings);
        $this->info('Connected. Waiting for messages...');

        $client->subscribe(env('MQTT_TOPIC'), function (string $topic, string $message) {
            $this->line("Received: $message");
        }, 0);

        $client->loop(true);
    }
}
