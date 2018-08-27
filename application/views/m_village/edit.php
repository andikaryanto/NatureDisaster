    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Master       </li>
          </ul>
        </div>
    </div>
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display"><i class="fa fa-fire"></i><?php echo $resource['res_master_village']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_edit_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('mvillage');?>"><i class="fa fa-table"></i> Index</a></div>
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
                  <form method = "post" action = "<?php echo base_url('mvillage/editsave');?>">

                    <input hidden = "true" name="idvillage" value="<?php echo $model['id']?>"/> 

                    <div class="form-group">
                      <label><?php echo $resource['res_name']?></label>
                      <input hidden="true" id = "villageid" type="text" class="form-control" name = "villageid" value="<?php echo $model['id']?>">
                      <input id="named" type="text" placeholder="<?php echo $resource['res_name']?>" class="form-control" name = "named" value="<?php echo $model['name']?>" required>
                    </div>
                    <div class="form-group">
                      <label><?php echo $resource['res_subcity']?></label>
                      <div class="input-group">
                        <input hidden="true" id = "subcityid" type="text" class="form-control" name = "subcityid" value="<?php echo $model['subcityid']?>">
                        <input readonly id = "subcityname" placeholder="<?php echo $resource['res_subcity']?>" type="text" class="form-control"  name ="subcityname" value="<?php echo $model['subcityname']?>">
                        <div class="input-group-append">
                          <button id="btnSubcityModal" data-toggle="modal" type="button" class="btn btn-primary" onclick="getModalSubcity(1);" data-target="#modalSubcity"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">       
                      <label><?php echo $resource['res_description']?></label>
                      <input id="description" type="description" placeholder="<?php echo $resource['res_description']?>" class="form-control" name = "description" value = "<?php echo $model['description']?>">
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
<div id="modalSubcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Sub City</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div id = "cardModalBody" class="card-body">
        <div class="form-group row">
          <div class="col-sm-12">
            <div class="form-group">
              <div class="input-group">
                <input id = "searchInput" type="text" class="form-control" >
                <div class="input-group-append">
                  <button id = "searchbutton" type="button" class="btn btn-primary" onclick = "getModalSubcity(1);">Search</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table id = "tblSubcityLookUp" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Sub City </th>
                <th>City </th>
                <th>Province </th>
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
  function getModalSubcity(page)
  {
    removeModalSubcityComponent();
    var search = $('#searchInput').val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('m_subcity/subcitymodal')?>",
      data:{
            page: page,
            search : search
          },
      success:function(data){
        var subcity = $.parseJSON(data);
        console.log(subcity);
        var detail = subcity['m_subcity']['modeldetailmodal'];
        for(var i = 0; i < detail.length; i++)
        {
          $("#tblSubcityLookUp").append("<tr onclick='chooseSubcityName("+detail[i].Id+","+'"'+detail[i].Name+'"'+");'> "+
                                      "<td>" + detail[i].Name + "</td>"+
                                      "<td>" + detail[i].CityName + "</td>"+
                                      "<td>" + detail[i].ProvinceName + "</td>"+
                                      "</tr>");
        }

        var previous = "";
        var pages = "";
        var next = "";
        var append = "";
        if(subcity['m_subcity']['currentpagemodal'] > 3)
        {
          previous += "<li class='page-item'>";
          previous += "<a class='page-link' href='#' onclick = 'getModalSubcity("+(subcity['m_subcity']['currentpagemodal']-1)+")' aria-label='Previous'>";
          previous += "<span aria-hidden='true'>&laquo;</span>";
          previous += "<span class='sr-only'>Previous</span>";
          previous += "</a>" ;
          previous += "</li>";
        }

        for (var i = subcity['m_subcity']['firstpagemodal'] ; i <= subcity['m_subcity']['lastpagemodal']; i++){
          pages += " <li class='page-item' >";
          pages += "<a class='page-link' href='#' onclick = 'getModalSubcity("+i+")'>"+i+"</a>";
          pages += "</li>";
        }

        if(subcity['m_subcity']['currentpagemodal'] < subcity['m_subcity']['totalpagemodal'] - 2)
        {
          next += "<li class='page-item'>";
          next += "<a class='page-link' href='#' onclick = 'getModalSubcity("+(1+subcity['m_subcity']['currentpagemodal'])+")' aria-label='Next'>";
          next += "<span aria-hidden='true'>&raquo;</span>";
          next += "<span class='sr-only'>Next</span>";
          next += "</a>" ;
          next += "</li>";
        }

        append += "<div id = 'modalSubcityPaging' class='row'>";
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
        append +="Total Data : "+subcity['m_subcity']['totalrowmodal'];
        append += "</div>";
        append += "</div>";
        
        $("#cardModalBody").append(append);

      }
    });
  };

  function chooseSubcityName(Id, Name)
  {
    $("#subcityid").val(Id);
    $("#subcityname").val(Name);
    $('#modalSubcity').modal('hide');
  };

  $("#modalSubcity").on('hidden.bs.modal', function(){
    removeModalSubcityComponent();
  });

  function removeModalSubcityComponent()
  {
    $("#tblSubcityLookUp").find("tr:gt(0)").remove();
    $("#modalSubcityPaging").remove();
  };
</script>