# yii2-log-reader
PHP Yii2. This is simple module for log reading  from admin menu 

Installation
------------
```
php composer.phar require --prefer-dist alexdin/yii2-log-reader
```
or add

```json
"alexdin/yii2-log-reader":"^0.0.1"
```

Configure 
-----
Add into your admin config this module with params.
```php
    'modules' => [
       'log-reader'=>[
           'class'=>'common\components\LogReader\Module',
           'params'=>[
               'logs'=>[
                   '@backend',
                   '@frontend'
                   // or custom Alias to your applications or absolute path to log file.
               ]
           ]
       ],
    ],
 ```
 Usage
 -----

type in admin area 
```php
https://admin.your_domain/log-reader/read
```