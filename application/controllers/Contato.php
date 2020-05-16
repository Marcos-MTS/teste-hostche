<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('form_validation');
        $this->load->helper('array');
        $this->load->database();
        $this->load->model('contato_model', 'contato');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('nome-txt', 'Nome', 'required|min_length[6]|max_length[100]');
        $this->form_validation->set_rules('email-txt', 'Email', 'required|min_length[6]|max_length[100]|strtolower|valid_email');
        $this->form_validation->set_rules('telefone-txt', 'Telefone', 'required|min_length[6]|max_length[100]');
        $this->form_validation->set_rules('celular-txt', 'Celular', 'required|min_length[6]|max_length[100]');
        $this->form_validation->set_message('mensagem-txt', 'required|min_length[6]|max_length[1000]');
       
        $dados['nome'] = $this->input->post('nome-txt');
        $dados['email'] = $this->input->post('email-txt');
        $dados['celular'] = $this->input->post('celular-txt');
        $dados['telefone'] = $this->input->post('telefone-txt');
        $dados['mensagem'] = $this->input->post('mensagem-txt');

        $status = array("STATUS" => false);

        if ($this->form_validation->run() == TRUE) {
            $dados = elements(array('nome', 'email', 'telefone', 'celular', 'mensagem'), $dados);
            if ($this->contato->inserir($dados)) {
                $status = array("STATUS" => true);
            } else {
                $status = array("STATUS" => "Ocorreu algum erro ao cadastrar!");
            }
        } else {
            $status = array("STATUS" => validation_errors());
        }
        echo json_encode($status);
    }
}
