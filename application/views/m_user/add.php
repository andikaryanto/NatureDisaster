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
            <h1 class="h3 display"><i class="fa fa-fire"></i><?php echo $resource['res_master_user']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_add_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('muser');?>"><i class="fa fa-table"></i> Index</a></div>
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
                 
                  <form method = "post" action = "<?php echo base_url('muser/addsave');?>">
                    <div class="form-group">
                      <label><?php echo $resource['res_name']?></label>
                      <input id="named" type="text" placeholder="<?php echo $resource['res_name']?>" class="form-control" name = "named" value="<?php echo $model['username']?>" required>
                    </div>
                    <div class="form-group">
                      <label><?php echo $resource['res_group_user']?></label>
                      <div class="input-group">
                        <input hidden="true" id = "groupid" type="text" class="form-control" name = "groupid" value="<?php echo $model['groupid']?>">
                        <input readonly id = "groupname" placeholder="<?php echo $resource['res_group_user']?>" type="text" class="form-control"  value="<?php echo $model['groupname']?>">
                        <div class="input-group-append">
                          <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" onclick="getModalGroup(1);" data-target="#modalGroupUser"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">       
                      <label><?php echo $resource['res_password']?></label>
                      <input id="password" type="password" placeholder="<?php echo $resource['res_password']?>" class="form-control" name = "password" value="<?php echo $model['password']?>">
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

<!-- modal -->
<div id="modalGroupUser" tabindex="-1" role="dialog" aria-labelledby="groupUserModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="groupUserModalLabel" class="modal-title">Group User</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div id = "cardModalBody" class="card-body">
        <div class="form-group row">
          <div class="col-sm-12">
            <div class="form-group">
              <div class="input-group">
                <input id = "searchInput" type="text" class="form-control" >
                <div class="input-group-append">
                  <button id = "searchbutton" type="button" class="btn btn-primary" onclick = "getModalGroup(1);">Search</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table id = "tblGroupUserLookUp" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Group </th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<script type = "text/javascript">

  function getModalGroup(page)
  {
    removeModalGroupUserComponent();
    var search = $('#searchInput').val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('G_groupuser/groupusermodal')?>",
      data:{
            page: page,
            search : search
          },
      success:function(data){
        var groupuser = $.parseJSON(data);
        console.log(groupuser);
        setResourceModalGroupUser(groupuser['g_groupuser']['resourcemodal']);

        var detail = groupuser['g_groupuser']['modeldetailmodal'];
        for(var i = 0; i < detail.length; i++)
        {
          $("#tblGroupUserLookUp").append("<tr onclick='chooseGroupName("+detail[i].Id+","+'"'+detail[i].GroupName+'"'+");'><td>" + detail[i].GroupName + "</td></tr>");
        }

        var previous = "";
        var pages = "";
        var next = "";
        var append = "";
        if(groupuser['g_groupuser']['currentpagemodal'] > 3)
        {
          previous += "<li class='page-item'>";
          previous += "<a class='page-link' href='#' onclick = 'getModalGroup("+(groupuser['g_groupuser']['currentpagemodal']-1)+")' aria-label='Previous'>";
          previous += "<span aria-hidden='true'>&laquo;</span>";
          previous += "<span class='sr-only'>Previous</span>";
          previous += "</a>" ;
          previous += "</li>";
        }

        for (var i = groupuser['g_groupuser']['firstpagemodal'] ; i <= groupuser['g_groupuser']['lastpagemodal']; i++){
          pages += " <li class='page-item' >";
          pages += "<a class='page-link' href='#' onclick = 'getModalGroup("+i+")'>"+i+"</a>";
          pages += "</li>";
        }

        if(groupuser['g_groupuser']['currentpagemodal'] < groupuser['g_groupuser']['totalpagemodal'] - 2)
        {
          next += "<li class='page-item'>";
          next += "<a class='page-link' href='#' onclick = 'getModalGroup("+(1+groupuser['g_groupuser']['currentpagemodal'])+")' aria-label='Next'>";
          next += "<span aria-hidden='true'>&raquo;</span>";
          next += "<span class='sr-only'>Next</span>";
          next += "</a>" ;
          next += "</li>";
        }

        append += "<div id = 'modalGroupUserPaging' class='row'>";
        append += "<div class = 'col-lg-6'>";
        append += "<nav aria-label='Page navigation example'>";
        append += "<ul class='pagination'>";
        append += previous;
        append += pages;
        append += next;
        append += "</ul>";
        append += "</nav>";
        append += "</div>";
        append += "<div class = 'col-lg-6 icon-custom-table-header'>";
        append +="Total Data : "+groupuser['g_groupuser']['totalrowmodal'];
        append += "</div>";
        append += "</div>";
        
        $("#cardModalBody").append(append);
      }
    });
  };

  function chooseGroupName(Id, Name)
  {
    $("#groupid").val(Id);
    $("#groupname").val(Name);
    $('#modalGroupUser').modal('hide');
  }

  $("#modalGroupUser").on('hidden.bs.modal', function(){
    removeModalGroupUserComponent();
  });

  function removeModalGroupUserComponent()
  {
    $("#tblGroupUserLookUp").find("tr:gt(0)").remove();
    $("#modalGroupUserPaging").remove();
  }

  function setResourceModalGroupUser(resource)
  {
    $("#searchbutton").innerHtml = resource['res_search'];
    $("#groupUserModalLabel").text = resource['res_groupuser'];
  }
</script>