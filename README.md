  
###Либа для сокетов Ratchet
http://socketo.me/docs/install

    php ~/composer.phar require cboden/ratchet
    or
    composer require cboden/ratchet

Создание команды для запуска сервера

    php artisan make:command WebSockets

    app/Console/Commands/WebSockets.php
    
    php artisan websocket:run

Для простоты юзаю браузерное расширение
Simple WebSocket Client

    
    
Что бы узнать свой локальный адрес
    
    ipconfig
    IPv4-адрес. . .. . : 192.168.0.101

Подключение к сокетам через js

    https://learn.javascript.ru/websocket

Websocket Client

    https://github.com/Textalk/websocket-php
    composer require textalk/websocket

Для работы на сервере нужно поменять протокол WS на WSS

Так же надо будет добавить пару модулей, если не добавить сокет будет бесконечно грузиться и вылетит

Команды для прокси apache2:
    a2enmod proxy
    a2enmod proxy_http
    a2enmod proxy_wstunnel

В Апаче в конфиге сайта (mysite.conf) добавить 

    ProxyPass "/wss" "ws://тут ip адрес сайтеца:8080"
    ProxyPassReverse "/wss" "ws://тут ip адрес сайтеца:8080"

Ссылка на прокси nginx: 
 <a href='https://nginx.org/en/docs/http/websocket.html'>link</a>

На хосте понадобиться supervisor
    
    apt install supervisor

В etc/supervisor/config.d  нужно создать websocket.conf
    
    [program:websocket]
    autostart = true
    autorestart = true
    command = php /var/www/websocket/artisan websocket:run - путь к сайту
    startretries = 3

Дальше в терминале 

    supervisorctl reread
    
    supervisorctl update

После внесения изменений в сокет, надо перезапустить supervisor

    supervisorctl
    restart websocket

