<?php

namespace Claroline\ForumBundle\Migrations\oci8;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/04/08 03:43:29
 */
class Version20140408154323 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_forum 
            DROP (hash_name)
        ");
        $this->addSql("
            DROP INDEX UNIQ_F2869DFE1F029B6
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_forum 
            ADD (
                hash_name VARCHAR2(50) NOT NULL
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_F2869DFE1F029B6 ON claro_forum (hash_name)
        ");
    }
}