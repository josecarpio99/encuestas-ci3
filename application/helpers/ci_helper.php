<?php

function setSessionData()
{
  $CI =& get_instance();
  if(!@$CI->session->userdata('logged_user_admin')) {
    $userData['logged_user_admin'] = $CI->db->get_where('adm_usuarios', ['idUsuario' => 81])->row();
    $CI->session->set_userdata($userData);
  }
}

function redirectIsNoLoggedIn()
{
  $CI =& get_instance();
  if(!$CI->session->userdata('logged_user_admin')->email) redirect ('Form/login');
}

function isAdmin()
{
  $CI =& get_instance();
  return $CI ->session->userdata('logged_user_admin')->perfil == 2;
}

function dd($input) {
  echo '<pre>';
	var_dump($input);
	die;
}