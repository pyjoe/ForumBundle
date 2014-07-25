<?php

namespace Claroline\ForumBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/07/24 04:27:09
 */
class Version20140724162656 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_forum_category 
            ADD hash_name VARCHAR(50) NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_2192ACF7E1F029B6 ON claro_forum_category (hash_name)
        ");
        $this->addSql("
            ALTER TABLE claro_forum_message 
            ADD hash_name VARCHAR(50) NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_6A49AC0EE1F029B6 ON claro_forum_message (hash_name)
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            ADD hash_name VARCHAR(50) NOT NULL, 
            DROP isClosed
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_273AA20BE1F029B6 ON claro_forum_subject (hash_name)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX UNIQ_2192ACF7E1F029B6 ON claro_forum_category
        ");
        $this->addSql("
            ALTER TABLE claro_forum_category 
            DROP hash_name
        ");
        $this->addSql("
            DROP INDEX UNIQ_6A49AC0EE1F029B6 ON claro_forum_message
        ");
        $this->addSql("
            ALTER TABLE claro_forum_message 
            DROP hash_name
        ");
        $this->addSql("
            DROP INDEX UNIQ_273AA20BE1F029B6 ON claro_forum_subject
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            ADD isClosed TINYINT(1) NOT NULL, 
            DROP hash_name
        ");
    }
}