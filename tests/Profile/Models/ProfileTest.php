<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\Profile\Models;

use Modules\Profile\Models\Profile;

class ProfileTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $profile = new Profile();

        self::assertEquals(0, $profile->getId());
        self::assertInstanceOf('\Modules\Media\Models\Media', $profile->getImage());
        self::assertInstanceOf('\DateTime', $profile->getBirthday());
    }

    public function testSetGet()
    {
        $profile = new Profile();

        $profile->setBirthday($date = new \DateTime('now'));
        self::assertEquals($date, $profile->getBirthday());
    }
}
