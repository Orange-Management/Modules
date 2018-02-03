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

namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\BatchPosting;

class BatchPostingTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $batch = new BatchPosting();
        self::assertEquals(0, $batch->count());
        self::assertEquals(0, $batch->getId());
        self::assertEquals(0, $batch->getCreator());
        self::assertInstanceOf('\DateTime', $batch->getCreatedAt());
    }

    public function testSetGet()
    {
        $batch = new BatchPosting();

        $batch->setCreator(2);
        self::assertEquals(2, $batch->getCreator());

        $batch->setDescription('Test');
        self::assertEquals('Test', $batch->getDescription());
    }
}
