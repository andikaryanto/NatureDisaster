    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
            <li class="breadcrumb-item active">Master       </li>
          </ul>
        </div>
    </div>
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display"><i class="fa fa-fire"></i><?php echo $resource['res_master_province']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_add_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('mprovince');?>"><i class="fa fa-table"></i> Index</a></div>
                  </div>
                </div>
                <div class="card-body">
                  <?php if($this->session->flashdata('warning_msg'))
                    {
                        $msg = $this->session->flashdata('warning_msg');
                        for($i=0 ; $i<count($msg); $i++)
                        {
                  ?>
                          <p class="text-danger"><?php echo $msg[$i]; ?></p>
                  <?php 
                        }
                    }
                  ?>
                    <!-- <p class="text-danger"><?php echo $this->session->flashdata('warning_msg_name_exist'); ?></p> -->
                 
                  <form method = "post" action = "<?php echo base_url('mprovince/addsave');?>">
                    <div class="form-group">
                      <label><?php echo $resource['res_name']?></label>
                      <input id="named" type="text" placeholder="<?php echo $resource['res_name']?>" class="form-control" name = "named" value="<?php echo $model['name']?>" required>
                    </div>
                    <div class="form-group">       
                      <label><?php echo $resource['res_description']?></label>
                      <textarea id="description" type="text" placeholder="<?php echo $resource['res_description']?>" class="form-control" name = "description" ><?php echo $model['description']?></textarea>
                    </div>
                    <div class="form-group">       
                      <input type="submit" value="<?php echo $resource['res_save']?>" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>