<?php
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

namespace Modules\tests\QA\Models;

use Modules\QA\Models\QABadge;
use Modules\QA\Models\QABadgeMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Utils\RnG\Text;

final class QABadgeMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD()
    {
        $badge = new QABadge();

        $badge->setName('Test Badge');

        $id = QABadgeMapper::create($badge);
        self::assertGreaterThan(0, $badge->getId());
        self::assertEquals($id, $badge->getId());

        $badgeR = QABadgeMapper::get($badge->getId());
        self::assertEquals($badge->getName(), $badgeR->getName());
    }

    /**
     * @group volume
     */
    public function testVolume()
    {
        for ($i = 1; $i < 30; ++$i) {
            $text  = new Text();
            $badge = new QABadge();

            $badge->setName($text->generateText(mt_rand(1, 3)));

            $id = QABadgeMapper::create($badge);
        }
    }
}
