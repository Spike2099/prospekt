<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
//$password, $inbox = '{imap.beget.com:993/imap/ssl}INBOX', $email = 'info@prospekt-parts.com'
    public static function imapOpen($password, $inbox = '{imap.beget.com:993/imap/ssl}INBOX', $email = 'info@prospekt-parts.com')
    {
        $imap = imap_open($inbox, $email, $password);
        return $imap;
    }

    public static function getCount()
    {
        try {
            $imap = self::imapOpen(config('app.e_pass'));
            $new = imap_search($imap, 'UNSEEN', SE_UID);             
            return $new === 0 || $new === null ? '' : count((array)$new);
        } catch (Exception $e) {
            return '';
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public static function structure_encoding($encoding, $msg_body)
    { 
        switch((int) $encoding)
        { 
            case 4: $body = imap_qprint($msg_body); 
                break; 
            case 3: $body = imap_base64($msg_body); 
                break; 
            case 2: $body = imap_binary($msg_body); 
                break; 
            case 1: $body = imap_8bit($msg_body); 
                break; 
            case 0: $body = $msg_body; 
                break; 
            default: 
                $body = '';
        } 
        return $body; 
    }

    public static function getBody($id)
    {
        $imap = self::imapOpen(config('app.e_pass'));
        $email = imap_search($imap, 'ALL', OP_READONLY);
        
        $message = 1;
        //foreach($email as $mail) {
            $structure = imap_fetchstructure($imap, $id);
            if (isset($structure->parts[1])) {
                $part = $structure->parts[1];
                //return $part->encoding;
                $message = imap_fetchbody($imap, $id, 1);
                if(strpos($message,"<html") !== false) {
                    $message = trim(utf8_encode(quoted_printable_decode($message)));
                }
                else if ($part->encoding == 3) {
                    $message = imap_base64($message);
                }
                else if($part->encoding == 2) {
                    $message = imap_binary($message);
                }
                else if($part->encoding == 1) {
                    $message = imap_8bit($message);
                }
                else if($part->encoding == 4) {
                    $message = imap_qprint(quoted_printable_decode($message));
                }
                else {
                    $message = trim(utf8_encode(quoted_printable_decode(imap_qprint($message))));
                }

                //return $message; //  = $part->encoding
            }
        //}
        return $message; imap_close($imap);
    }

}
