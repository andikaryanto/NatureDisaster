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
            <h1 class="h3 display"><i class="fa fa-fire"></i><?php echo $resource['res_master_familycard']?></h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
									<div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_add_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="<?php echo base_url('mfamilycard');?>"><i class="fa fa-table"></i> Index</a></div>
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
                 
                  <form method = "post" action = "<?php echo base_url('mfamilycard/addsave');?>">
                    <div class="form-group ">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_cardno']?></label>
                          <input id="cardno" type="text" placeholder="<?php echo $resource['res_cardno']?>" class="form-control" name = "cardno" value="<?php echo $model['cardno']?>" required>
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_headfamilyname']?></label>
                          <input id="headfamilyname" type="text" placeholder="<?php echo $resource['res_headfamilyname']?>" class="form-control" name = "headfamilyname" value="<?php echo $model['headfamilyname']?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_village']?></label>
                          <div class="input-group">
                            <input hidden="true" id = "villageid" type="text" class="form-control" name = "villageid" value="<?php echo $model['villageid']?>">
                            <input readonly id = "villagename" placeholder="<?php echo $resource['res_village']?>" type="text" class="form-control"  value="<?php echo $model['villagename']?>">
                            <div class="input-group-append">
                              <button id="btnVillageModal" data-toggle="modal" type="button" class="btn btn-primary" onclick="getModalVillage(1);" data-target="#modalVillage"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <label><?php echo $resource['res_address']?></label>
                          <input id="address" type="text" placeholder="<?php echo $resource['res_address']?>" class="form-control" name = "address" value="<?php echo $model['address']?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">     
                      <div class="row">
                          <div class="col">  
                            <label>RT</label>
                            <input id="rt" type="text" placeholder="RT" class="form-control" name = "rt" value="<?php echo $model['rt']?>" >
                          </div>
                          <div class="col">  
                            <label>RW</label>
                            <input id="rw" type="text" placeholder="RW" class="form-control" name = "rw" value="<?php echo $model['rw']?>">
                          </div>
                      </div>
                    </div>
                    
                    <div class="form-group">     
                      <div class="row">
                          <div class="col">  
                            <label><?php echo $resource['res_postcode']?></label>
                            <input id="postcode" type="text" placeholder="<?php echo $resource['res_postcode']?>" class="form-control" name = "postcode" value="<?php echo $model['postcode']?>" >
                          </div>
                          <div class="col">  
                          </div>
                      </div>
                      
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
<div id="modalVillage" tabindex="-1" role="dialog" aria-labelledby="modalVillageLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modalVillageLabel" class="modal-title">Village</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div id = "cardModalBody" class="card-body">
        <div class="form-group row">
          <div class="col-sm-12">
            <div class="form-group">
              <div class="input-group">
                <input id = "searchInput" type="text" class="form-control" >
                <div class="input-group-append">
                  <button id = "searchbutton" type="button" class="btn btn-primary" onclick = "getModalVillage(1);">Search</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table id = "tblVillageLookUp" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Village </th>
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

  function getModalVillage(page)
  {
    removeModalVillageComponent();
    var search = $('#searchInput').val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('m_village/villagemodal')?>",
      data:{
            page: page,
            search : search
          },
      success:function(data){
        var village = $.parseJSON(data);
        console.log(village);
        var detail = village['m_village']['modeldetailmodal'];
        for(var i = 0; i < detail.length; i++)
        {
          $("#tblVillageLookUp").append("<tr onclick='chooseVillageName("+detail[i].Id+","+'"'+detail[i].Name+'"'+");'> "+
                                      "<td>" + detail[i].Name + "</td>"+
                                      "<td>" + detail[i].SubcityName + "</td>"+
                                      "<td>" + detail[i].CityName + "</td>"+
                                      "<td>" + detail[i].ProvinceName + "</td>"+
                                      "</tr>");
        }

        var previous = "";
        var pages = "";
        var next = "";
        var append = "";
        if(village['m_village']['currentpagemodal'] > 3)
        {
          previous += "<li class='page-item'>";
          previous += "<a class='page-link' href='#' onclick = 'getModalVillage("+(village['m_village']['currentpagemodal']-1)+")' aria-label='Previous'>";
          previous += "<span aria-hidden='true'>&laquo;</span>";
          previous += "<span class='sr-only'>Previous</span>";
          previous += "</a>" ;
          previous += "</li>";
        }

        for (var i = village['m_village']['firstpagemodal'] ; i <= village['m_village']['lastpagemodal']; i++){
          pages += " <li class='page-item' >";
          pages += "<a class='page-link' href='#' onclick = 'getModalVillage("+i+")'>"+i+"</a>";
          pages += "</li>";
        }

        if(village['m_village']['currentpagemodal'] < village['m_village']['totalpagemodal'] - 2)
        {
          next += "<li class='page-item'>";
          next += "<a class='page-link' href='#' onclick = 'getModalVillage("+(1+village['m_village']['currentpagemodal'])+")' aria-label='Next'>";
          next += "<span aria-hidden='true'>&raquo;</span>";
          next += "<span class='sr-only'>Next</span>";
          next += "</a>" ;
          next += "</li>";
        }

        append += "<div id = 'modalVillagePaging' class='row'>";
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
        append +="Total Data : "+village['m_village']['totalrowmodal'];
        append += "</div>";
        append += "</div>";
        
        $("#cardModalBody").append(append);

      }
    });
  };

  function chooseVillageName(Id, Name)
  {
    $("#villageid").val(Id);
    $("#villagename").val(Name);
    $('#modalVillage').modal('hide');
  };

  $("#modalVillage").on('hidden.bs.modal', function(){
    removeModalVillageComponent();
  });

  function removeModalVillageComponent()
  {
    $("#tblVillageLookUp").find("tr:gt(0)").remove();
    $("#modalVillagePaging").remove();
  };
</script>