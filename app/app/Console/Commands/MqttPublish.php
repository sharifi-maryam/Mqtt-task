<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttPublish extends Command
{
    protected $signature = 'mqtt:publish';
    protected $description = 'Publish current time to MQTT broker every second';

    public function handle()
    {
        $client = new MqttClient(
            env('MQTT_HOST'),
            (int) env('MQTT_PORT'),
            'publisher-' . uniqid()
        );

        $settings = (new ConnectionSettings)
            ->setUsername(env('MQTT_USERNAME'))
            ->setPassword(env('MQTT_PASSWORD'));

        $client->connect($settings);
        $this->info('Connected to broker. Publishing...');

        while (true) {
            $time = now()->format('Y/m/d H:i:s');
            $client->publish(env('MQTT_TOPIC'), $time, 0);
            $this->line($time);
            sleep(1);
        }
    }
}
