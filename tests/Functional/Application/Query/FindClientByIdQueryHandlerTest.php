<?php

declare(strict_types=1);

namespace App\Tests\Functional\Application\Query;

use App\Clients\Application\Query\FindClientByIdQuery;
use App\Clients\Domain\Client;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;
use DataFixtures\ClientFixture;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FindClientByIdQueryHandlerTest extends WebTestCase
{
    private QueryBus $bus;

    /** @var AbstractDatabaseTool */
    protected AbstractDatabaseTool $databaseTool;

    public function setUp(): void
    {
        parent::setUp();

        $this->bus = static::getContainer()->get(QueryBus::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testUserExists(): void
    {
        $this->databaseTool->loadFixtures([
            ClientFixture::class,
        ]);

        $id = new Uuid(ClientFixture::CLIENTS[0]['id']);

        $result = $this->bus->execute(new FindClientByIdQuery($id));

        self::assertInstanceOf(Client::class, $result);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->databaseTool);
    }
}
