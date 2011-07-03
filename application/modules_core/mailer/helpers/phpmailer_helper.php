<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function phpmail_send($from, $to, $subject, $message, $attachment_path = NULL, $cc = NULL, $bcc = NULL) {

    require_once(APPPATH . 'modules_core/mailer/helpers/phpmailer/class.phpmailer.php');

    $CI =& get_instance();

    $mail = new PHPMailer();

    $mail->CharSet = 'UTF-8';

    $mail->IsHtml();

    if ($CI->mdl_mcb_data->setting('email_protocol') == 'smtp') {

        $mail->IsSMTP();

        $mail->SMTPAuth = true;

        if ($CI->mdl_mcb_data->setting('smtp_security')) {

            $mail->SMTPSecure = $CI->mdl_mcb_data->setting('smtp_security');

        }

        $mail->Host = $CI->mdl_mcb_data->setting('smtp_host');

        $mail->Port = $CI->mdl_mcb_data->setting('smtp_port');

        $mail->Username = $CI->mdl_mcb_data->setting('smtp_user');

        $mail->Password = $CI->mdl_mcb_data->setting('smtp_pass');

    }

    elseif ($CI->mdl_mcb_data->setting('email_protocol') == 'sendmail') {

        $mail->IsSendmail();

    }

    if (is_array($from)) {

        $mail->SetFrom($from[0], $from[1]);

    }

    else {

        $mail->SetFrom($from);

    }

    $mail->Subject = $subject;

    $mail->Body = $message;

    $to = (strpos($to, ',')) ? explode(',', $to) : explode(';', $to);

    foreach ($to as $address) {

        $mail->AddAddress($address);

    }

    if ($cc) {

        $cc = (strpos($cc, ',')) ? explode(',', $cc) : explode(';', $cc);

        foreach ($cc as $address) {

            $mail->AddCC($address);

        }

    }

    if ($bcc) {

        $bcc = (strpos($bcc, ',')) ? explode(',', $bcc) : explode(';', $bcc);

        foreach ($bcc as $address) {

            $mail->AddBCC($address);

        }

    }

    if ($attachment_path) {

        $mail->AddAttachment($attachment_path);

    }

    if ($mail->Send()) {

        if (isset($CI->load->_ci_classes['session'])) {

            $CI->session->set_flashdata('custom_success', $CI->lang->line('email_success'));

            return TRUE;

        }

    }

    else {

        if (isset($CI->this->load->_ci_classes['session'])) {

            $CI->session->set_flashdata('custom_error', $mail->ErrorInfo);

            return FALSE;

        }

    }

}

?>