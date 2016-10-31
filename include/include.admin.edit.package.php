<?php
$s = new Session;
$db = new DB;

$sql =  "SELECT ";
$sql .= "p.package_id, ";
$sql .= "p.package_name, ";
$sql .= "p.place_id, ";
$sql .= "p.package_price, ";
$sql .= "p.package_days, ";
$sql .= "p.package_person, ";
$sql .= "p.package_accomodation, ";
$sql .= "p.package_transportation, ";
$sql .= "p.package_details, ";
$sql .= "g.place_image, ";
$sql .= "g.place_name  ";
$sql .= "FROM ";
$sql .= "`packages` as p ";
$sql .= "LEFT JOIN ";
$sql .= "`places` as g ";
$sql .= "ON ";
$sql .= "g.place_id = p.place_id ";
$sql .= "WHERE ";
$sql .= "p.package_id = :package_id";

$package = $db->row($sql, array("package_id" => httpGet('package_id')));

if(!$package) {
    header("location: {$config['url']['base_path']}/packages.php");
}

function getPlaces() {
    $db = new DB;
    $sql = "SELECT * FROM `places`";
    return $db->rows($sql);
}

$places = getPlaces();

$accomodations = array("Hotel","Guest house","Trancient home","None");
$transportations = array("Bus","Van","Jeepney","Airplane");

?>
<div class="row-offcanvas row-offcanvas-left">
    <div id="sidebar" class="sidebar-offcanvas">
        <?php include_once 'include/include.side.bar.php'; ?>
    </div>
    <div id="main">
        <div class="col-md-12">
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
            </p>
            <div class="admin-page">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Package</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/packages.php?action=update" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="package_id" value="<?=$package['package_id']?>" />
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?=$package['package_name']?>" required>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="details" class="control-label">Destination</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" name="place">
                                            <option value="">--Select--</option>
                                            <?php foreach ($places as $place) : ?>
                                            <option value="<?=$place['place_id']?>" <?=($place['place_id']==$package['place_id']?'selected':'')?> ><?=$place['place_name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Package Price </label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="price" class="form-control" id="name" placeholder="Price" value="<?=$package['package_price']?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Days</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                       <input type="number" name="days" class="form-control" id="name" placeholder="" value="<?=$package['package_days']?>" required>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label">No of. person</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" name="person">
                                            <option value="">--Select--</option>
                                            <?php for($i = 1; $i<=10; $i++): ?>
                                            <option value="<?=$i?>" <?=($i==$package['package_person']?'selected':'')?>><?=$i?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Accomodation</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" name="accomodation" required>
                                            <option value="">--Select--</option>
                                            <?php foreach ($accomodations as $accomodation) : ?>
                                            <option value="<?=$accomodation?>" <?=$accomodation==$package['package_accomodation']?'selected':''?> ><?=$accomodation?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Transportaion</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" name="transpo" required>
                                            <option value="">--Select--</option>
                                            <?php foreach ($transportations as $transportation) : ?>
                                            <option value="<?=$transportation?>" <?=$transportation==$package['package_transportation']?'selected':''?> ><?=$transportation?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="details" class="control-label">Other details</label>
                                <textarea rows="3" class="form-control" id="details" name="details" placeholder="Details"><?=$package['package_details']?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>