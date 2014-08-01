<?php

namespace Claroline\ForumBundle\Migrations\pdo_sqlsrv;

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
            ADD hash_name NVARCHAR(50) NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_2192ACF7E1F029B6 ON claro_forum_category (hash_name) 
            WHERE hash_name IS NOT NULL
        ");
        $this->addSql("
            ALTER TABLE claro_forum_message 
            ADD hash_name NVARCHAR(50) NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_6A49AC0EE1F029B6 ON claro_forum_message (hash_name) 
            WHERE hash_name IS NOT NULL
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            ADD hash_name NVARCHAR(50) NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_273AA20BE1F029B6 ON claro_forum_subject (hash_name) 
            WHERE hash_name IS NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_forum_category 
            DROP COLUMN hash_name
        ");
        $this->addSql("
            IF EXISTS (
                SELECT * 
                FROM sysobjects 
                WHERE name = 'UNIQ_2192ACF7E1F029B6'
            ) 
            ALTER TABLE claro_forum_category 
            DROP CONSTRAINT UNIQ_2192ACF7E1F029B6 ELSE 
            DROP INDEX UNIQ_2192ACF7E1F029B6 ON claro_forum_category
        ");
        $this->addSql("
            ALTER TABLE claro_forum_message 
            DROP COLUMN hash_name
        ");
        $this->addSql("
            IF EXISTS (
                SELECT * 
                FROM sysobjects 
                WHERE name = 'UNIQ_6A49AC0EE1F029B6'
            ) 
            ALTER TABLE claro_forum_message 
            DROP CONSTRAINT UNIQ_6A49AC0EE1F029B6 ELSE 
            DROP INDEX UNIQ_6A49AC0EE1F029B6 ON claro_forum_message
        ");
        $this->addSql("
            ALTER TABLE claro_forum_subject 
            DROP COLUMN hash_name
        ");
        $this->addSql("
            IF EXISTS (
                SELECT * 
                FROM sysobjects 
                WHERE name = 'UNIQ_273AA20BE1F029B6'
            ) 
            ALTER TABLE claro_forum_subject 
            DROP CONSTRAINT UNIQ_273AA20BE1F029B6 ELSE 
            DROP INDEX UNIQ_273AA20BE1F029B6 ON claro_forum_subject
        ");
    }
}