<?php

namespace Claroline\ForumBundle\Migrations\pdo_ibm;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/07/30 05:20:18
 */
class Version20140730172005 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_forum_category 
            ADD COLUMN hash_name VARCHAR(50) NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_2192ACF7E1F029B6 ON claro_forum_category (hash_name)
        ");
        $this->addSql("
            ALTER TABLE claro_forum_message 
            ADD COLUMN hash_name VARCHAR(50) NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_6A49AC0EE1F029B6 ON claro_forum_message (hash_name)
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            ADD COLUMN hash_name VARCHAR(50) NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_273AA20BE1F029B6 ON claro_forum_subject (hash_name)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_forum_category 
            DROP COLUMN hash_name
        ");
        $this->addSql("
            DROP INDEX UNIQ_2192ACF7E1F029B6
        ");
        $this->addSql("
            ALTER TABLE claro_forum_message 
            DROP COLUMN hash_name
        ");
        $this->addSql("
            DROP INDEX UNIQ_6A49AC0EE1F029B6
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            DROP COLUMN hash_name
        ");
        $this->addSql("
            DROP INDEX UNIQ_273AA20BE1F029B6
        ");
    }
}