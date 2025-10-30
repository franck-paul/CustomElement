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
use Dotclear\Helper\File\Path;

class FrontendRest
{
    /**
     * REST method to get stable release version.
     *
     * @return     array{ret:bool, text?:string}   The payload.
     */
    public static function getReleaseStableVersion(): array
    {
        $path = Path::real(App::config()->cacheRoot() . '/versions');
        if ($path && is_dir($path)) {
            $channel = 'stable';
            $file    = $path . '/dotclear-' . $channel;
            if (file_exists($file)) {
                $content = @unserialize((string) @file_get_contents($file));
                if (is_array($content) && isset($content['version'])) {
                    return [
                        'ret'  => true,
                        'text' => (string) $content['version'],
                    ];
                }
            }
        }

        return [
            'ret' => false,
        ];
    }
}
