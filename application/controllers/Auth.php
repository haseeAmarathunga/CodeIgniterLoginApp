<?php

class Auth extends CI_Controller
{
    public function registration()
    {
        if(isset($_POST['registration']))
        {
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('password','Password','required|min_length[5]');
            $this->form_validation->set_rules('password','PasswordConfirm','required|min_length[5]|matches[Password]');

            //if form validate is true
            if($this->form_validation->run()==TRUE){
                echo 'form validated!';

                $data=array(
                    'firstname'=>$_POST['firstname'],
                    'lastname'=>$_POST['lastname'],
                    'department'=>$_POST['department'],
                );
                $this->insert('users',$data);
            }
        }
        $this->load->view('registration');
    }
}