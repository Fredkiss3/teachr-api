<?php

namespace App\Tests;

use App\Entity\Statistics;
use App\Entity\Teachr;
use App\Repository\TeachrRepository;
use Doctrine\ORM\EntityManagerInterface;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TeachrAPITest extends WebTestCase
{
    use FixturesTrait;

    const HEADERS = [
        'accept' => ['application/json'],
        'content-type' => ['application/json'],
    ];

    /** @var KernelBrowser */
    private $client;
    /** @var EntityManagerInterface */
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


        $data = (array)json_decode($response->getContent());
        $this->assertArrayHasKey('data', $data);

        $this->assertSame(
            count($this->entities),
            count($data['data'])
        );

        $obj = $data["data"][0];
        $this->assertObjectHasAttribute("id", $obj);
        $this->assertObjectHasAttribute("prenom", $obj);
        $this->assertObjectHasAttribute("description", $obj);
        $this->assertObjectHasAttribute("formation", $obj);
        $this->assertObjectHasAttribute("dateDeCreation", $obj);
        $this->assertIsInt($obj->dateDeCreation);
    }


    public function testTeachrPost()
    {
        $this->client->request('POST', '/teachr', [
            "prenom" => "Marc",
            "formation" => "Université de Rennes1",
            "description" => "Calme et sérieux..."
        ], [], self::HEADERS);

        $response = $this->client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertJsonResponse($response);
        $data = (array)json_decode($response->getContent());
        $this->assertArrayHasKey('data', $data);

        $obj = $data["data"];
        // Vérifier que l'objet retourné n'est pas null
        $this->assertNotNull($obj);
        $this->assertIsNotArray($obj);

        /**
         * @var TeachrRepository $repo
         */
        $repo = $this->em->getRepository(Teachr::class);

        $result = $repo->findLatestID();

        // Vérifier que l'objet retourné est le même dans la BD
        $this->assertSame($result->getId(), $obj->id);
        $this->assertSame($result->getPrenom(), $obj->prenom);
        $this->assertSame($result->getDescription(), $obj->description);
        $this->assertSame($result->getFormation(), $obj->formation);
        $this->assertSame($result->getDateDeCreation(), $obj->dateDeCreation);
        $this->assertIsInt($obj->dateDeCreation);

        /**
         * @var Statistics $stats
         */
         $stats = $this->em->getRepository(Statistics::class)->findOneBy([]);
         $teachrs = $repo->findAll();

         $this->assertNotNull($stats);
         $this->assertSame(count($teachrs), $stats->getNumTeachrs());
    }

    public function testTeachrPostShowErrorsOnInvalidInput()
    {
        $this->client->request('POST', '/teachr', [
            "prenom" => "Marc",
            "formation" => "Université de Rennes1",
        ], [], self::HEADERS);

        $response = $this->client->getResponse();

        $this->assertJsonResponse($response);
        $this->assertResponseStatusCodeSame(400);
        $data = (array)json_decode($response->getContent());
        $this->assertArrayHasKey('data', $data);

        $obj = $data["data"];
        // Vérifier que l'objet retourné est null
        $this->assertNull($obj);
    }

    public function testTeachrPut()
    {
        $obj = $this->entities['teachr1'];

        $this->client->request('PUT', '/teachr/' . $obj->getId(), [
            "prenom" => "Marc",
            "formation" => "Université de Rennes1",
            "description" => "Calme et sérieux..."
        ], [], self::HEADERS);

        $response = $this->client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertJsonResponse($response);
        $data = (array)json_decode($response->getContent());
        $this->assertArrayHasKey('data', $data);

        // Vérifier que l'objet retourné n'est pas null
        $this->assertNotNull($data["data"]);
        $this->assertIsNotArray($data["data"]);

        /**
         * @var TeachrRepository $repo
         */
        $repo = $this->em->getRepository(Teachr::class);

        $result = $repo->findOneBy(['id' => $obj->getId()]);

        // Vérifier que les données ont bien été modifiées dans la BD
        $this->assertSame("Marc", $result->getPrenom());
        $this->assertSame("Université de Rennes1", $result->getFormation());
        $this->assertSame("Calme et sérieux...", $result->getDescription());
    }

    public function testTeachrNotFound()
    {
        $this->client->request('PUT', '/teachr/' . 4565, [], [], self::HEADERS);
        $response = $this->client->getResponse();

        $this->assertJsonResponse($response);
        $this->assertResponseStatusCodeSame(404);
        $data = (array)json_decode($response->getContent());
        $this->assertArrayHasKey('data', $data);

        $obj = $data["data"];
        // Vérifier que l'objet retourné est null
        $this->assertNull($obj);
        $this->assertSame("Objet non trouvé", $data["message"]);
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
