<?php

/**
 * @brief CustomElement, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

namespace Dotclear\Plugin\CustomElement;

use Dotclear\App;
use Dotclear\Core\Upgrade\Update;
use Exception;

class FrontendRest
{
    protected static ?Update $updater = null;

    /**
     * Get Last info about stable release
     */
    protected static function getReleaseStableInfo(): ?Update
    {
        if (self::$updater instanceof Update) {
            return self::$updater;
        }

        $channel = 'stable';
        $updater = new Update(
            App::config()->coreUpdateUrl(),
            'dotclear',
            $channel,
            App::config()->cacheRoot() . DIRECTORY_SEPARATOR . Update::CACHE_FOLDER
        );

        try {
            // Get information
            $updater->getVersionInfo();

            // Save updater instance for further calls if any
            self::$updater = $updater;

            return $updater;
        } catch (Exception) {
        }

        return null;
    }

    /**
     * REST method to get stable release version.
     *
     * @return     array{ret:bool, text?:string}   The payload.
     */
    public static function getReleaseStableVersion(): array
    {
        $updater = self::getReleaseStableInfo();
        if ($updater instanceof Update) {
            $last = $updater->getVersion();
            if (is_string($last)) {
                return [
                    'ret'  => true,
                    'text' => $last,
                ];
            }
        }

        return [
            'ret' => false,
        ];
    }

    /**
     * REST method to get stable last release PHP minimum version.
     *
     * @return     array{ret:bool, text?:string}   The payload.
     */
    public static function getReleaseStablePhpMin(): array
    {
        $updater = self::getReleaseStableInfo();
        if ($updater instanceof Update) {
            $php = $updater->getPHPVersion();
            if (is_string($php)) {
                return [
                    'ret'  => true,
                    'text' => $php,
                ];
            }
        }

        return [
            'ret' => false,
        ];
    }

    /**
     * REST method to get next required PHP minimum version.
     *
     * @return     array{ret:bool, text:string}   The payload.
     */
    public static function getNextRequiredPhp(): array
    {
        return [
            'ret'  => true,
            'text' => App::config()->nextRequiredPhp(),
        ];
    }
}
