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
                 
                  <form method = "post" action = "<?php echo base_url('mfamilycard/editsave');?>">
                    <div class="form-group ">
                      <div class="row">
                        <div class="col">
                          <label><?php echo $resource['res_cardno']?></label>
                          <input hidden id="familycardid" name = "familycardid" value="<?php echo $model['id']?>" required>
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
                            <input readonly id = "villagename" placeholder="<?php echo $resource['res_village']?>" type="text" class="form-control" name = "villagename"  value="<?php echo $model['villagename']?>">
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
      </section>
      <section class="forms" id = "memberSection">
      
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_detail_data']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="#" data-toggle="collapse" data-target="#collapseMember"><i class="fa fa-plus"></i></a></div>
                  </div>
                </div>
                <div class="card-body collapse" id = "collapseMember">
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
                  
                  <div class="form-group ">
                    <div class="row">
                      <div class="col">
                        <input hidden id = "detailid" value="">
                        <label><?php echo $resource['res_name']?></label>
                        <input id="name" type="text" placeholder="<?php echo $resource['res_name']?>" class="form-control" name = "name" value="" required>
                      </div>
                      <div class="col">
                        <label>NIK</label>
                        <input id="nik" type="text" placeholder="NIK" class="form-control" name = "nik" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label><?php echo $resource['res_gender']?></label>
                        <select id="gender" name="gender" class="form-control">
                        <?php 	
                        foreach ($enums['genderenum'] as $value)
                        { 
                        ?>
                          <option value ="<?php echo $value->Value?>"><?php echo $resource[$value->Resource]?></option>
                        <?php 
                        }
                        ?>
                        </select>
                      </div>
                      <div class="col">
                        <label><?php echo $resource['res_dateofbirth']?></label>
                        <!-- <input id="dateofbirth" type="text" placeholder="<?php echo $resource['res_dateofbirth']?>" class="form-control" name = "dateofborth" value=""> -->
                        <div class="input-group date"  id = "dateBirth">
                          <input id = "dateofbirth" data-date-format="dd-mm-yyyy" readonly placeholder="<?php echo $resource['res_dateofbirth']?>" type="text" class="form-control" name = "dateofbirth">
                          <!-- <div class="input-group-append">
                            <button id="btnDateBirth" data-toggle="modal" type="button" class="btn btn-primary "><i class="fa fa-calendar"></i></button>
                          </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">     
                    <div class="row">
                      <div class="col">
                        <label><?php echo $resource['res_placeofbirth']?></label>
                        <input id="placeofbirth" type="text" placeholder="<?php echo $resource['res_placeofbirth']?>" class="form-control" name = "placeofbirth" value="">
                      </div>
                      <div class="col">
                        <label><?php echo $resource['res_religion']?></label>
                        <select id = "religion" name="religion" class="form-control">
                        <?php 	
                        foreach ($enums['religionenum'] as $value)
                        { 
                        ?>
                          <option value ="<?php echo $value->Value?>"><?php echo $value->EnumName?></option>
                        <?php 
                        }
                        ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">     
                    <div class="row">
                        <div class="col">  
                        <label><?php echo $resource['res_lasteducation']?></label>
                        <select id = "education" name="education" class="form-control">
                          <?php 	
                          foreach ($enums['educationenum'] as $value)
                          { 
                          ?>
                            <option value ="<?php echo $value->Value?>"><?php echo $value->EnumName?></option>
                          <?php 
                          }
                          ?>
                        </select>
                        </div><div class="col">  
                        <label><?php echo $resource['res_job']?></label>
                        <input id="job" type="text" placeholder="<?php echo $resource['res_job']?>" class="form-control" name = "job" value="">
                        
                        </div>
                    </div>
                  </div>
                  
                  <div class="form-group">     
                    <div class="row">
                        <div class="col">  
                        <label><?php echo $resource['res_marriagestatus']?></label>
                        <select id = "marriagestatus" name="marriagestatus" class="form-control">
                          <?php 	
                          foreach ($enums['marriageenum'] as $value)
                          { 
                          ?>
                            <option value ="<?php echo $value->Value?>"><?php echo $resource[$value->Resource]?></option>
                          <?php 
                          }
                          ?>
                        </select>
                        </div>
                        <div class="col">  
                          
                        <label><?php echo $resource['res_familystatus']?></label>
                        <select id = "familystatus" name="familystatus" class="form-control">
                          <?php 	
                          foreach ($enums['familyenum'] as $value)
                          { 
                          ?>
                            <option value ="<?php echo $value->Value?>"><?php echo $resource[$value->Resource]?></option>
                          <?php 
                          }
                          ?>
                        </select>
                        </div>
                    </div>
                  </div>
                    
                  <div class="form-group">     
                    <div class="row">
                        <div class="col">  
                        <label><?php echo $resource['res_citizenship']?></label>
                        <select id = "citizenship" name="citizenship" class="form-control">
                          <?php 	
                          foreach ($enums['citizenshipenum'] as $value)
                          { 
                          ?>
                            <option value ="<?php echo $value->Value?>"><?php echo $value->EnumName?></option>
                          <?php 
                          }
                          ?>
                        </select>
                        </div><div class="col">  
                        <label>Pasport No</label>
                        <input id="pasportno" type="text" placeholder="Pasport No" class="form-control" name = "pasportno" value="">
                        </div>
                    </div>
                  </div>
                  <div class="form-group ">
                    <div class="row">
                      <div class="col">
                        <label>Kita No</label>
                        <input id="kitano" type="text" placeholder="Kita No" class="form-control" name = "kitano" value="">
                      </div>
                      <div class="col">
                        <label><?php echo $resource['res_fathersname']?></label>
                        <input id="fathersname" type="text" placeholder="<?php echo $resource['res_fathersname']?>" class="form-control" name = "fathersname" value="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group ">
                    <div class="row">
                      <div class="col">
                        <label><?php echo $resource['res_mothersname']?></label>
                        <input id="mothersname" type="text" placeholder="<?php echo $resource['res_mothersname']?>" class="form-control" name = "mothersname" value="">
                      </div>
                      <div class="col" style="margin:auto">
                        <div class="i-checks">
                          <input id="isheadfamily" type="checkbox" class="form-control-custom">
                          <label for="isheadfamily"><?php echo $resource['res_isheadfamily']?></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">       
                    <button type= "button" id = "btnSaveDetail" value="<?php echo $resource['res_save']?>" class="btn btn-primary text-white"><?php echo $resource['res_save']?>
                  </div>
                  
                </div>
                <div class = "card-header"  id = "detailFamily">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id = "tblDetailFamily">
                      <thead>
                        <tr>
                          <th><?php echo  $resource['res_name']?></th>
                          <th>NIK</th>
                          <th><?php echo  $resource['res_gender']?></th>
                          <th><?php echo  $resource['res_placeofbirth']?></th>
                          <th><?php echo  $resource['res_dateofbirth']?></th>
                          <th><?php echo  $resource['res_isheadfamily']?></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="forms" id = "animalSection">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class = "col-lg-10">
                      <h4><?php echo $resource['res_animal']?></h4> 
                    </div>
                    <div class = "col-lg-2 icon-custom-table-header"><a href="#" data-toggle="collapse" data-target="#collapseAnimal"><i class="fa fa-plus"></i></a></div>
                  </div>
                </div>
                <div class="card-body collapse" id = "collapseAnimal">
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
                  
                  <div class="form-group ">
                    <div class="row">
                      <div class="col">
                        <input hidden id = "familyanimalid" value="" name = "familyanimalid">
                        <label><?php echo $resource['res_name']?></label>
                          <div class="input-group">
                            <input hidden id = "animalid" value="" name = "animalid">
                            <input readonly id = "animalname" placeholder="<?php echo $resource['res_animal']?>" type="text" class="form-control" name = "animalname"  value="" readonly>
                            <div class="input-group-append">
                              <button id="btnAnimal" data-toggle="modal" type="button" class="btn btn-primary" onclick="getModalAnimal(1);" data-target="#modalAnimal"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                      </div>
                      <div class="col">
                        <label><?php echo $resource['res_qty']?></label>
                        <input id="qty" type="number" min="0"placeholder="<?php echo $resource['res_qty']?>" class="form-control" name = "qty" value="" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">       
                    <button type= "button" id = "btnSaveAnimal" value="<?php echo $resource['res_save']?>" class="btn btn-primary text-white"><?php echo $resource['res_save']?>
                  </div>
                  
                </div>
                <div class = "card-header"  id = "animalFamily">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id = "tblAnimalFamily">
                      <thead>
                        <tr>
                          <th><?php echo  $resource['res_animal']?></th>
                          <th><?php echo  $resource['res_qty']?></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
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

