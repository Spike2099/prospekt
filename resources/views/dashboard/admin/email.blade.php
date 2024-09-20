@php
    $imap = $email::imapOpen(config('app.e_pass'));
    //$unseen = imap_num_msg($imap); 
    $mails_id = imap_search($imap, 'ALL');    
@endphp

@extends('layout/main')
@section('title', 'Электронная почта')

@section('content')


<div class="row g-0 shadow-sm">
    <div class="overflow-auto col-lg-<?=isset($_GET['open']) ? '4' : '12'; ?>" style="height:61vh">
        <ul class="list-group shadow-sm">
        <?php
        foreach ($mails_id as $num) {
            $header = imap_headerinfo($imap, $num); //
        
            // Check if the 'subject' key exists in the $header array
            if (isset($header->subject)) {
                $subject = mb_decode_mimeheader($header->subject);
            } else {
                // Handle the case when 'subject' key is not present
                $subject = 'Default Subject'; // Provide a default value or handle it as per your requirements
            }
        
            //$body = imap_body($imap, $num);
            //$body = quoted_printable_decode($body);
            $body = imap_fetchstructure($imap, $num);
            $body = json_decode(json_encode($body), true);
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-start overflow-hidden <?=isset($_GET['open']) && $_GET['open'] == $num ? 'bg-danger-subtle' : '' ?>">
                    <div class="me-auto">
                        <div 
class="<?= isset($_GET['open']) ? 'w-75 d-block text-truncate' : ''; ?> <?= ($header->Unseen == "U") ? 'fw-bold' : ''; ?>"

                            <input type="checkbox" name="check" class="form-check-input" />
                            <a
                                href="?open=<?= $num; ?>"
                                class="text-dark text-decoration-none"
                                title="<?= isset($header->message_id) ? mb_decode_mimeheader($header->message_id) : 'No Subject' ?>"
                            >
                            
                               <?= isset($header->info->subject) ? mb_decode_mimeheader($header->info->subject) : 'No Subject' ?>
                            </a>
                        </div>
                        <span style="font-size: 12px">
                            От: 
                          <a href="mailto:{{ $header->from[0]->mailbox }}&#64;{{ $header->from[0]->host }}" target="_blank">
                             {{ mb_decode_mimeheader($header->fromaddress) }}
                            </a> 
                        <span>
                        <?=isset($_GET['open']) ? '<br />' : '&#160;/&#160;';?>
                       <small class="text-muted">{{ $timer::datatime($header->date) }}</small>
                        <?php //print_r($body);?>
                    </div>
                    <?php if (mb_strpos($subject, 'заявка') !== false) { ?>
                    <?php imap_setflag_full($imap, $num, '\\flagged'); ?>
                    <span class="material-symbols-outlined text-danger">bookmarks</span>
                    <?php } ?>
                    @if (isset($body['parts'][0]))
                        <span class="material-symbols-outlined">attach_file</span>
                    @endif
                </li>
        <?php } imap_close($imap); ?>
        </ul>
    </div>
    <div class="border rounded-end overflow-auto <?=isset($_GET['open']) ? 'col-lg-8' : 'd-none'; ?>" style="height:61vh">
        <?php
            $imap = $email::imapOpen(config('app.e_pass'));
            $id = isset($_GET['open']) ? $_GET['open'] : 1;
            $body = $email::getBody($id);
            //$bodyhtml = imap_body($imap, $mail); // 
            //$bodyhtml = quoted_printable_decode($bodyhtml);
            //$bodyhtml = imap_fetchstructure($imap, $mail, FT_UID);
            //$bodyhtml = json_decode(json_encode($bodyhtml), true);
            echo '<pre class="p-3 bg-white">'.$body.'</pre>';
            //print_r($bodyhtml);
            //imap_close($imap); 
        ?>
    </div>    
</div>
<pre><?php //var_dump($bodyhtml);?></pre>
@endsection