<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contato_model extends CI_Model {

    public function inserir($dados = NULL) {
        if ($dados != NULL) {
            return $this->db->insert('contatos', $dados);
        } else {
            return false;
        }
    }

}
