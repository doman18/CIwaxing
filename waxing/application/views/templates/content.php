<?php
$this->load->view('templates/header');
echo '<div id="body">';
if ($this->session->flashdata('warning') ) {
	echo '<div id="warning_msg">Uwaga! '.$this->session->flashdata('warning').'</div>';;
}
if ($this->session->flashdata('success')) {
	echo '<div id="success_msg">Sukces! '.$this->session->flashdata('success').'</div>';;
}
if ($this->session->flashdata('error')) {
	echo '<div id="error_msg">Niepowodzenie! '.$this->session->flashdata('error').'</div>';;
}
$this->load->view($view);
echo '</div>';
$this->load->view('templates/sidebar');
$this->load->view('templates/footer');


?>