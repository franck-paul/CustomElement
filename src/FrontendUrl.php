<?php

/**
 * @brief CustomElement, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

namespace Dotclear\Plugin\CustomElement;

use Dotclear\App;
use Dotclear\Core\Url;

class FrontendUrl extends Url
{
    public static function rest(): void
    {
        if (App::rest()->serveRestRequests()) {
            // Register REST methods
            App::rest()->addFunction('getReleaseStableVersion', FrontendRest::getReleaseStableVersion(...));
            App::rest()->addFunction('getReleaseStablePhpMin', FrontendRest::getReleaseStablePhpMin(...));
            App::rest()->addFunction('getNextRequiredPhp', FrontendRest::getNextRequiredPhp(...));

            // Cope with REST request
            App::rest()->serve();
        }
    }
}
