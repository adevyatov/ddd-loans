<?php

declare(strict_types=1);

namespace App\Tests\Functional\Clients\Application\Query;

use App\Clients\Application\Query\FindClientQuery;
use App\Clients\Domain\Client;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Functional\BaseWebTestCase;
use DataFixtures\ClientFixture;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class FindClientByIdQueryHandlerTest extends BaseWebTestCase
{
    private QueryBus $bus;

    /** @var AbstractDatabaseTool */
    protected AbstractDatabaseTool $databaseTool;

    public function setUp(): void
    {
        parent::setUp();
        $this->bus = static::getContainer()->get(QueryBus::class);
    }

    public function testUserExists(): void
    {
        $this->databaseTool->loadFixtures([
            ClientFixture::class,
        ]);

        $id = new Uuid(ClientFixture::CLIENTS[0]['id']);

        $result = $this->bus->execute(new FindClientQuery($id));

        self::assertInstanceOf(Client::class, $result);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->databaseTool);
    }
}
