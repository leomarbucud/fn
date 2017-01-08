<?php 
$s = new Session;
function getPlaces() {
	$db = new DB;
	$sql = "SELECT * FROM `places`";
	return $db->rows($sql);
}

$places = getPlaces();

$db = new DB;

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
                        <h3 class="panel-title">Add Package</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/packages.php?action=save" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="details" class="control-label">Destination</label>
                                <div class="form-group">
                                    <select class="form-control" name="place">
                                        <option value="">--Select--</option>
                                        <?php foreach ($places as $place) : ?>
                                        <option value="<?=$place['place_id']?>"><?=$place['place_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Package Price </label>
                                <div class="form-group">
                                    <input type="text" name="price" class="form-control" id="name" placeholder="Price" value="" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Days</label>
                                <div class="form-group">
                                   <input type="number" name="days" class="form-control" id="name" placeholder="" value="" required>
                                   <div class="help-block with-errors"></div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label">No of. person</label>
                                <div class="form-group">
                                    <select class="form-control" name="person">
                                        <option value="">--Select--</option>
                                        <?php for($i = 1; $i<=10; $i++): ?>
                                        <option value="<?=$i?>"><?=$i?></option>
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
                                        <?php foreach($hotels as $hotel) : ?>
                                        <option value="<?=$hotel['hotel_id']?>"><?=$hotel['hotel_name']?></option>
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
                                        <option value="Bus">Bus</option>
                                        <option value="Van">Van</option>
                                        <option value="Jeepney">Jeepney</option>
                                        <option value="Airplane">Airplane</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Availablity</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                       <input id="package-start" type="text" class="form-control" name="package-start" required placeholder="Start" />
                                       <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input id="package-end" type="text" class="form-control" name="package-end" required placeholder="End" />
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
                                            <option value="<?=$airport['airport_id']?>"><?=$airport['airport_location']?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" id="package_to" name="package_to" required>
                                            <option value="">--Select--</option>
                                            <?php foreach($airports as $airport) : ?>
                                            <option value="<?=$airport['airport_id']?>"><?=$airport['airport_location']?></option>
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
                                        <option value="1">One Way</option>
                                        <option value="2">Round Trip</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="details" class="control-label">Other details</label>
                                <textarea rows="3" class="form-control" id="details" name="details" placeholder="Details"></textarea>
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