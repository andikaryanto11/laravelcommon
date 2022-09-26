<?php

namespace LaravelCommon\App\Services;

use Rollbar\Payload\Level;
use Rollbar\Rollbar;

class RollbarLoggerService
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $accessToken = '';

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $appEnv = env('APP_ENV');
        $this->accessToken = config('common-config')['env'][env('APP_ENV')]['rollbar_access_token'];
        Rollbar::init(
            [
                'access_token' => $this->accessToken,
                'environtment' => $appEnv
            ]
        );
    }

    /**
     * Has rollbar setup
     *
     * @return boolean
     */
    public function isSetup(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Log emergency message
     *
     * @param string $message
     * @return void
     */
    public function emergency(string $message, array $trace = []): void
    {
        $this->log(Level::EMERGENCY, $message, $trace);
    }

    /**
     * Log alert message
     *
     * @param string $message
     * @return void
     */
    public function alert(string $message, array $trace = []): void
    {
        $this->log(Level::ALERT, $message, $trace);
    }

    /**
     * Log critical message
     *
     * @param string $message
     * @return void
     */
    public function critical(string $message, array $trace = []): void
    {
        $this->log(Level::CRITICAL, $message, $trace);
    }

    /**
     * Log error message
     *
     * @param string $message
     * @return void
     */
    public function error(string $message, array $trace = []): void
    {
        $this->log(Level::ERROR, $message, $trace);
    }

    /**
     * Log warning message
     *
     * @param string $message
     * @return void
     */
    public function warning(string $message, array $trace = []): void
    {
        $this->log(Level::WARNING, $message, $trace);
    }

    /**
     * Log notice message
     *
     * @param string $message
     * @return void
     */
    public function notice(string $message, array $trace = []): void
    {
        $this->log(Level::NOTICE, $message, $trace);
    }

    /**
     * Log info message
     *
     * @param string $message
     * @return void
     */
    public function info(string $message, array $trace = []): void
    {
        $this->log(Level::INFO, $message, $trace);
    }

    /**
     * Log debug message
     *
     * @param string $message
     * @return void
     */
    public function debug(string $message, array $trace = []): void
    {
        $this->log(Level::DEBUG, $message, $trace);
    }

    /**
     * Do log to rollbar
     *
     * @param string $level
     * @param string $message
     * @return void
     */
    private function log(string $level, string $message, array $trace = []): void
    {
        Rollbar::log($level, $message, $trace);
    }
}
