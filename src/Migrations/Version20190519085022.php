<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190519085022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('create table firm (id int primary key auto_increment, name varchar(32) not null)');
        $this->addSql('create table phone (id int primary key auto_increment, firmid int not null, phone varchar(32) not null)');
        $this->addSql('insert firm (id, name) values (1, "Sony")');
        $this->addSql('insert firm (id, name) values (2, "Panasonic")');
        $this->addSql('insert firm (id, name) values (3, "Samsung")');
        $this->addSql('insert phone (id, firmid, phone) values (1, 1, "332-55-56")');
        $this->addSql('insert phone (id, firmid, phone) values (2, 1, "332-50-01")');
        $this->addSql('insert phone (id, firmid, phone) values (3, 2, "256-49-12")');



        $this->addSql('create table company (compid int primary key auto_increment, name nvarchar(100) not null)');
        $this->addSql('create table goods (goodid int primary key auto_increment, name nvarchar(100) not null)');
        $this->addSql('create table shipment (shipid int primary key auto_increment, compid int not null, goodid int not null, quantity float not null, shipdate datetime not null)');
        $this->addSql('insert company (compid, name) values (1, \'Intel\')');
        $this->addSql('insert company (compid, name) values (2, \'IBM\')');
        $this->addSql('insert company (compid, name) values (3, \'Compaq\')');
        $this->addSql('insert goods (goodid, name) values (1, \'Pentium IIV\')');
        $this->addSql('insert goods (goodid, name) values (2, \'Celeron\')');
        $this->addSql('insert goods (goodid, name) values (3, \'AMD\')');
        $this->addSql('insert shipment (compid, goodid, quantity, shipdate) values (1, 1, 100, \'2010-11-04 00:00:00\')');
        $this->addSql('insert shipment (compid, goodid, quantity, shipdate) values (1, 1, 200, \'2010-11-12 00:00:00\')');
        $this->addSql('insert shipment (compid, goodid, quantity, shipdate) values (1, 2, 300, \'2010-12-02 00:00:00\')');
        $this->addSql('insert shipment (compid, goodid, quantity, shipdate) values (1, 2, 400, \'2010-12-09 00:00:00\')');
        $this->addSql('insert shipment (compid, goodid, quantity, shipdate) values (2, 1, 100, \'2010-10-29 00:00:00\')');
        $this->addSql('insert shipment (compid, goodid, quantity, shipdate) values (2, 1, 200, \'2010-11-06 00:00:00\')');
        $this->addSql('insert shipment (compid, goodid, quantity, shipdate) values (2, 2, 300, \'2010-12-29 00:00:00\')');
        $this->addSql('insert shipment (compid, goodid, quantity, shipdate) values (2, 2, 700, \'2010-12-03 00:00:00\')');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE shipment');
        $this->addSql('DROP TABLE goods');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE firm');
    }
}
