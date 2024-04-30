<?php

namespace App\Test\Controller;

use App\Entity\Experience;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExperienceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/experience/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Experience::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Experience index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'experience[title]' => 'Testing',
            'experience[content]' => 'Testing',
            'experience[place]' => 'Testing',
            'experience[dateOfExp]' => 'Testing',
            'experience[duration]' => 'Testing',
            'experience[type]' => 'Testing',
            'experience[technologies]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Experience();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Title');
        $fixture->setPlace('My Title');
        $fixture->setDateOfExp('My Title');
        $fixture->setDuration('My Title');
        $fixture->setType('My Title');
        $fixture->setTechnologies('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Experience');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Experience();
        $fixture->setTitle('Value');
        $fixture->setContent('Value');
        $fixture->setPlace('Value');
        $fixture->setDateOfExp('Value');
        $fixture->setDuration('Value');
        $fixture->setType('Value');
        $fixture->setTechnologies('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'experience[title]' => 'Something New',
            'experience[content]' => 'Something New',
            'experience[place]' => 'Something New',
            'experience[dateOfExp]' => 'Something New',
            'experience[duration]' => 'Something New',
            'experience[type]' => 'Something New',
            'experience[technologies]' => 'Something New',
        ]);

        self::assertResponseRedirects('/experience/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getContent());
        self::assertSame('Something New', $fixture[0]->getPlace());
        self::assertSame('Something New', $fixture[0]->getDateOfExp());
        self::assertSame('Something New', $fixture[0]->getDuration());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getTechnologies());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Experience();
        $fixture->setTitle('Value');
        $fixture->setContent('Value');
        $fixture->setPlace('Value');
        $fixture->setDateOfExp('Value');
        $fixture->setDuration('Value');
        $fixture->setType('Value');
        $fixture->setTechnologies('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/experience/');
        self::assertSame(0, $this->repository->count([]));
    }
}
