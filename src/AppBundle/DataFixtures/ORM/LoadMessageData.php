<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Message;

class LoadMessageData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $message = new Message();
        $message->setText('Hello lovely world');
        $message->setUser($this->getReference('app_user-steve_winton'));
        $manager->persist($message);
        $this->addReference('message-hello_lovely_world', $message);

        $message = new Message();
        $message->setText('Hello again');
        $message->setUser($this->getReference('app_user-steve_winton'));
        $manager->persist($message);
        $this->addReference('message-hello_again', $message);

        $message = new Message();
        $message->setText('Goodbye, cruel world :(');
        $message->setUser($this->getReference('app_user-steve_winton'));
        $manager->persist($message);
        $this->addReference('message-goodbye_cruel_world', $message);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}