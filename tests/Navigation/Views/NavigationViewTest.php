<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
namespace Modules\tests\Navigation\Views;

use Modules\Navigation\Views\NavigationView;

/**
 * @internal
 */
class NavigationViewTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $view = new NavigationView();

        self::assertEquals(0, $view->getNavId());
        self::assertEquals([], $view->getNav());
        self::assertEquals(0, $view->getParent());
    }

    public function testGetSet() : void
    {
        $view = new NavigationView();

        $view->setNavId(2);
        self::assertEquals(2, $view->getNavId());

        $view->setNav([1, 2, 3]);
        self::assertEquals([1, 2, 3], $view->getNav());

        $view->setParent(4);
        self::assertEquals(4, $view->getParent());
    }
}
