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
use Dotclear\Helper\Html\Html;

class FrontendBehaviors
{
    public static function publicHeadContent(): string
    {
        echo
        Html::jsJson('custom-element', [
            'uri' => App::url()->getMode() === 'path_info' ?
                App::blog()->url() . 'rest' :
                App::blog()->getQmarkURL() . 'rest&',
        ]) .
        My::jsLoad('CustomElement.js');

        return '';
    }
}
