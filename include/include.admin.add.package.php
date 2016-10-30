<?php 
$s = new Session;
function getPlaces() {
	$db = new DB;
	$sql = "SELECT * FROM `places`";
	return $db->rows($sql);
}

$places = getPlaces();

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
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="" required>
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
                                            <option value="<?=$place['place_id']?>"><?=$place['place_name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Package Price </label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="price" class="form-control" id="name" placeholder="Price" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Days</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                       <input type="number" name="days" class="form-control" id="name" placeholder="" value="" required>
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
                                            <option value="<?=$i?>"><?=$i?></option>
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
                                            <option value="Hotel">Hotel</option>
                                            <option value="Guest house">Guest house</option>
                                            <option value="Trancient home">Trancient home</option>
                                            <option value="none">None</option>
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
                                            <option value="Bus">Bus</option>
                                            <option value="Van">Van</option>
                                            <option value="Jeepney">Jeepney</option>
                                            <option value="Airplane">Airplane</option>
                                        </select>
                                    </div>
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