<?php
foreach($userData as $userDataItem)
{
    
	print "<div> Rank $userDataItem->userRank</div>";
	print "<div> Rank count($userDataItem->userFollow)</div>";
	print "<div><h3>$userDataItem->userFullName</h3></div>";
	print "<div>$userDataItem->userID</div>";
	print "<div>$userDataItem->userEmail</div>";
	print "<img src=\"".base_url()."assets/images/users/".$userDataItem->userID."/".$userDataItem->userID.".jpg\"/>";
}
?>