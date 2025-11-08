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

class FrontendRest
{
    /**
     * REST method to get stable release version.
     *
     * @return     array{ret:bool, text?:string}   The payload.
     */
    public static function getReleaseStableVersion(): array
    {
        $channel = 'stable';
        $updater = new Update(
            App::config()->coreUpdateUrl(),
            'dotclear',
            $channel,
            App::config()->cacheRoot() . DIRECTORY_SEPARATOR . Update::CACHE_FOLDER
        );
        $last = $updater->check('0.0');
        if (is_string($last)) {
            return [
                'ret'  => true,
                'text' => $last,
            ];
        }

        return [
            'ret' => false,
        ];
    }

    /**
     * REST method to get stable release PHP minimum version.
     *
     * @return     array{ret:bool, text?:string}   The payload.
     */
    public static function getReleaseStablePhpMin(): array
    {
        $channel = 'stable';
        $updater = new Update(
            App::config()->coreUpdateUrl(),
            'dotclear',
            $channel,
            App::config()->cacheRoot() . DIRECTORY_SEPARATOR . Update::CACHE_FOLDER
        );
        $updater->getVersionInfo();
        $php = $updater->getPHPVersion();
        if (is_string($php)) {
            return [
                'ret'  => true,
                'text' => $php,
            ];
        }

        return [
            'ret' => false,
        ];
    }
}
