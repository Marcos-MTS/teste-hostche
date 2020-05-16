<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_contatos extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'telefone' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'celular' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'mensagem' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('contatos');
    }

    public function down() {
        $this->dbforge->drop_table('contatos');
    }

}
