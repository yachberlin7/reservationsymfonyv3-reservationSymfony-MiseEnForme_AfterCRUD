<?php

namespace App\Test\Controller;

use App\Entity\RepasMenu;
use App\Repository\RepasMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RepasMenuControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/gestion/menu/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(RepasMenu::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('RepasMenu index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'repas_menu[description]' => 'Testing',
            'repas_menu[typeRepas]' => 'Testing',
            'repas_menu[jourMenu]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new RepasMenu();
        $fixture->setDescription('My Title');
        $fixture->setTypeRepas('My Title');
        $fixture->setJourMenu('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('RepasMenu');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new RepasMenu();
        $fixture->setDescription('Value');
        $fixture->setTypeRepas('Value');
        $fixture->setJourMenu('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'repas_menu[description]' => 'Something New',
            'repas_menu[typeRepas]' => 'Something New',
            'repas_menu[jourMenu]' => 'Something New',
        ]);

        self::assertResponseRedirects('/gestion/menu/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getTypeRepas());
        self::assertSame('Something New', $fixture[0]->getJourMenu());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new RepasMenu();
        $fixture->setDescription('Value');
        $fixture->setTypeRepas('Value');
        $fixture->setJourMenu('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/gestion/menu/');
        self::assertSame(0, $this->repository->count([]));
    }
}
