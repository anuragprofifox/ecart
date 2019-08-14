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
                ),
                'submitquery' => array(
                        array(
                                'field' => 'name',
                                'label' => 'Name',
                                'rules' => 'required|min_length[3]'
                        ),
                        array(
                                'field' => 'contact_number',
                                'label' => 'Contact number',
                                'rules' => 'required|max_length[10]'
                        ),
                        array(
                                'field' => 'subject',
                                'label' => 'Subject',
                                'rules' => 'required|min_length[3]'
                        ),
                        array(
                                'field' => 'message',
                                'label' => 'Message',
                                'rules' => 'required|min_length[10]'
                        )
                )
);

?>