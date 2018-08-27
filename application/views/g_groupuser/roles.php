			<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
            <li class="breadcrumb-item active">User</li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display"><i class="fa fa-user"></i> <?php echo $resource['res_master_groupuser']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div id = "cardtabel" class="card">
                <div class="card-header ">
                  <div class="row">
                    <div class = "col-lg-4">
                        <h4>Group : <?php echo  $modelheader->GroupName?></h4>
                    </div>
                    <div class = "col-lg-8 icon-custom-table-header">
                        <a id = "btnSave" class = "icon-custom-table-detail" href="#"><i class="fa fa-save"></i> <?php echo $resource['res_save']?></a>
                        <a class = "icon-custom-table-detail" href="<?php echo base_url('ggroupuser');?>"><i class="fa fa-table"></i> Index</a>
                    </div>
                  </div>
								</div>
                <div class="card-body">
                  <div class="table-responsive">
                      <table id = "tblRole" class="table table-striped table-hover">
                          <thead>
                              <tr>
                              <th><?php echo  $resource['res_module']?></th>
                              <th>Alias</th>
                              <th><?php echo  $resource['res_read']?></th>
                              <th><?php echo  $resource['res_write']?></th>
                              <th><?php echo  $resource['res_delete']?></th>
                              <th><?php echo  $resource['res_print']?></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                  $i = 1;
                                  foreach ($modeldetail as $value)
                                  {
                              ?>
                              <tr>
                                  <td id = "td<?php echo $i ?>formid" hidden = "true"><?php echo $value->FormId?></td>
                                  <td id = "td<?php echo $i ?>aliasname"><?php echo $value->AliasName?></td>
                                  <td id = "td<?php echo $i ?>localname"><?php echo $value->LocalName?></td>
                                  <td id = "td<?php echo $i ?>tdread">
                                    <input id = "td<?php echo $i ?>read" type="checkbox" <?php if($value->Readd == 1)
                                                                {
                                                            ?>
                                                                checked=""
                                                            <?php
                                                                }
                                                            ?>>
                                  </td>
                                  <td id = "td<?php echo $i ?>tdwrite">
                                    <input id = "td<?php echo $i ?>write" type="checkbox" <?php if($value->Writee == 1)
                                                                {
                                                            ?>
                                                                checked=""
                                                            <?php
                                                                }
                                                            ?>>
                                  </td>
                                  
                                  <td id = "td<?php echo $i ?>tddelete">
                                    <input id = "td<?php echo $i ?>delete" type="checkbox" <?php if($value->Deletee == 1)
                                                                {
                                                            ?>
                                                                checked=""
                                                            <?php
                                                                }
                                                            ?>>
                                  </td>
                                  <td id = "td<?php echo $i ?>tdprint">
                                    <input id ="td<?php echo $i ?>print" type="checkbox" <?php if($value->Printt == 1)
                                                                {
                                                            ?>
                                                                checked=""
                                                            <?php
                                                                }
                                                            ?>>
                                  </td>
                              </tr>
                              <?php
                                  
                                  $i++;
                                  }
                              ?>
                          </tbody>
                      </table>
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
    alert(search);
    //window.location =" <?php echo base_url('g_groupuser');?>?search="+search;
  });

  $("#btnSave").on("click",function() {
    var oTable = document.getElementById('tblRole');
    var i;
    var rowLength = oTable.rows.length;
    //alert(rowLength);
    for (i = 1; i < rowLength; i++) {
      // alert(document.getElementById("td"+i+"formid").innerHTML);
      // alert(document.getElementById("td"+i+"aliasname").innerHTML);
      // alert($("#td"+i+"read").is(":checked") == true ? 1 : 0);
      // alert($("#td"+i+"write").is(":checked") == true ? 1 : 0);
      $.ajax({
        type:"POST",
        url:"<?php echo base_url('G_groupuser/saverole')?>",
        data:{
              groupid: <?php echo $modelheader->Id?>,
              formid : document.getElementById("td"+i+"formid").innerHTML,
              read : $("#td"+i+"read").is(":checked") == true ? 1 : 0,
              write : $("#td"+i+"write").is(":checked") == true ? 1 : 0,
              delete : $("#td"+i+"delete").is(":checked") == true ? 1 : 0,
              print : $("#td"+i+"print").is(":checked") == true ? 1 : 0
            },
        success:function(data){
            //alert(data + "saved");
        }
      });
      
    }
  });
</script>
      