<div id="modalAnimal" tabindex="-1" role="dialog" aria-labelledby="modalAnimal" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modalAnimalLabel" class="modal-title"><?php echo  $resource['res_animal']?></h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div id = "cardAnimalModalBody" class="card-body">
        <div class="form-group row">
          <div class="col-sm-12">
            <div class="form-group">
              <div class="input-group">
                <input id = "searchInputAnimal" type="text" class="form-control" >
                <div class="input-group-append">
                  <button id = "searchbutton" type="button" class="btn btn-primary" onclick = "getModalAnimal(1);">Search</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table id = "tblAnimalLookUp" class="table table-striped table-hover">
            <thead>
              <tr>
                <th><?php echo  $resource['res_animal']?> </th>
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
  $( document ).ready(function() {
      var nowDate = new Date();
      $("#dateofbirth").val(nowDate.toLocaleDateString("id-ID"));
      getDataDetailFamilyCard(1);
      getDataAnimalFamilyCard(1);
  });

  function getDataAnimalFamilyCard(page){
    //alert("here");
    $.ajax({
      type : "POST",
      url : "<?php echo base_url("m_familycard/getfamilycardanimal")?>",
      data : {
        idfamilycard : $("#familycardid").val(),
        page : page
      },
      success:function(data){
        removeAnimalFamilyGrid();
        var datas = $.parseJSON(data);
        var res = <?php echo  json_encode($resource)?>;
        var detail = datas['modeldetail'];
        for(var i = 0; i < detail.length; i++)
        {
          $("#tblAnimalFamily").append("<tr>"+
                                        "<td>" + detail[i].AnimalName + "</td>"+
                                        "<td>" + detail[i].Qty + "</td>"+
                                        "<td class = 'icon-custom-table-header'>" +
                                        "<a class = 'icon-custom-table-detail' href='javascript:void(0);' onclick='edit_familycardanimal("+detail[i].Id+");'><i class='fa fa-edit'></i>"+res['res_edit']+"</a>" +
                                        "<a class = 'icon-custom-table-detail' href='javascript:void(0);' onclick='delete_familycardanimal("+detail[i].Id+","+'"'+detail[i].CompleteName+'"'+");'><i class='fa fa-edit'></i>"+res['res_delete']+"</a>" +
                                        "</td>"+
                                      "</tr>");
        }
        
        var previous = "";
        var pages = "";
        var next = "";
        var append = "";
        if(datas['currentpage'] > 3)
        {
          previous += "<li class='page-item'>";
          previous += "<a class='page-link' href='#animalSection' onclick = 'getDataAnimalFamilyCard("+(datas['currentpage']-1)+")' aria-label='Previous'>";
          previous += "<span aria-hidden='true'>&laquo;</span>";
          previous += "<span class='sr-only'>Previous</span>";
          previous += "</a>" ;
          previous += "</li>";
        }

        for (var i = datas['firstpage'] ; i <= datas['lastpage']; i++){
          pages += " <li class='page-item' >";
          pages += "<a class='page-link' href='#animalSection' onclick = 'getDataAnimalFamilyCard("+i+")'>"+i+"</a>";
          pages += "</li>";
        }

        if(datas['currentpage'] < datas['totalpage'] - 2)
        {
          next += "<li class='page-item'>";
          next += "<a class='page-link' href='#animalSection' onclick = 'getDataAnimalFamilyCard("+(1+datas['currentpage'])+")' aria-label='Next'>";
          next += "<span aria-hidden='true'>&raquo;</span>";
          next += "<span class='sr-only'>Next</span>";
          next += "</a>" ;
          next += "</li>";
        }

        append += "<div id = 'animalFamilyPaging' class='row'>";
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
        append +="Total Data : "+datas['totalrow'];
        append += "</div>";
        append += "</div>";

        
        $("#animalFamily").append(append);
      }
    });
  }

   function getDataDetailFamilyCard(page){
    //alert("here");
    $.ajax({
      type : "POST",
      url : "<?php echo base_url("m_familycard/getfamilycarddetail")?>",
      data : {
        idfamilycard : $("#familycardid").val(),
        page : page
      },
      success:function(data){
        removeDetailFamilyGrid();
        var datas = $.parseJSON(data);
        var res = <?php echo  json_encode($resource)?>;
        var detail = datas['modeldetail'];
        for(var i = 0; i < detail.length; i++)
        {
          
          var gender = detail[i].Gender == 1 ? res['res_male'] : res['res_female'];

          var strIsHeadFamily = "<td></td>";
          if(detail[i].IsHeadFamily == 1){
            strIsHeadFamily = "<td><a><i class='fa fa-check'></i></a></td>";
          }
          $("#tblDetailFamily").append("<tr>"+
                                        "<td>" + detail[i].CompleteName + "</td>"+
                                        "<td>" + detail[i].NIK + "</td>"+
                                        "<td>" + gender + "</td>"+ 
                                        "<td>" + detail[i].PlaceOfBirth + "</td>"+
                                        "<td>" + detail[i].DateOfBirth + "</td>"+
                                        strIsHeadFamily +
                                        "<td class = 'icon-custom-table-header'>" +
                                        "<a class = 'icon-custom-table-detail' href='javascript:void(0);' onclick='edit_familycarddetail("+detail[i].Id+");'><i class='fa fa-edit'></i>"+res['res_edit']+"</a>" +
                                        "<a class = 'icon-custom-table-detail' href='javascript:void(0);' onclick='delete_familycarddetail("+detail[i].Id+","+'"'+detail[i].CompleteName+'"'+");'><i class='fa fa-edit'></i>"+res['res_delete']+"</a>" +
                                        "</td>"+
                                      "</tr>");
        }
        
        var previous = "";
        var pages = "";
        var next = "";
        var append = "";
        if(datas['currentpage'] > 3)
        {
          previous += "<li class='page-item'>";
          previous += "<a class='page-link' href='#memberSection' onclick = 'getDataDetailFamilyCard("+(datas['currentpage']-1)+")' aria-label='Previous'>";
          previous += "<span aria-hidden='true'>&laquo;</span>";
          previous += "<span class='sr-only'>Previous</span>";
          previous += "</a>" ;
          previous += "</li>";
        }

        for (var i = datas['firstpage'] ; i <= datas['lastpage']; i++){
          pages += " <li class='page-item' >";
          pages += "<a class='page-link' href='#memberSection' onclick = 'getDataDetailFamilyCard("+i+")'>"+i+"</a>";
          pages += "</li>";
        }

        if(datas['currentpage'] < datas['totalpage'] - 2)
        {
          next += "<li class='page-item'>";
          next += "<a class='page-link' href='#memberSection' onclick = 'getDataDetailFamilyCard("+(1+datas['currentpage'])+")' aria-label='Next'>";
          next += "<span aria-hidden='true'>&raquo;</span>";
          next += "<span class='sr-only'>Next</span>";
          next += "</a>" ;
          next += "</li>";
        }

        append += "<div id = 'detailFamilyPaging' class='row'>";
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
        append +="Total Data : "+datas['totalrow'];
        append += "</div>";
        append += "</div>";

        
        $("#detailFamily").append(append);
      }
    });
  }

  function getModalAnimal(page)
  {
    removeModalAnimalComponent();
    var search = "";
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('m_animal/animalmodal')?>",
      data:{
            page: page,
            search : search
          },
      success:function(data){
        var animal = $.parseJSON(data);
        var detail = animal['m_animal']['modeldetailmodal'];
        console.log(detail);
        for(var i = 0; i < detail.length; i++)
        {
          $("#tblAnimalLookUp").append("<tr onclick='chooseAnimalName("+detail[i].Id+","+'"'+detail[i].Name+'"'+");'> "+
                                      "<td>" + detail[i].Name + "</td>"+
                                      "</tr>");
        }

        var previous = "";
        var pages = "";
        var next = "";
        var append = "";
        if(animal['m_animal']['currentpagemodal'] > 3)
        {
          previous += "<li class='page-item'>";
          previous += "<a class='page-link' href='#' onclick = 'getModalAnimal("+(animal['m_animal']['currentpagemodal']-1)+")' aria-label='Previous'>";
          previous += "<span aria-hidden='true'>&laquo;</span>";
          previous += "<span class='sr-only'>Previous</span>";
          previous += "</a>" ;
          previous += "</li>";
        }

        for (var i = animal['m_animal']['firstpagemodal'] ; i <= animal['m_animal']['lastpagemodal']; i++){
          pages += " <li class='page-item' >";
          pages += "<a class='page-link' href='#' onclick = 'getModalAnimal("+i+")'>"+i+"</a>";
          pages += "</li>";
        }

        if(animal['m_animal']['currentpagemodal'] < animal['m_animal']['totalpagemodal'] - 2)
        {
          next += "<li class='page-item'>";
          next += "<a class='page-link' href='#' onclick = 'getModalAnimal("+(1+animal['m_animal']['currentpagemodal'])+")' aria-label='Next'>";
          next += "<span aria-hidden='true'>&raquo;</span>";
          next += "<span class='sr-only'>Next</span>";
          next += "</a>" ;
          next += "</li>";
        }

        append += "<div id = 'modalAnimalPaging' class='row'>";
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
        append +="Total Data : "+animal['m_animal']['totalrowmodal'];
        append += "</div>";
        append += "</div>";
        
        $("#cardAnimalModalBody").append(append);

      }
    });
  };

  function getModalVillage(page)
  {
    removeModalVillageComponent();
    var search = "";
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

  function chooseAnimalName(Id, Name)
  {
    $("#animalid").val(Id);
    $("#animalname").val(Name);
    $('#modalAnimal').modal('hide');
  };

  $("#modalVillage").on('hidden.bs.modal', function(){
    removeModalVillageComponent();
  });

  $("#modalAnimal").on('hidden.bs.modal', function(){
    removeModalAnimalComponent();
  });

  function removeModalVillageComponent()
  {
    $("#tblVillageLookUp").find("tr:gt(0)").remove();
    $("#modalVillagePaging").remove();
  };


  function removeModalAnimalComponent()
  {
    $("#tblAnimalLookUp").find("tr:gt(0)").remove();
    $("#modalAnimalPaging").remove();
  };

  
  function removeDetailFamilyGrid()
  {
    $("#tblDetailFamily").find("tr:gt(0)").remove();
    $("#detailFamilyPaging").remove();
  };

  function removeAnimalFamilyGrid()
  {
    $("#tblAnimalFamily").find("tr:gt(0)").remove();
    $("#animalFamilyPaging").remove();
  };

  $("#btnSaveDetail").on("click", function(){
    if($("#name").val() === null)
    {
      //alert();
    }
    var id = $("#detailid").val()
    var familycardid = $("#familycardid").val();
    var name = $("#name").val();
    var nik = $("#nik").val();
    var gender = $("#gender").val();
    var dateofbirth = $("#dateofbirth").val();
    var placeofbirth = $("#placeofbirth").val();
    var religion = $("#religion").val();
    var education = $("#education").val();
    var job = $("#job").val();
    var marriagestatus = $("#marriagestatus").val();
    var familystatus = $("#familystatus").val();
    var citizenship = $("#citizenship").val();
    var pasportno = $("#pasportno").val();
    var kitano = $("#kitano").val();
    var fathersname = $("#fathersname").val();
    var mothersname = $("#mothersname").val();
    var isheadfamily = $("#isheadfamily")[0].checked == true ? 1 : 0;
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('mfamilycard/savefamilycarddetail')?>",
      data:{
          id : id,
          familycardid: familycardid,
          name : name,
          nik : nik,
          gender : gender,
          dateofbirth : dateofbirth,
          placeofbirth : placeofbirth,
          religion : religion,
          education : education,
          job : job,
          marriagestatus : marriagestatus,
          familystatus : familystatus,
          citizenship : citizenship,
          pasportno : pasportno,
          kitano : kitano,
          fathersname : fathersname,
          mothersname : mothersname,
          isheadfamily : isheadfamily
      },
      success:function(data){
        location.reload();
      }
    });
  });

  $("#btnSaveAnimal").on("click", function(){
    var familyanimalid = $("#familyanimalid").val()
    var animalid = $("#animalid").val()
    var familycardid = $("#familycardid").val();
    var qty = $("#qty").val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('mfamilycard/savefamilycardanimal')?>",
      data:{
          id : familyanimalid,
          animalid : animalid,
          familycardid: familycardid,
          qty : qty
      },
      success:function(data){
        location.reload();
      }
    });
  });

  $('#dateofbirth').datepicker()
  .on('changeDate', function(e) {
        // `e` here contains the extra attributes
        $('#dateofbirth').val(e.date.toLocaleDateString("id-ID"))
    });
  

  function edit_familycarddetail(id)
  {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('mfamilycard/editfamilycarddetail')?>",
      data:{
        id : id,
      },
      success:function(data){
        var detail = $.parseJSON(data);
        console.log(detail);
        $("#detailid").val(detail['Id']);
        $("#name").val(detail['CompleteName']);
        $("#nik").val(detail['NIK']);
        $("#gender").val(detail['Gender']);
        $("#dateofbirth").val(detail['DateOfBirth']);
        $("#placeofbirth").val(detail['PlaceOfBirth']);
        $("#religion").val(detail['Religion']);
        $("#education").val(detail['LastEducation']);
        $("#job").val(detail['KindOfJob']);
        $("#marriagestatus").val(detail['MarriageStatus']);
        $("#familystatus").val(detail['FamilyStatus']);
        $("#citizenship").val(detail['Citizenship']);
        $("#pasportno").val(detail['PasportNo']);
        $("#kitano").val(detail['KitaNo']);
        $("#fathersname").val(detail['FathersName']);
        $("#mothersname").val(detail['MothersName']);
        $("#isheadfamily")[0].checked = detail['IsHeadFamily'] == 1 ? true : false;
      }
    })
  }

  function edit_familycardanimal(id)
  {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('mfamilycard/editfamilycardanimal')?>",
      data:{
        id : id,
      },
      success:function(data){
        var detail = $.parseJSON(data);
        console.log(detail);
        $("#familyanimalid").val(detail['Id']);
        $("#animalname").val(detail['AnimalName']);
        $("#animalid").val(detail['AnimalId']);
        $("#qty").val(detail['Qty']);
      }
    })
  }

  function delete_familycarddetail(id, name)
  {
    var familycardid = $("#familycardid").val();
    var r=confirm("Do you want to delete "+name+" ?");
    if (r==true)
      window.location = "<?php echo base_url('mfamilycard/deletefamilycarddetail/');?>"+id+"/"+familycardid;
    else
      return false;
  }
</script>