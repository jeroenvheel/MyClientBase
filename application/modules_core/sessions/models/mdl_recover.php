<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Recover extends MY_Model {

    function validate_recover() {

        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('username', $this->lang->line('username'), 'required');

        return parent::validate();

    }

    function recover_password($username) {

        $this->db->where('username', $username);

        $query = $this->db->get('mcb_users');

        if ($query->num_rows()) {

            $this->load->helper('mailer/phpmailer');
            $this->load->helper('text');

            $user = $query->row();

            if ($user->email_address) {

                $password = random_string();

                $this->db->where('user_id', $user->user_id);
                $this->db->set('password', md5($password));
                $this->db->update('mcb_users');

                $from = $user->email_address;
                $to = $user->email_address;
                $subject = $this->lang->line('password_recovery');
                $email_body = $this->lang->line('password_recovery_email') . ' ';
                $email_body .= $password . '<br />' . anchor(site_url(), $this->lang->line('password_recovery_email_2'));

                $this->mdl_mcb_data->set_session_data();

                phpmail_send($from, $to, $subject, $email_body);

            }

        }

    }

}

?>