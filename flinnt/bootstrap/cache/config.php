<?php return array (
  'app' => 
  array (
    'name' => 'Flinnt',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'timezone' => 'Asia/Kolkata',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:yC72IR2H6SvJCry31VPVkTtuIy7h07s1VjX7CaeqCAA=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Prettus\\Repository\\Providers\\RepositoryServiceProvider',
      27 => 'Collective\\Html\\HtmlServiceProvider',
      28 => 'Intervention\\Image\\ImageServiceProvider',
      29 => 'Way\\Generators\\GeneratorsServiceProvider',
      30 => 'Xethron\\MigrationsGenerator\\MigrationsGeneratorServiceProvider',
      31 => 'Gloudemans\\Shoppingcart\\ShoppingcartServiceProvider',
      32 => 'Softon\\Indipay\\IndipayServiceProvider',
      33 => 'Barryvdh\\DomPDF\\ServiceProvider',
      34 => 'OwenIt\\Auditing\\AuditingServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Cart' => 'Gloudemans\\Shoppingcart\\Facades\\Cart',
      'Indipay' => 'Softon\\Indipay\\Facades\\Indipay',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
  ),
  'audit' => 
  array (
    'implementation' => 'OwenIt\\Auditing\\Models\\Audit',
    'user' => 
    array (
      'morph_prefix' => 'user',
      'guards' => 
      array (
        0 => 'user',
        1 => 'admin',
        2 => 'vendor',
        3 => 'institution',
        4 => 'web',
        5 => 'api',
      ),
    ),
    'resolver' => 
    array (
      'user' => 'OwenIt\\Auditing\\Resolvers\\UserResolver',
      'ip_address' => 'OwenIt\\Auditing\\Resolvers\\IpAddressResolver',
      'user_agent' => 'OwenIt\\Auditing\\Resolvers\\UserAgentResolver',
      'url' => 'OwenIt\\Auditing\\Resolvers\\UrlResolver',
    ),
    'events' => 
    array (
      0 => 'created',
      1 => 'updated',
      2 => 'deleted',
      3 => 'restored',
    ),
    'strict' => false,
    'timestamps' => false,
    'threshold' => 0,
    'driver' => 'database',
    'drivers' => 
    array (
      'database' => 
      array (
        'table' => 'audits',
        'connection' => NULL,
      ),
    ),
    'console' => false,
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'vendor',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'vendors',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'vendors',
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'admins',
      ),
      'vendor' => 
      array (
        'driver' => 'session',
        'provider' => 'vendors',
      ),
      'institution' => 
      array (
        'driver' => 'session',
        'provider' => 'institutions',
      ),
      'user' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'admins' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Entities\\Admin',
        'table' => 'admin',
      ),
      'vendors' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Entities\\Vendor',
        'table' => 'vendor',
      ),
      'institutions' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Entities\\Institution',
        'table' => 'institution',
      ),
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Entities\\User',
        'table' => 'user',
      ),
    ),
    'passwords' => 
    array (
      'admins' => 
      array (
        'provider' => 'admins',
        'table' => 'password_resets',
        'expire' => 60,
      ),
      'vendors' => 
      array (
        'provider' => 'vendors',
        'table' => 'password_resets',
        'expire' => 60,
      ),
      'institutions' => 
      array (
        'provider' => 'institutions',
        'table' => 'password_resets',
        'expire' => 60,
      ),
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\xampp\\htdocs\\flinnt\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
    ),
    'prefix' => 'flinnt_cache',
  ),
  'cart' => 
  array (
    'tax' => 0,
    'database' => 
    array (
      'connection' => NULL,
      'table' => 'shoppingcart',
    ),
    'destroy_on_logout' => false,
    'format' => 
    array (
      'decimals' => 2,
      'decimal_point' => '.',
      'thousand_seperator' => '',
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'flint',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'flint',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => 'str_',
        'strict' => false,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'flint',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'flint',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\flinnt\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\flinnt\\storage\\app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'indipay' => 
  array (
    'gateway' => 'CCAvenue',
    'testMode' => true,
    'ccavenue' => 
    array (
      'merchantId' => '6645',
      'accessCode' => 'AVIA02GA51CN72AINC',
      'workingKey' => '0DE3631856F0A7A211E4E26B1CA3E776',
      'redirectUrl' => 'order/checkout/response',
      'cancelUrl' => 'order/checkout/response',
      'currency' => 'INR',
      'language' => 'EN',
    ),
    'payumoney' => 
    array (
      'merchantKey' => '',
      'salt' => '',
      'workingKey' => '',
      'successUrl' => 'indipay/response',
      'failureUrl' => 'indipay/response',
    ),
    'ebs' => 
    array (
      'account_id' => '',
      'secretKey' => '',
      'return_url' => 'indipay/response',
    ),
    'citrus' => 
    array (
      'vanityUrl' => '',
      'secretKey' => '',
      'returnUrl' => 'indipay/response',
      'notifyUrl' => 'indipay/response',
    ),
    'instamojo' => 
    array (
      'api_key' => '',
      'auth_token' => '',
      'redirectUrl' => 'indipay/response',
    ),
    'mocker' => 
    array (
      'service' => 'default',
      'redirect_url' => 'indipay/response',
    ),
    'remove_csrf_check' => 
    array (
      0 => 'order/checkout/response',
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
          1 => 'daily',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\xampp\\htdocs\\flinnt\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\xampp\\htdocs\\flinnt\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 7,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'loginfo' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\xampp\\htdocs\\flinnt\\storage\\logs/loginfo.log',
        'level' => 'debug',
        'days' => 7,
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => NULL,
    'username' => NULL,
    'password' => NULL,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\xampp\\htdocs\\flinnt\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'repository' => 
  array (
    'pagination' => 
    array (
      'limit' => 15,
    ),
    'fractal' => 
    array (
      'params' => 
      array (
        'include' => 'include',
      ),
      'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
    ),
    'cache' => 
    array (
      'enabled' => false,
      'minutes' => 30,
      'repository' => 'cache',
      'clean' => 
      array (
        'enabled' => true,
        'on' => 
        array (
          'create' => true,
          'update' => true,
          'delete' => true,
        ),
      ),
      'params' => 
      array (
        'skipCache' => 'skipCache',
      ),
      'allowed' => 
      array (
        'only' => NULL,
        'except' => NULL,
      ),
    ),
    'criteria' => 
    array (
      'acceptedConditions' => 
      array (
        0 => '=',
        1 => 'like',
      ),
      'params' => 
      array (
        'search' => 'search',
        'searchFields' => 'searchFields',
        'filter' => 'filter',
        'orderBy' => 'orderBy',
        'sortedBy' => 'sortedBy',
        'with' => 'with',
        'searchJoin' => 'searchJoin',
      ),
    ),
    'generator' => 
    array (
      'basePath' => 'C:\\xampp\\htdocs\\flinnt\\app',
      'rootNamespace' => 'App\\',
      'stubsOverridePath' => 'C:\\xampp\\htdocs\\flinnt\\app',
      'paths' => 
      array (
        'models' => 'Entities',
        'repositories' => 'Repositories',
        'interfaces' => 'Repositories',
        'transformers' => 'Transformers',
        'presenters' => 'Presenters',
        'validators' => 'Validators',
        'controllers' => 'Http/Controllers',
        'provider' => 'RepositoryServiceProvider',
        'criteria' => 'Criteria',
      ),
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\xampp\\htdocs\\flinnt\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'flinnt_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'settings' => 
  array (
    'ORIGINAL_CATEGORY_IMG_PATH' => 'images/category/original/',
    'THUMBNAIL_CATEGORY_IMG_PATH' => 'images/category/thumbnail/',
    'ORIGINAL_PRODUCT_IMG_PATH' => 'images/product/original/',
    'THUMBNAIL_PRODUCT_IMG_PATH' => 'images/product/thumbnail/',
    'ORIGINAL_INSTITUTION_IMG_PATH' => 'images/institution/original/',
    'THUMBNAIL_INSTITUTION_IMG_PATH' => 'images/institution/thumbnail/',
    'ORIGINAL_BOOKSET_IMG_PATH' => 'images/bookset/original/',
    'THUMBNAIL_BOOKSET_IMG_PATH' => 'images/bookset/thumbnail/',
    'PREFFERED_YES' => 1,
    'PREFFERED_NO' => 0,
    'PRIMARY_IMAGE_YES' => 1,
    'PRIMARY_IMAGE_NO' => 0,
    'ACADEMIC_YES' => 1,
    'ACADEMIC_NO' => 0,
    'STATUS_ACTIVE' => 1,
    'STATUS_IN_ACTIVE' => 2,
    'ACTIVE' => 1,
    'IN_ACTIVE' => 0,
    'PER_PAGE' => 10,
    'API_URL' => 'https://api.flinnt.com/mobile/v2.0/android/account/login/',
    'DEFAULT_USER' => '7107',
    'PRODUCT_DEFAULT_IMAGE' => 'default-image.png',
    'BOOKSET_DEFAULT_IMAGE' => 'default-image.png',
    'APP_URL' => 'https://www.flinnt.net/app/login/',
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\xampp\\htdocs\\flinnt\\resources\\views',
    ),
    'compiled' => 'C:\\xampp\\htdocs\\flinnt\\storage\\framework\\views',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => 'C:\\xampp\\htdocs\\flinnt\\storage\\fonts/',
      'font_cache' => 'C:\\xampp\\htdocs\\flinnt\\storage\\fonts/',
      'temp_dir' => 'C:\\Users\\ADMSYS~1\\AppData\\Local\\Temp',
      'chroot' => 'C:\\xampp\\htdocs\\flinnt',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'generators' => 
  array (
    'config' => 
    array (
      'model_template_path' => 'C:\\xampp\\htdocs\\flinnt\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/model.txt',
      'scaffold_model_template_path' => 'C:\\xampp\\htdocs\\flinnt\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/scaffolding/model.txt',
      'controller_template_path' => 'C:\\xampp\\htdocs\\flinnt\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/controller.txt',
      'scaffold_controller_template_path' => 'C:\\xampp\\htdocs\\flinnt\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/scaffolding/controller.txt',
      'migration_template_path' => 'C:\\xampp\\htdocs\\flinnt\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/migration.txt',
      'seed_template_path' => 'C:\\xampp\\htdocs\\flinnt\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/seed.txt',
      'view_template_path' => 'C:\\xampp\\htdocs\\flinnt\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/view.txt',
      'model_target_path' => 'C:\\xampp\\htdocs\\flinnt\\app',
      'controller_target_path' => 'C:\\xampp\\htdocs\\flinnt\\app\\Http/Controllers',
      'migration_target_path' => 'C:\\xampp\\htdocs\\flinnt\\database/migrations',
      'seed_target_path' => 'C:\\xampp\\htdocs\\flinnt\\database/seeds',
      'view_target_path' => 'C:\\xampp\\htdocs\\flinnt\\resources/views',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
    ),
  ),
);
