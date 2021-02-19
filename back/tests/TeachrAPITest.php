<?php

namespace App\Tests;

use App\Entity\Teachr;
use Doctrine\ORM\EntityManagerInterface;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TeachrAPITest extends WebTestCase
{
    use FixturesTrait;

    const HEADERS = [
        'accept' => ['application/json'],
        'content-type' => ['application/json'],
    ];

    /** @var EntityManagerInterface */
    private $client;
    /** @var KernelBrowser */
    private $em;

    /**
     * @var Teachr[]
     */
    protected $entities = [];

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        /** @var EntityManagerInterface $em */
        $this->em = self::$container->get(EntityManagerInterface::class);

        // fixtures
        $this->entities = $this->loadFixtureFiles([__DIR__ . '/fixtures/TeachrFixtures.yml']);
    }

    public function testTeachrIndex(): void
    {
        $this->client->request('GET', '/teachr', [], [], self::HEADERS);

        $response = $this->client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertJsonResponse($response);


        $data = (array) json_decode($response->getContent());
        $this->assertArrayHasKey('data', $data);

        $this->assertSame(
            count($this->entities),
            count($data['data'])
        );
    }

    private function assertJsonResponse(Response $response)
    {
        $this->assertTrue(
            $response->headers->contains(
                'Content-Type', 'application/json'
            )
        );
    }

}
