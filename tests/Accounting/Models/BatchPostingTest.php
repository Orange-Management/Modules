<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\BatchPosting;
use Modules\Accounting\Models\PostingInterface;

/**
 * @internal
 */
class BatchPostingTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Accounting\Models\BatchPosting
     */
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

    /**
     * @covers Modules\Accounting\Models\BatchPosting
     */
    public function testCreatorInputOutput() : void
    {
        $batch = new BatchPosting();

        $batch->setCreator(2);
        self::assertEquals(2, $batch->getCreator());
    }

    /**
     * @covers Modules\Accounting\Models\BatchPosting
     */
    public function testDescriptionInputOutput() : void
    {
        $batch = new BatchPosting();

        $batch->setDescription('Test');
        self::assertEquals('Test', $batch->getDescription());
    }

    /**
     * @covers Modules\Accounting\Models\BatchPosting
     */
    public function testRemovePosting() : void
    {
        $batch = new BatchPosting();
        $batch->addPosting(new class() implements PostingInterface {

        });

        self::assertCount(1, $batch);
        self::assertTrue($batch->removePosting(0));
        self::assertCount(0, $batch);
    }
}
