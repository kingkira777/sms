                            <div class="pull-left">
                               <h1>Announcement</h1>
                            </div>
                            
                            <div class="pull-right">
                                <?php if($priv === "admin" || $priv === "teacher"){ ?>
                                <button type="button" class="btn btn-primary" data-toggle="tab" data-target="#auannouncement">
                                    <i class="fa fa-plus-square-o"></i> NEW ANNOUNCEMENT
                                </button>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                            <div id="announcement_content"></div>