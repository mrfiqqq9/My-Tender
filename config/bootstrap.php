<?php
declare(strict_types=1);

/*
 * Paths
 */
require __DIR__ . DIRECTORY_SEPARATOR . 'paths.php';

/*
 * Bootstrap CakePHP core
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorTrap;
use Cake\Error\ExceptionTrap;
use Cake\Http\ServerRequest;
use Cake\Log\Log;
use Cake\Mailer\TransportFactory;
use Cake\Routing\Router;
use Cake\Utility\Security;
use function Cake\Core\env;

/*
 * Global helper functions
 */
require CAKE . 'functions.php';

/*
 * Load application config
 */
try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

/*
 * Load local config (optional)
 */
if (file_exists(CONFIG . 'app_local.php')) {
    Configure::load('app_local', 'default');
}

/*
 * Short cache duration when debug = true
 */
if (Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+2 minutes');
}

/*
 * Timezone & encoding
 */
date_default_timezone_set(Configure::read('App.defaultTimezone', 'UTC'));
mb_internal_encoding(Configure::read('App.encoding', 'UTF-8'));
ini_set('intl.default_locale', Configure::read('App.defaultLocale', 'en_US'));


/*
 * CLI adjustments
 */
if (PHP_SAPI === 'cli') {
    if (Configure::check('Log.debug')) {
        Configure::write('Log.debug.file', 'cli-debug');
    }
    if (Configure::check('Log.error')) {
        Configure::write('Log.error.file', 'cli-error');
    }
}

/*
 * Full base URL auto-detect
 */
$fullBaseUrl = Configure::read('App.fullBaseUrl');
if (!$fullBaseUrl && env('HTTP_HOST')) {
    $scheme = env('HTTPS') ? 'https' : 'http';
    $fullBaseUrl = $scheme . '://' . env('HTTP_HOST');
}
if ($fullBaseUrl) {
    Router::fullBaseUrl($fullBaseUrl);
}

/*
 * Apply configs (CakePHP 5 STYLE)
 */
Cache::setConfig(Configure::consume('Cache'));
ConnectionManager::setConfig(Configure::consume('Datasources'));
TransportFactory::setConfig(Configure::consume('EmailTransport'));
Log::setConfig(Configure::consume('Log'));
Security::setSalt(Configure::consume('Security.salt'));

/*
 * Mobile / Tablet detectors (optional)
 */
ServerRequest::addDetector('mobile', function ($request) {
    $detector = new \Detection\MobileDetect();
    return $detector->isMobile();
});

ServerRequest::addDetector('tablet', function ($request) {
    $detector = new \Detection\MobileDetect();
    return $detector->isTablet();
});
