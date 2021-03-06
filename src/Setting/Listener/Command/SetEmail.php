<?php namespace Anomaly\SettingsModule\Setting\Listener\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Support\Decorator;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class SetEmail
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\SettingsModule\Setting\Listener\Command
 */
class SetEmail implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param Repository                 $config
     * @param SettingRepositoryInterface $settings
     */
    function handle(Repository $config, SettingRepositoryInterface $settings)
    {
        // Set email driver.
        if ($driver = $settings->get('streams::mail_driver')) {
            $config->set('mail.driver', $driver->getValue());
        }

        // Set SMTP host.
        if ($host = $settings->get('streams::mail_host')) {
            $config->set('mail.host', $host->getValue());
        }

        // Set SMTP port.
        if ($port = $settings->get('streams::mail_port')) {
            $config->set('mail.port', $port->getValue());
        }

        // Set SMTP username.
        if ($username = $settings->get('streams::mail_username')) {
            $config->set('mail.username', $username->getValue());
        }

        // Set SMTP password.
        if ($password = $settings->get('streams::mail_password')) {
            $config->set('mail.password', $password->getValue());
        }

        // Set SMTP debug mode.
        if (($debug = $settings->get('streams::mail_debug'))) {
            $config->set('mail.pretend', $debug->getValue());
        }
    }
}
