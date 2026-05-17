# MQTT Laravel Task

اتصال به MQTT Broker با Laravel و ارسال/دریافت زمان real-time.

## راه‌اندازی

```bash
docker build -t mqtt-app .
```

## اجرا

```bash
docker run --rm -it --network host --env-file .env mqtt-app php artisan mqtt:subscribe
```
```bash
docker run --rm -it --network host --env-file .env mqtt-app php artisan mqtt:publish
```

##  .env

```env
MQTT_HOST=
MQTT_PORT=
MQTT_USERNAME=
MQTT_PASSWORD=
MQTT_TOPIC=
```
