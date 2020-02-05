<?php
session_start();
$name = $_POST['name'];

$idname = str_replace(' ', '_', $name);

//include 'dbconnect.php';
include("dbconnect.php");
//mysql_select_db("seniorgrooming");
$services = array();
$query = mysql_query("SELECT * FROM nurse_services where service='$name'");
//echo "SELECT cat_id FROM categories where category_name='$type'";
$cat_id_row=mysql_fetch_assoc($query);
$cat_id=$cat_id_row['id'];
$service_name = $cat_id_row['service'];
$catid = $cat_id_row['cat_id'];


$sql = "SELECT * FROM services_addons where s_id='$cat_id' AND ad_status='1'";
$result = mysql_query($sql);
$sqldata = "SELECT * FROM services_addons where s_id='$cat_id' AND ad_status='1'";
$results = mysql_query($sqldata);
$data = mysql_fetch_assoc($results);
// print_r($data);
?>
<div class="d-flexx" id="<?php echo $idname;?>">

  <div class="col-md-12  btn-section"> 
  <?php if($idname == 'VIP_Nail_Care') { ?>
    <div class="text-center" id="the_works">
        <h1 class="text-center" style="font-size: 21px;color: #991313;">
            Please choose the add ons you would like for VIP Nail Care:
        </h1>
    </div>
  <?php } else if($idname == 'The_Works') { ?>
    <div class="text-center" id="the_works">
        <h1 class="text-center" style="font-size: 21px;color: #991313;">
            Please choose the add ons you would like for The Works:
        </h1>
    </div>
  <?php } ?>
    <div class="campaigns-tabs">
      <ul class="nav nav-pills" id="<?php echo $idname;?>1">
       <?php
	   $i = 1;
	   while ($row = mysql_fetch_array($result)) {
        $title = str_replace(' ', '_', $row['title']);
        $ad_id = str_replace(' ', '_', $row['ad_id']); ?>
        <li class="nav-item">
         <div class="inputselectdoc-main">
          <div class="inputselectdoc">
            <input title="1" id="<?php echo $title;?>" onClick="GetAddon('<?php echo $catid;?>','<?php echo $row['title'];?>',this,'campaign-7days<?php echo $i;?>','<?php echo $ad_id;?>');" value="<?php echo $row['title'];?>&<?php echo $ad_id;?>" name="doc" type="checkbox" >
            <label for="<?php echo $title;?>"><small><?php echo $row['title'];?></small></label> 
          </div> 
        </div> 
      </li>
      <?php $i++;  }  ?>

    </ul>
  </div>
</div> 

<div class="col-md-12 mb-50" >        
  <div class="tab-content">
   <?php $sql = "SELECT * FROM services_addons where s_id='$cat_id' AND ad_status='1'";
   $result = mysql_query($sql);
   $k = 1;
   $j= 1;

   while ($row = mysql_fetch_array($result)) {
    $ad_id = $row['ad_id'];
     $service_id = $row['s_id']; ?>
    <div class="tab-pane container" id="campaign-7days<?php echo $k;?>">
      <div class="campaigns-tabs-cont" style="max-width: 650px;  width: 100%;">
        <div class="row">

          <?php 
          $sql = "SELECT * FROM addon_colors where addon_id='$ad_id' ";
          $results = mysql_query($sql);
          while ($row = mysql_fetch_array($results)) {
            $cid = $row['cl_id'];
            $color_code = $row['color_code'];
            $color_name = $row['color_name'];
            $addon_id = $row['addon_id'];
          ?>

            <div class="col-md-3 col-xs-12 btn-gird">
              <div class="checkbox checknew">
               <!-- <input type="radio" value="<?php //echo $row['cl_id'];?>" onClick="Getcolors('<?php //echo $catid;?>','<?php //echo $cid;?>','<?php //echo $color_code;?>','<?php //echo $color_name;?>',this);" name="color" id="user<?php //echo $row['cl_id'];?>"> -->



               <!-- <?php echo $catid;?>/<?php echo $cid;?>/<?php echo $color_code;?>/<?php echo $color_name;?> -->
                <input type="radio" value="<?php echo $cid;?>" onClick="Getcolors('<?php echo $catid;?>','<?php echo $cid;?>','<?php echo $color_code;?>','<?php echo $color_name;?>',this,'<?php echo $addon_id;?>','<?php echo $service_id;?>');" name="color" id="user<?php echo $row['cl_id'];?>">

               <label style="background: <?php echo $row['color_code'];?>" for="user<?php echo $row['cl_id'];?>"></label>
               <p><?php echo $row['color_name'];?></p>

             </div>    
           </div>
         <?php } ?>


       </div> 
     </div> 
   </div>
   <?php $k++; $j++; } ?>
 </div>
</div>
<div class="clearfix"></div>   