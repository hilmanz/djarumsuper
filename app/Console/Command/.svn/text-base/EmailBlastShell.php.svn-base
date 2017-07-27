<?php
App::uses('CakeEmail', 'Network/Email');
class EmailBlastShell extends AppShell{
	var $uses = array('Blast','Subscribe');
    var $Email= null;
	public function main(){
        $rs = $this->Blast->query("SELECT * FROM email_blasts 
                                    WHERE n_status = 0 OR n_status =1 
                                    ORDER BY id ASC LIMIT 1");
        
        $this->send_emails($rs[0]);
    }
    private function send_emails($message){
       

        $keep_sending = true;
        $start = 0;
        $limit = 10;
        while($keep_sending){
            $emails = $this->getSubscribers($start,$limit);
            if(sizeof($emails)>0){
                $this->blast_email($emails,$message);
                $start+=$limit;
                sleep(rand(1,5));//sleep for 1 to 5 seconds
            }else{
                $keep_sending = false;
                $this->out('Finished');
                break;
            }
        }
       
    }
    private function blast_email($emails,$message){
         $this->initEmail();
       
         foreach($emails as $email){
            $content = $message['email_blasts']['plain_text'];
            $content = str_replace("%name%",$email['Login']['name'],$content);
            $html_content = $message['email_blasts']['html_content'];
            $html_content = str_replace("%name%",$email['Login']['name'],$html_content);
            $this->Email->template('default', 'default');
            $this->Email->viewVars(array('plain_text'=>$content,
                                        'html_content'=>$html_content));
            $this->Email->from(array('dufronte@gmail.com' => 'Hapsoro Renaldy'))
                    ->to($email['Subscribe']['email'])
                    ->emailFormat('both')
                    ->subject($message['email_blasts']['subject'])
                    ->send();

            $this->out('Sending to '.$email['Subscribe']['email']);
        }
    }
    private function initEmail(){
        if($this->Email==null){
            $this->Email = new CakeEmail('smtp');    
        }
       
    }
    private function getSubscribers($start=0,$limit=10){
        $emails = $this->Subscribe->find('all',array(
                'offset'=>$start,
                'limit'=>$limit
            ));
        return $emails;
    }
}
?>