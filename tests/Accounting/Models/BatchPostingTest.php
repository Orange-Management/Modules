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

namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\BatchPosting;

/**
 * @internal
 */
class BatchPostingTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $batch = new BatchPosting();
        self::assertEquals(0, $batch->count());
        self::assertEquals(0, $batch->getId());
        self::assertEquals(0, $batch->getCreator());
        self::assertNull($batch->getPosting(1));
        self::assertFalse($batch->removePosting(1));
        self::assertEquals(0, $batch->count());
        self::assertCount(0, $batch);
        self::assertInstanceOf('\DateTime', $batch->getCreatedAt());
    }

    public function testSetGet() : void
    {
        $batch = new BatchPosting();

        $batch->setCreator(2);
        self::assertEquals(2, $batch->getCreator());

        $batch->setDescription('Test');
        self::assertEquals('Test', $batch->getDescription());
    }
}
