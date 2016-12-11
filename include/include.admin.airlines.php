<?php

$db = new DB;

$sql =  "SELECT ";
$sql .= "airline_id, ";
$sql .= "airline_name, ";
$sql .= "airline_details, ";
$sql .= "date_created ";
$sql .= "FROM ";
$sql .= "airlines ";

$airlines = $db->rows($sql);

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
            	<?php if(isset($save)) : if($save) : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> 
                    Airline has been added
                </div>
                <?php endif; endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Airlines</h3>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($airlines as $airline) : ?>
                            <tr>
                                <td><?=$airline['airline_id']?></td>
                                <td><?=$airline['airline_name']?></td>
                                <td><?=$airline['airline_details']?></td>
                                <td class="text-center">
                                    <a href="<?=$config['url']['base_path']?>/airlines.php?action=edit&id=<?=$airline['airline_id']?>" class="btn btn-default btn-xs">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="8">
                                    <a href="<?=$config['url']['base_path']?>/airlines.php?action=add" class="btn btn-primary pull-right btn-sm">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
