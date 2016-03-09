<?php if(! defined('BASEPATH') ) exit('403 Unauthorized'); ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns:ng="http://angularjs.org" ng-app="logApp">
	<head>
		<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>application/views/dist/styles/main.css" />
	</head>
	<body class="container" ng-controller="logController">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span4"></div>
				<div class="span4"></div>
				<div class="span2"></div>
				<div class="span2">
					<a href="<?php echo base_url(); ?>logistic/logout"><button class="btn btn-primary btn-large">Logout</button></a>
				</div>
			</div>
		</div>

		<form id="foo" ng-upload method="POST" action="/logistic/upload">
                <p>
                    <label>Select a file to upload:</label>
                    <input type="file" name="file" accept="text/plain" />
                </p>
                <p>
                    <input upload-submit="bar(content)" type="submit" class="btn" value="Submit" />
                    <br />
                    <i>Button is <b>disabled</b> during upload, by default.</i>
                </p>
            </form>

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span4"></div>
				<div class="span4">
					<div class="row-fluid">
						Today's Manifest Number(s)
						<select id="manifestIDs" ng-model="mfID" ng-options="val.manifestID for (key, val) in manifestIDs"></select>
					</div>
					<div class="row-fluid">
						Today's Batch Number(s) for the selected Manifest
						<select id="batchIDs" ng-model="bcID" ng-options="val.batchID for (key, val) in batchIDs"></select>
					</div>
					<div class="row-fluid">
						<!-- <div class="span2">Filter By </div>
						<div class="span4">Start Date: <input type="text" placeholder="DD-MM-YYYY" id="startDateFilter" class="input-small"></div>
						<div class="span4">End Date: <input type="text" placeholder="DD-MM-YYYY" id="endDateFilter" class="input-small"></div> -->
						<div class="span1"><button class="btn btn-success btn-small" id="getBatchButton" ng-click="getBatchOrderData(bcID)">Go</button></div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span1"></div>
				<div class="span11">
					<div class="row-fluid">
						<table class="table table-striped table-bordered table-hover" border="1">
							<tr>
								<th>AWB No.</th>
								<th>OrderID</th>
								<th>Contents</th>
								<th>Weight(KG)</th>
								<th>TimeStamp</th>
								<th>BuynBrag Status</th>
								<th>Action</th>
								<th>Remarks</th>
							</tr>
							<tr ng-repeat="awb in awbs">
								<td class="text-info">{{awb.awb_no || "Not Generated"}}</td>
								<td>{{awb.order_id}}</td>
								<td><b>{{awb.product_name}}</b></td>
								<td>{{awb.weight}}</tD>
								<td>{{(awb.statusTimeStamp)*1000 | date:'medium'}}</td>
								<tD>{{orderStatus[awb.status_order].status}}</tD>
								<tD>
									<div class="row-fluid">
										<select id="batchIDs" ng-model="option" ng-options="a.text for a in options | filter: '!'+options[awb.action].text">
											<option value="">{{options[awb.action].text}}</option> 
										</select>
									</div>
								</tD>
								<tD>
									<p ng-hide="clicked">{{awb.remarks}}</p>
									<input ng-show="clicked" type="text" ng-model="newRemark" ng-init="newRemark= awb.remarks">									
									<button ng-hide="clicked" class="btn btn-info btn-small" ng-click="showHiddenFields()">Edit</button>
									<button ng-show="clicked" class="btn btn-success btn-small" ng-click="editRemark(awb.batchItemID, option.id, newRemark)">Save</button>
									<button ng-show="clicked" class="btn btn-primary btn-small" ng-click="showOriginalFields()">Cancel</button>
								</tD>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/app/scripts/vendor/angular/_lib/angular.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/app/scripts/vendor/angular/logistics.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/app/scripts/vendor/angular/ng-upload.min.js"></script>
	</body>
</html>
