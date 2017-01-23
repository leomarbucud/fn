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
$sql .= "p.package_hotel, ";
$sql .= "p.package_transportation, ";
$sql .= "p.package_details, ";
$sql .= "p.package_start, ";
$sql .= "p.package_end, ";
$sql .= "p.package_from, ";
$sql .= "p.package_to, ";
$sql .= "p.package_trip, ";
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

//$package['package_start'] = date_format(strtotime($package['package_start']), "d/m/Y");

function getPlaces() {
    $db = new DB;
    $sql = "SELECT * FROM `places`";
    return $db->rows($sql);
}

$places = getPlaces();

$accomodations = array("Hotel","Guest house","Trancient home","None");
$transportations = array("Airplane");

$sql =  "SELECT ";
$sql .= "airport_id, ";
$sql .= "airport_name, ";
$sql .= "airport_location ";
$sql .= "FROM ";
$sql .= "airports ";

$airports = $db->rows($sql);

$sql =  "SELECT ";
$sql .= "hotel_id, ";
$sql .= "hotel_name ";
$sql .= "FROM ";
$sql .= "hotels ";

$hotels = $db->rows($sql);

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
                                <div class="form-group">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?=$package['package_name']?>" required>
                                        <div class="help-block with-errors"></div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="details" class="control-label">Destination</label>
                                <div class="form-group">
                                        <select class="form-control" name="place">
                                            <option value="">--Select--</option>
                                            <?php foreach ($places as $place) : ?>
                                            <option value="<?=$place['place_id']?>" <?=($place['place_id']==$package['place_id']?'selected':'')?> ><?=$place['place_name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Package Price </label>
                                <div class="form-group">
                                        <input type="text" name="price" class="form-control" id="name" placeholder="Price" value="<?=$package['package_price']?>" required>
                                        <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Days</label>
                                <div class="form-group">
                                       <input type="number" name="days" class="form-control" id="name" placeholder="" value="<?=$package['package_days']?>" required>
                                       <div class="help-block with-errors"></div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label">No of. person</label>
                                <div class="form-group">
                                        <select class="form-control" name="person">
                                            <option value="">--Select--</option>
                                            <?php for($i = 1; $i<=10; $i++): ?>
                                            <option value="<?=$i?>" <?=($i==$package['package_person']?'selected':'')?>><?=$i?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hotel</label>
                                <div class="form-group">
                                    <select class="form-control" id="hotel" name="hotel" required>
                                        <option value="">--Select--</option>
                                        <option value="0" <?=$package['package_hotel']==0?'selected':''?>>None</option>
                                        <?php foreach($hotels as $hotel) : ?>
                                        <option value="<?=$hotel['hotel_id']?>" <?=$hotel['hotel_id']==$package['package_hotel']?'selected':''?>><?=$hotel['hotel_name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Transportaion</label>
                                <div class="form-group">
                                        <select class="form-control" name="transpo" required>
                                            <option value="">--Select--</option>
                                            <?php foreach ($transportations as $transportation) : ?>
                                            <option value="<?=$transportation?>" <?=$transportation==$package['package_transportation']?'selected':''?> ><?=$transportation?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Availablity</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                       <input id="package-start" type="text" class="form-control" name="package-start" required placeholder="Start" value="<?=$package['package_start']?>"/>
                                       <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input id="package-end" type="text" class="form-control" name="package-end" required placeholder="End" value="<?=$package['package_end']?>" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Route</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" id="package_from" name="package_from" required>
                                            <option value="">--Select--</option>
                                            <?php foreach($airports as $airport) : ?>
                                            <?php
                                                $selected = "";
                                                if($airport['airport_id'] == $package['package_from']) {
                                                    $selected = "selected";
                                                }
                                            ?>
                                            <option value="<?=$airport['airport_id']?>" <?=$selected?> ><?=$airport['airport_location']?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" id="package_to" name="package_to" required>
                                            <option value="">--Select--</option>
                                            <?php foreach($airports as $airport) : ?>
                                            <?php
                                                $selected = "";
                                                if($airport['airport_id'] == $package['package_to']) {
                                                    $selected = "selected";
                                                }
                                            ?>
                                            <option value="<?=$airport['airport_id']?>" <?=$selected?> ><?=$airport['airport_location']?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Trip</label>
                                <div class="form-group">
                                    <select class="form-control" name="package_trip" required>
                                        <option value="">--Select--</option>
                                        <?php
                                            $st = "";
                                            $rt = "";
                                            if($package['package_trip'] == 1) {
                                                $st = "selected";
                                            } elseif($package['package_trip'] == 2) {
                                                $rt = "selected";
                                            }
                                        ?>
                                        <option value="1" <?=$st?> >One Way</option>
                                        <option value="2" <?=$rt?> >Round Trip</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
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