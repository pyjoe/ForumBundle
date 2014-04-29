<?php

namespace Claroline\ForumBundle\Migrations\pdo_sqlsrv;

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
            DROP COLUMN hash_name
        ");
        $this->addSql("
            IF EXISTS (
                SELECT * 
                FROM sysobjects 
                WHERE name = 'UNIQ_F2869DFE1F029B6'
            ) 
            ALTER TABLE claro_forum 
            DROP CONSTRAINT UNIQ_F2869DFE1F029B6 ELSE 
            DROP INDEX UNIQ_F2869DFE1F029B6 ON claro_forum
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_forum 
            ADD hash_name NVARCHAR(50) NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_F2869DFE1F029B6 ON claro_forum (hash_name) 
            WHERE hash_name IS NOT NULL
        ");
    }
}