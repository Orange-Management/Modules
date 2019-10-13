<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    tests
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\tests\Profile\Models;

use Modules\Profile\Models\Profile;

/**
 * @internal
 */
class ProfileTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $profile = new Profile();

        self::assertEquals(0, $profile->getId());
        self::assertInstanceOf('\Modules\Media\Models\Media', $profile->getImage());
        self::assertInstanceOf('\DateTime', $profile->getBirthday());
    }

    public function testSetGet() : void
    {
        $profile = new Profile();

        $profile->setBirthday($date = new \DateTime('now'));
        self::assertEquals($date, $profile->getBirthday());
    }
}
