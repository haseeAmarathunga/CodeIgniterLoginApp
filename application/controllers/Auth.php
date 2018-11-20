<?php

class Auth extends CI_Controller
{
    public function registration()
    {
        if(isset($_POST['registration']))
        {
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('password','Password','required|min_length[5]');
            $this->form_validation->set_rules('password','Confirm Password','required|min_length[5]|matches[password]');

            //if form validate is true
            if($this->form_validation->run()==TRUE){
                echo 'form validated!';

                $data=array(
                    'firstname'=>$_POST['firstname'],
                    'lastname'=>$_POST['lastname'],
                    'department'=>$_POST['department'],
                    'username'=>$_POST['username'],
                    'password'=>$_POST['password'],
                    'email'=>$_POST['email'],
                    'mobile'=>$_POST['mobile']
                );

                $email=$_POST['email'];
                $username=$_POST['username'];

                $sql = "SELECT * FROM users WHERE email='$email'";
                $sql2 = "SELECT * FROM users WHERE username='$username'";

                $query = $this->db->query($sql); 
                $query2 = $this->db->query($sql2); 
                
                if ($query->num_rows() == 0 && $query2->num_rows() == 0) {
        
                    //add to database
                    $this->db->insert('users',$data);
                    $this->session->set_flashdata('success','Your account has been created successfull!');
                    redirect('auth/registration','refresh');
        
                }else{
                    $this->session->set_flashdata('error','Your email or username has already registered!');
                    redirect('auth/registration','refresh');
                }


                
            }
        }
        $this->load->view('registration');
    }
}