<?php
$config = array(
        'login' => array(
                array(
                        'field' => 'email_address',
                        'label' => 'Email',
                        'rules' => 'required|valid_email'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|min_length[4]'
                )
        ),
        'signup' => array(
                array(
                        'field' => 'username',
                        'label' => 'username',
                        'rules' => 'required|min_length[4]'
                ),
                array(
                        'field' => 'email_address',
                        'label' => 'Email',
                        'rules' => 'required|valid_email|is_unique[user.email_address]'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|min_length[4]'
                ),
                array(
                        'field' => 'cfmpassword',
                        'label' => 'Password confirmation',
                        'rules' => 'required|min_length[4]'
                )
        ),
        'addproduct' => array(
                array(
                        'field' => 'title',
                        'label' => 'title',
                        'rules' => 'required|min_length[3]'
                ),
                array(
                        'field' => 'category',
                        'label' => 'category',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'quantity',
                        'label' => 'quantity',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'price',
                        'label' => 'price',
                        'rules' => 'required'
                )
        )
);

?>