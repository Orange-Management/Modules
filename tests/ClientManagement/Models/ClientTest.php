<?php declare(strict_types=1);
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

namespace Modules\tests\ClientManagement\Models;

use Modules\ClientManagement\Models\Client;

/**
 * @internal
 */
class ClientTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $client = new Client();

        self::assertEquals('', $client->getNumber());
        self::assertEmpty($client->getReverseNumber());
        self::assertEquals(0, $client->getStatus());
        self::assertEquals(0, $client->getType());
        self::assertEmpty($client->getTaxId());
        self::assertEmpty($client->getInfo());
        self::assertInstanceOf('\DateTime', $client->getCreatedAt());
    }

    public function testSetGet() : void
    {
        $client = new Client();

        $client->setNumber('1');
        self::assertEquals('1', $client->getNumber());

        $client->setReverseNumber('asdf');
        self::assertEquals('asdf', $client->getReverseNumber());

        $client->setStatus(2);
        self::assertEquals(2, $client->getStatus());

        $client->setType(3);
        self::assertEquals(3, $client->getType());

        $client->setTaxId(44);
        self::assertEquals(44, $client->getTaxId());

        $client->setInfo('Some info.');
        self::assertEquals('Some info.', $client->getInfo());
    }
}
