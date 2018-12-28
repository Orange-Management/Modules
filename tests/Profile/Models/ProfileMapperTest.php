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

namespace Modules\tests\ClientMapper\Models;

use Modules\Admin\Models\AccountMapper;
use Modules\Media\Models\Media;
use Modules\Profile\Models\Profile;
use Modules\Profile\Models\ProfileMapper;

class ProfileMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $media = new Media();
        $media->setCreatedBy(1);
        $media->setDescription('desc');
        $media->setPath('Web/Backend/img/default-user.jpg');
        $media->setSize(11);
        $media->setExtension('png');
        $media->setName('Image');

        if (($profile = ProfileMapper::getFor(1, 'account'))->getId() === 0) {
            $profile = new Profile();

            $profile->setAccount(AccountMapper::get(1));
            $profile->setImage($media);
            $profile->setBirthday($date = new \DateTime('now'));

            $id = ProfileMapper::create($profile);
            self::assertGreaterThan(0, $profile->getId());
            self::assertEquals($id, $profile->getId());
        } else {
            $profile->setImage($media);
            $profile->setBirthday($date = new \DateTime('now'));

            ProfileMapper::update($profile);
        }

        $profileR = ProfileMapper::get($profile->getId());
        self::assertEquals($profile->getBirthday()->format('Y-m-d'), $profileR->getBirthday()->format('Y-m-d'));
        self::assertEquals($profile->getImage()->getName(), $profileR->getImage()->getName());
        self::assertEquals($profile->getAccount()->getName1(), $profileR->getAccount()->getName1());
    }
}
