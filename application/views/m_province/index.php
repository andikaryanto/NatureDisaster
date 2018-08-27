			<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
            <li class="breadcrumb-item active">Master</li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display"><i class="fa fa-fire"></i><?php echo $resource['res_master_province']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div id = "cardtabel" class="card">
                <div class="card-header ">
									<div class="row">
										<div class = "col-lg-10">
											<h4><?php echo  $resource['res_data']?></h4>
										</div>
										<div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('mprovince/add');?>"><i class="fa fa-plus"></i> <?php echo $resource['res_add']?></a></div>
									</div>
								</div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <div class="input-group">
                          <input id = "search" type="text" class="form-control" value = "<?php echo $search?>">
                          <div class="input-group-append">
                            <button id = "searchbutton" type="button" class="btn btn-primary"><?php echo $resource['res_search']?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th><?php echo  $resource['res_name']?></th>
                          <th><?php echo  $resource['res_description']?></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
											<?php
												foreach ($modeldetail as $value)
												{
											?>
													<tr>
														<td><?php echo $value->Name?></td>
														<td><?php echo $value->Description?></td>
														<td class = "icon-custom-table-header">
															<a class = "icon-custom-table-detail" href="<?php echo base_url('mprovince/edit/').$value->Id;?>"><i class="fa fa-edit"></i><?php echo  $resource['res_edit']?></a>
															<a class = "icon-custom-table-detail" href="javascript:void(0);" onclick="delete_province('<?php echo $value->Id?>','<?php echo $value->Name?>')"><i class="fa fa-trash"></i><?php echo  $resource['res_delete']?></a>
														</td>
													</tr>
											<?php
												}
											?>
                      </tbody>
                    </table>
                  </div>
									<div class="row">
                    <div class = "col-lg-10 ">
                      <nav aria-label="Page navigation example ">
                        <ul class="pagination">
                          
                          <?php if($currentpage > 3)
                          {
                          ?>
                          <li class="page-item">
                            <a class="page-link" href="<?php echo base_url('m_province');?>?page=<?php echo $currentpage-1?>&search=<?php echo $search?>#cardtabel" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Previous</span>
                            </a>
                          </li>
                          <?php
                          }
                          ?>
                          <?php for ($i = $firstpage ; $i <= $lastpage; $i++)
                          {
                          ?>
                          <li class="page-item">
                            <a class="page-link" href="<?php echo base_url('m_province');?>?page=<?php echo $i?>&search=<?php echo $search?>#cardtabel"><?php echo $i?></a>
                          </li>
                          <?php
                          }
                          ?>
                          <?php if($currentpage < $totalpage - 2)
                          {
                          ?>
                          <li class="page-item">
                            <a class="page-link" href="<?php echo base_url('m_province');?>?page=<?php echo $currentpage+1?>&search=<?php echo $search?>#cardtabel" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Next</span>
                            </a>
                          </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </nav>
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header">
                      Total Data : <?php echo $totalrow?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

<script type = "text/javascript">
  $("#searchbutton").on("click",function() {
    var search = $("#search").val();
    //alert(search);
    window.location =" <?php echo base_url('m_province');?>?search="+search;
  })   

  function delete_province(id, name){
    var r=confirm("Do you want to delete "+name+" ?");
    if (r==true)
      window.location = "<?php echo base_url('mprovince/delete/');?>" + id;
    else
      return false;
  } 
</script>
      