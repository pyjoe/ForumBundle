<?php

namespace Claroline\ForumBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/04/08 11:55:55
 */
class Version20140408115553 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_2192ACF729CCBAD0
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_forum_category AS 
            SELECT id, 
            forum_id, 
            created, 
            modificationDate, 
            name 
            FROM claro_forum_category
        ");
        $this->addSql("
            DROP TABLE claro_forum_category
        ");
        $this->addSql("
            CREATE TABLE claro_forum_category (
                id INTEGER NOT NULL, 
                forum_id INTEGER DEFAULT NULL, 
                created DATETIME NOT NULL, 
                modificationDate DATETIME NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                hash_name VARCHAR(50) NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_2192ACF729CCBAD0 FOREIGN KEY (forum_id) 
                REFERENCES claro_forum (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_forum_category (
                id, forum_id, created, modificationDate, 
                name
            ) 
            SELECT id, 
            forum_id, 
            created, 
            modificationDate, 
            name 
            FROM __temp__claro_forum_category
        ");
        $this->addSql("
            DROP TABLE __temp__claro_forum_category
        ");
        $this->addSql("
            CREATE INDEX IDX_2192ACF729CCBAD0 ON claro_forum_category (forum_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_2192ACF7E1F029B6 ON claro_forum_category (hash_name)
        ");
        $this->addSql("
            DROP INDEX UNIQ_F2869DFB87FAB32
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_forum AS 
            SELECT id, 
            resourceNode_id 
            FROM claro_forum
        ");
        $this->addSql("
            DROP TABLE claro_forum
        ");
        $this->addSql("
            CREATE TABLE claro_forum (
                id INTEGER NOT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                hash_name VARCHAR(50) NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_F2869DFB87FAB32 FOREIGN KEY (resourceNode_id) 
                REFERENCES claro_resource_node (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_forum (id, resourceNode_id) 
            SELECT id, 
            resourceNode_id 
            FROM __temp__claro_forum
        ");
        $this->addSql("
            DROP TABLE __temp__claro_forum
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_F2869DFB87FAB32 ON claro_forum (resourceNode_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_F2869DFE1F029B6 ON claro_forum (hash_name)
        ");
        $this->addSql("
            DROP INDEX IDX_6A49AC0E23EDC87
        ");
        $this->addSql("
            DROP INDEX IDX_6A49AC0EA76ED395
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_forum_message AS 
            SELECT id, 
            subject_id, 
            user_id, 
            content, 
            created, 
            updated 
            FROM claro_forum_message
        ");
        $this->addSql("
            DROP TABLE claro_forum_message
        ");
        $this->addSql("
            CREATE TABLE claro_forum_message (
                id INTEGER NOT NULL, 
                subject_id INTEGER DEFAULT NULL, 
                user_id INTEGER DEFAULT NULL, 
                content CLOB NOT NULL, 
                created DATETIME NOT NULL, 
                updated DATETIME NOT NULL, 
                hash_name VARCHAR(50) NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_6A49AC0E23EDC87 FOREIGN KEY (subject_id) 
                REFERENCES claro_forum_subject (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_6A49AC0EA76ED395 FOREIGN KEY (user_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_forum_message (
                id, subject_id, user_id, content, created, 
                updated
            ) 
            SELECT id, 
            subject_id, 
            user_id, 
            content, 
            created, 
            updated 
            FROM __temp__claro_forum_message
        ");
        $this->addSql("
            DROP TABLE __temp__claro_forum_message
        ");
        $this->addSql("
            CREATE INDEX IDX_6A49AC0E23EDC87 ON claro_forum_message (subject_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_6A49AC0EA76ED395 ON claro_forum_message (user_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_6A49AC0EE1F029B6 ON claro_forum_message (hash_name)
        ");
        $this->addSql("
            DROP INDEX IDX_273AA20BA76ED395
        ");
        $this->addSql("
            DROP INDEX IDX_273AA20B12469DE2
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_forum_subject AS 
            SELECT id, 
            category_id, 
            user_id, 
            title, 
            created, 
            updated, 
            isSticked 
            FROM claro_forum_subject
        ");
        $this->addSql("
            DROP TABLE claro_forum_subject
        ");
        $this->addSql("
            CREATE TABLE claro_forum_subject (
                id INTEGER NOT NULL, 
                category_id INTEGER DEFAULT NULL, 
                user_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) NOT NULL, 
                created DATETIME NOT NULL, 
                updated DATETIME NOT NULL, 
                isSticked BOOLEAN NOT NULL, 
                hash_name VARCHAR(50) NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_273AA20B12469DE2 FOREIGN KEY (category_id) 
                REFERENCES claro_forum_category (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_273AA20BA76ED395 FOREIGN KEY (user_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_forum_subject (
                id, category_id, user_id, title, created, 
                updated, isSticked
            ) 
            SELECT id, 
            category_id, 
            user_id, 
            title, 
            created, 
            updated, 
            isSticked 
            FROM __temp__claro_forum_subject
        ");
        $this->addSql("
            DROP TABLE __temp__claro_forum_subject
        ");
        $this->addSql("
            CREATE INDEX IDX_273AA20BA76ED395 ON claro_forum_subject (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_273AA20B12469DE2 ON claro_forum_subject (category_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_273AA20BE1F029B6 ON claro_forum_subject (hash_name)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX UNIQ_F2869DFE1F029B6
        ");
        $this->addSql("
            DROP INDEX UNIQ_F2869DFB87FAB32
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_forum AS 
            SELECT id, 
            resourceNode_id 
            FROM claro_forum
        ");
        $this->addSql("
            DROP TABLE claro_forum
        ");
        $this->addSql("
            CREATE TABLE claro_forum (
                id INTEGER NOT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_F2869DFB87FAB32 FOREIGN KEY (resourceNode_id) 
                REFERENCES claro_resource_node (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_forum (id, resourceNode_id) 
            SELECT id, 
            resourceNode_id 
            FROM __temp__claro_forum
        ");
        $this->addSql("
            DROP TABLE __temp__claro_forum
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_F2869DFB87FAB32 ON claro_forum (resourceNode_id)
        ");
        $this->addSql("
            DROP INDEX UNIQ_2192ACF7E1F029B6
        ");
        $this->addSql("
            DROP INDEX IDX_2192ACF729CCBAD0
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_forum_category AS 
            SELECT id, 
            forum_id, 
            created, 
            modificationDate, 
            name 
            FROM claro_forum_category
        ");
        $this->addSql("
            DROP TABLE claro_forum_category
        ");
        $this->addSql("
            CREATE TABLE claro_forum_category (
                id INTEGER NOT NULL, 
                forum_id INTEGER DEFAULT NULL, 
                created DATETIME NOT NULL, 
                modificationDate DATETIME NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_2192ACF729CCBAD0 FOREIGN KEY (forum_id) 
                REFERENCES claro_forum (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_forum_category (
                id, forum_id, created, modificationDate, 
                name
            ) 
            SELECT id, 
            forum_id, 
            created, 
            modificationDate, 
            name 
            FROM __temp__claro_forum_category
        ");
        $this->addSql("
            DROP TABLE __temp__claro_forum_category
        ");
        $this->addSql("
            CREATE INDEX IDX_2192ACF729CCBAD0 ON claro_forum_category (forum_id)
        ");
        $this->addSql("
            DROP INDEX UNIQ_6A49AC0EE1F029B6
        ");
        $this->addSql("
            DROP INDEX IDX_6A49AC0E23EDC87
        ");
        $this->addSql("
            DROP INDEX IDX_6A49AC0EA76ED395
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_forum_message AS 
            SELECT id, 
            subject_id, 
            user_id, 
            content, 
            created, 
            updated 
            FROM claro_forum_message
        ");
        $this->addSql("
            DROP TABLE claro_forum_message
        ");
        $this->addSql("
            CREATE TABLE claro_forum_message (
                id INTEGER NOT NULL, 
                subject_id INTEGER DEFAULT NULL, 
                user_id INTEGER DEFAULT NULL, 
                content CLOB NOT NULL, 
                created DATETIME NOT NULL, 
                updated DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_6A49AC0E23EDC87 FOREIGN KEY (subject_id) 
                REFERENCES claro_forum_subject (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_6A49AC0EA76ED395 FOREIGN KEY (user_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_forum_message (
                id, subject_id, user_id, content, created, 
                updated
            ) 
            SELECT id, 
            subject_id, 
            user_id, 
            content, 
            created, 
            updated 
            FROM __temp__claro_forum_message
        ");
        $this->addSql("
            DROP TABLE __temp__claro_forum_message
        ");
        $this->addSql("
            CREATE INDEX IDX_6A49AC0E23EDC87 ON claro_forum_message (subject_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_6A49AC0EA76ED395 ON claro_forum_message (user_id)
        ");
        $this->addSql("
            DROP INDEX UNIQ_273AA20BE1F029B6
        ");
        $this->addSql("
            DROP INDEX IDX_273AA20B12469DE2
        ");
        $this->addSql("
            DROP INDEX IDX_273AA20BA76ED395
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__claro_forum_subject AS 
            SELECT id, 
            category_id, 
            user_id, 
            title, 
            created, 
            updated, 
            isSticked 
            FROM claro_forum_subject
        ");
        $this->addSql("
            DROP TABLE claro_forum_subject
        ");
        $this->addSql("
            CREATE TABLE claro_forum_subject (
                id INTEGER NOT NULL, 
                category_id INTEGER DEFAULT NULL, 
                user_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) NOT NULL, 
                created DATETIME NOT NULL, 
                updated DATETIME NOT NULL, 
                isSticked BOOLEAN NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_273AA20B12469DE2 FOREIGN KEY (category_id) 
                REFERENCES claro_forum_category (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_273AA20BA76ED395 FOREIGN KEY (user_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO claro_forum_subject (
                id, category_id, user_id, title, created, 
                updated, isSticked
            ) 
            SELECT id, 
            category_id, 
            user_id, 
            title, 
            created, 
            updated, 
            isSticked 
            FROM __temp__claro_forum_subject
        ");
        $this->addSql("
            DROP TABLE __temp__claro_forum_subject
        ");
        $this->addSql("
            CREATE INDEX IDX_273AA20B12469DE2 ON claro_forum_subject (category_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_273AA20BA76ED395 ON claro_forum_subject (user_id)
        ");
    }
}