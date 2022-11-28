<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php                   foreach($data as $details){    
                        $create = date('m-d-Y', strtotime($details['created_at']));                     
?>                        <div class="row">
                            <div class="col-auto text-center flex-column d-none d-sm-flex">
                                <div class="row h-50">
                                    <div class="col">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                </div>
                                <h5 class="m-2">
                                    <span class="<?=($details['app_step'] === $details['time_step']? 'badge rounded-circle bg-primary border-primary' : 'badge rounded-circle bg-light border')?>">&nbsp;</span>
                                </h5>
                                <div class="row h-50">
                                    <div class="col border-end">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col py-2">
                                <div class="<?=($details['app_step'] === $details['time_step']? 'card-body border-primary shadow' : 'card-body border')?>">
                                    <div class="float-end"><?=$create?></div>
                                    <h4 class="card-title text-muted"><?=$details['title']?></h4>
                                    <p class="card-text text-muted"><?=$details['description']?></p>
                                </div>
                            </div>
                            <?php var_dump($data) ?>
                        </div>
<?php                   }
?>                   