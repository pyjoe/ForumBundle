<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Claroline\ForumBundle\Installation\Updater;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Updater030100
{
    private $container;
    private $em;
    private $logger;
    private $ut;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine.orm.entity_manager');
        $this->ut = $container->get('claroline.utilities.misc');
    }

    public function postUpdate()
    {        
        $this->log('Updating forum table...');
        $forums = $this->em->getRepository('ClarolineForumBundle:Forum')->findAll();

        $counter = 0;
        
        foreach ($forums as $forum) {
            $categories = $forum->getCategories();
            $this->log('Adding category hashname...');
            $counter ++;
            $this->testFlush($counter);
            $this->postUpdateCategory($categories, $counter);
        }

        $this->em->flush();
    }
    
    private postUpdateCategory($categories, $counter)
    {
        foreach ($categories as $cat) {
            $subjects = $cat->getSubjects();
            $cat->setHashname($this->ut->generateGuid());
            $this->log('Adding subjects hashname...');
            $counter ++;
            $this->testFlush($counter);
            $this->postUpdateSubjects($subjects, $counter);
        }
    }
    
    private postUpdateSubjects($subjects, $counter) 
    {
        foreach ($subjects as $subject) {
            $subject->setHashname($this->ut->generateGuid());
            $messages = $subject->getMessages();
            $this->log('Adding message hashname...');
            $counter ++;
            $this->testFlush($counter);
            $this->postUpdateMessage($messages, $counter);
        }
    }
    
    private postUpdateMessage($messages, $counter)
    {
        foreach ($messages as $msg) {
            $msg->setHashname($this->ut->generateGuid());
            $counter ++;
            $this->testFlush($counter);
        }
    }

    private function testFlush($i)
    {
        if ($i % 50 === 0) {
            $this->em->flush();
        }
    }
    
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    private function log($message)
    {
        if ($log = $this->logger) {
            $log('    ' . $message);
        }
    }
}
