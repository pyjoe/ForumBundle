<?php

namespace Claroline\ForumBundle\Installation\Updater;

use Doctrine\DBAL\Connection;
use Claroline\CoreBundle\Library\Utilities\ClaroUtilities;

class Updater030100
{

    private $container;
    private $logger;
    private $ut;

    public function __construct($container)
    {
        $this->container = $container;
        $this->ut = $container->get('claroline.utilities.misc');
    }

    public function postUpdate()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $this->log('Setting forum category hashname...');
        $categoryRepo = $this->em->getRepository('ClarolineForumBundle:Category');
        $this->setRepoHashname($categoryRepo);
        
        $this->log('Setting forum subject hashname...');
        $subjectRepo = $this->em->getRepository('ClarolineForumBundle:Subject');
        $this->setRepoHashname($subjectRepo);
        
        $this->log('Setting forum message hashname...');
        $messageRepo = $this->em->getRepository('ClarolineForumBundle:Message');
        $this->setRepoHashname($messageRepo);
    }
    
    private function setRepoHashname($repo)
    {
        for ($i = 0, $count = count($repo); $i < $count; $i++) {
            $repo[$i]->setHashName($this->ut->generateGuid());
            $this->testFlush($i);
        }
        $this->em->flush();
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