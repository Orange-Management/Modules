<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\Knowledgebase\Models;

use Modules\Knowledgebase\Models\WikiBadge;

class WikiBadgeTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $badge = new WikiBadge();

        self::assertEquals(0, $badge->getId());
        self::assertEquals('', $badge->getName());
    }

    public function testSetGet()
    {
        $badge = new WikiBadge();

        $badge->setName('Badge Name');

        self::assertEquals('Badge Name', $badge->getName());
    }
}
