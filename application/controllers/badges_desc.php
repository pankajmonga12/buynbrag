<?php
class badgeDetails
{
	public $type;
	public $typeDesc;
	public $level;
	public $notificationText;
	public $bbucks;
	public $triggeredAt;
}

$storeBadges = array();
for($i = 1; $i <= 16; $i++)
{
	$badgeExplore =  new badgeDetails;
	$badgeExplore->type = 1;
	$badgeExplore->typeDesc = 'You get these badges when you explore';
	$badgeExplore->level = $i;
	switch($i)
	{
		case 1: $badgeExplore->notificationText = 'THE Browser - 0 Star';
			  $badgeExplore->bbucks = 250;
			  $badgeExplore->triggeredAt = 3;
			break;
		case 2: $badgeExplore->notificationText = 'THE Browser - 1 Star';
			  $badgeExplore->bbucks = 250;
			  $badgeExplore->triggeredAt = 10;
			break;
		case 3: $badgeExplore->notificationText = 'THE Browser - 2 Star';
			  $badgeExplore->bbucks = 500;
			  $badgeExplore->triggeredAt = 15;
			break;
		case 4: $badgeExplore->notificationText = 'THE Browser - 3 Star';
			  $badgeExplore->bbucks = 500;
			  $badgeExplore->triggeredAt = 18;
			break;
		case 5: $badgeExplore->notificationText = 'THE Window Shopper - 0 Star';
			  $badgeExplore->bbucks = 750;
			  $badgeExplore->triggeredAt = 20;
			break;
		case 6: $badgeExplore->notificationText = 'THE Window Shopper - 1 Star';
			  $badgeExplore->bbucks = 750;
			  $badgeExplore->triggeredAt = 25;
			break;
		case 7: $badgeExplore->notificationText = 'THE Window Shopper - 2 Star';
			  $badgeExplore->bbucks = 750;
			  $badgeExplore->triggeredAt = 35;
			break;
		case 8: $badgeExplore->notificationText = 'THE Window Shopper - 3 Star';
			  $badgeExplore->bbucks = 750;
			  $badgeExplore->triggeredAt = 40;
			break;
		case 9: $badgeExplore->notificationText = 'The Voyeur - 0 Star';
			  $badgeExplore->bbucks = 1000;
			  $badgeExplore->triggeredAt = 60;
			break;
		case 10: $badgeExplore->notificationText = 'The Voyeur - 1 Star';
			  $badgeExplore->bbucks = 1250;
			  $badgeExplore->triggeredAt = 80;
			break;
		case 11: $badgeExplore->notificationText = 'The Voyeur - 2 Star';
			  $badgeExplore->bbucks = 1500;
			  $badgeExplore->triggeredAt = 100;
			break;
		case 12: $badgeExplore->notificationText = 'The Voyeur - 3 Star';
			  $badgeExplore->bbucks = 2500;
			  $badgeExplore->triggeredAt = 120;
			break;
		case 13: $badgeExplore->notificationText = 'The Guidebook - 0 Star';
			  $badgeExplore->bbucks = 5000;
			  $badgeExplore->triggeredAt = 150;
			break;
		case 14: $badgeExplore->notificationText = 'The Guidebook - 1 Star';
			  $badgeExplore->bbucks = 10000;
			  $badgeExplore->triggeredAt = 200;
			break;
		case 15: $badgeExplore->notificationText = 'The Guidebook - 2 Star';
			  $badgeExplore->bbucks = 15000;
			  $badgeExplore->triggeredAt = 300;
			break;
		case 16: $badgeExplore->notificationText = 'The Guidebook - 3 Star';
			  $badgeExplore->bbucks = 25000;
			  $badgeExplore->triggeredAt = 400;
			break;
	}
	$storeBadges[$i] = $badgeExplore;
}

$pollBadges = array();
for($i = 1; $i <= 16; $i++)
{
	$badgePoll =  new badgeDetails;
	$badgePoll->type = 2;
	$badgePoll->typeDesc = 'You get these badges when you create poll on different products';
	$badgePoll->level = $i;
	switch($i)
	{
		case 1: $badgePoll->notificationText = 'THE Pollster - 0 Star';
			  $badgePoll->bbucks = 250;
			  $badgePoll->triggeredAt = 1;
			break;
		case 2: $badgePoll->notificationText = 'THE Pollster - 1 Star';
			  $badgePoll->bbucks = 250;
			  $badgePoll->triggeredAt = 2;
			break;
		case 3: $badgePoll->notificationText = 'THE Pollster - 2 Star';
			  $badgePoll->bbucks = 250;
			  $badgePoll->triggeredAt = 3;
			break;
		case 4: $badgePoll->notificationText = 'THE Pollster - 3 Star';
			  $badgePoll->bbucks = 250;
			  $badgePoll->triggeredAt = 4;
			break;
		case 5: $badgePoll->notificationText = 'THE Crowd-Sourcer - 0 Star';
			  $badgePoll->bbucks = 1250;
			  $badgePoll->triggeredAt = 5;
			break;
		case 6: $badgePoll->notificationText = 'THE Crowd-Sourcer - 1 Star';
			  $badgePoll->bbucks = 1250;
			  $badgePoll->triggeredAt = 10;
			break;
		case 7: $badgePoll->notificationText = 'THE Crowd-Sourcer - 2 Star';
			  $badgePoll->bbucks = 1250;
			  $badgePoll->triggeredAt = 13;
			break;
		case 8: $badgePoll->notificationText = 'THE Crowd-Sourcer - 3 Star';
			  $badgePoll->bbucks = 1250;
			  $badgePoll->triggeredAt = 18;
			break;
		case 9: $badgePoll->notificationText = 'THE Democrat - 0 Star';
			  $badgePoll->bbucks = 1500;
			  $badgePoll->triggeredAt = 25;
			break;
		case 10: $badgePoll->notificationText = 'THE Democrat - 1 Star';
			  $badgePoll->bbucks = 1500;
			  $badgePoll->triggeredAt = 35;
			break;
		case 11: $badgePoll->notificationText = 'THE Democrat - 2 Star';
			  $badgePoll->bbucks = 1500;
			  $badgePoll->triggeredAt = 45;
			break;
		case 12: $badgePoll->notificationText = 'THE Democrat - 3 Star';
			  $badgePoll->bbucks = 1500;
			  $badgePoll->triggeredAt = 55;
			break;
		case 13: $badgePoll->notificationText = 'THE Crowd-Pleaser - 0 Star';
			  $badgePoll->bbucks = 2200;
			  $badgePoll->triggeredAt = 75;
			break;
		case 14: $badgePoll->notificationText = 'THE Crowd-Pleaser - 1 Star';
			  $badgePoll->bbucks = 2200;
			  $badgePoll->triggeredAt = 85;
			break;
		case 15: $badgePoll->notificationText = 'THE Crowd-Pleaser - 2 Star';
			  $badgePoll->bbucks = 2200;
			  $badgePoll->triggeredAt = 95;
			break;
		case 16: $badgePoll->notificationText = 'THE Crowd-Pleaser - 3 Star';
			  $badgePoll->bbucks = 2200;
			  $badgePoll->triggeredAt = 150;
			break;
	}
	$pollBadges[$i] = $badgePoll;
}

$fancyStoreBadges = array();
for($i = 1; $i <= 16; $i++)
{
	$badgeFancyStore =  new badgeDetails;
	$badgeFancyStore->type = 3;
	$badgeFancyStore->typeDesc = 'You get these badges when you fancy stores';
	$badgeFancyStore->level = $i;
	switch($i)
	{
		case 1: $badgeFancyStore->notificationText = 'The Recommendor - 0 Star';
			  $badgeFancyStore->bbucks = 400;
			  $badgeFancyStore->triggeredAt = 2;
			break;
		case 2: $badgeFancyStore->notificationText = 'The Recommendor - 1 Star';
			  $badgeFancyStore->bbucks = 800;
			  $badgeFancyStore->triggeredAt = 4;
			break;
		case 3: $badgeFancyStore->notificationText = 'The Recommendor - 2 Star';
			  $badgeFancyStore->bbucks = 2000;
			  $badgeFancyStore->triggeredAt = 6;
			break;
		case 4: $badgeFancyStore->notificationText = 'The Recommendor - 3 Star';
			  $badgeFancyStore->bbucks = 3000;
			  $badgeFancyStore->triggeredAt = 8;
			break;
		case 5: $badgeFancyStore->notificationText = 'The Evangelist - 0 Star';
			  $badgeFancyStore->bbucks = 3500;
			  $badgeFancyStore->triggeredAt = 10;
			break;
		case 6: $badgeFancyStore->notificationText = 'The Evangelist - 1 Star';
			  $badgeFancyStore->bbucks = 4500;
			  $badgeFancyStore->triggeredAt = 15;
			break;
		case 7: $badgeFancyStore->notificationText = 'The Evangelist - 2 Star';
			  $badgeFancyStore->bbucks = 6000;
			  $badgeFancyStore->triggeredAt = 20;
			break;
		case 8: $badgeFancyStore->notificationText = 'The Evangelist - 3 Star';
			  $badgeFancyStore->bbucks = 8000;
			  $badgeFancyStore->triggeredAt = 25;
			break;
		case 9: $badgeFancyStore->notificationText = 'The Ambassador - 0 Star';
			  $badgeFancyStore->bbucks = 12000;
			  $badgeFancyStore->triggeredAt = 35;
			break;
		case 10: $badgeFancyStore->notificationText = 'The Ambassador - 1 Star';
			  $badgeFancyStore->bbucks = 12000;
			  $badgeFancyStore->triggeredAt = 45;
			break;
		case 11: $badgeFancyStore->notificationText = 'The Ambassador - 2 Star';
			  $badgeFancyStore->bbucks = 12000;
			  $badgeFancyStore->triggeredAt = 55;
			break;
		case 12: $badgeFancyStore->notificationText = 'The Ambassador - 3 Star';
			  $badgeFancyStore->bbucks = 12000;
			  $badgeFancyStore->triggeredAt = 65;
			break;
		case 13: $badgeFancyStore->notificationText = 'The Oracle - 0 Star';
			  $badgeFancyStore->bbucks = 15000;
			  $badgeFancyStore->triggeredAt = 85;
			break;
		case 14: $badgeFancyStore->notificationText = 'The Oracle - 1 Star';
			  $badgeFancyStore->bbucks = 20000;
			  $badgeFancyStore->triggeredAt = 105;
			break;
		case 15: $badgeFancyStore->notificationText = 'The Oracle - 2 Star';
			  $badgeFancyStore->bbucks = 25000;
			  $badgeFancyStore->triggeredAt = 125;
			break;
		case 16: $badgeFancyStore->notificationText = 'The Oracle - 3 Star';
			  $badgeFancyStore->bbucks = 30000;
			  $badgeFancyStore->triggeredAt = 150;
			break;
	}
	$fancyStoreBadges[$i] = $badgeFancyStore;
}

$fancyBadges = array();
for($i = 1; $i <= 16; $i++)
{
	$badgeFancyProduct =  new badgeDetails;
	$badgeFancyProduct->type = 4;
	$badgeFancyProduct->typeDesc = 'You get these badges when you fancy products';
	$badgeFancyProduct->level = $i;
	switch($i)
	{
		case 1: $badgeFancyProduct->notificationText = 'Eye for Beauty - 0 Star';
			  $badgeFancyProduct->bbucks = 400;
			  $badgeFancyProduct->triggeredAt = 4;
			break;
		case 2: $badgeFancyProduct->notificationText = 'Eye for Beauty - 1 Star';
			  $badgeFancyProduct->bbucks = 800;
			  $badgeFancyProduct->triggeredAt = 20;
			break;
		case 3: $badgeFancyProduct->notificationText = 'Eye for Beauty - 2 Star';
			  $badgeFancyProduct->bbucks = 2000;
			  $badgeFancyProduct->triggeredAt = 35;
			break;
		case 4: $badgeFancyProduct->notificationText = 'Eye for Beauty - 3 Star';
			  $badgeFancyProduct->bbucks = 3000;
			  $badgeFancyProduct->triggeredAt = 55;
			break;
		case 5: $badgeFancyProduct->notificationText = 'The Aficionado - 0 Star';
			  $badgeFancyProduct->bbucks = 3500;
			  $badgeFancyProduct->triggeredAt = 85;
			break;
		case 6: $badgeFancyProduct->notificationText = 'The Aficionado - 1 Star';
			  $badgeFancyProduct->bbucks = 4500;
			  $badgeFancyProduct->triggeredAt = 125;
			break;
		case 7: $badgeFancyProduct->notificationText = 'The Aficionado - 2 Star';
			  $badgeFancyProduct->bbucks = 6000;
			  $badgeFancyProduct->triggeredAt = 150;
			break;
		case 8: $badgeFancyProduct->notificationText = 'The Aficionado - 3 Star';
			  $badgeFancyProduct->bbucks = 8000;
			  $badgeFancyProduct->triggeredAt = 240;
			break;
		case 9: $badgeFancyProduct->notificationText = 'The Connoisseur - 0 Star';
			  $badgeFancyProduct->bbucks = 12000;
			  $badgeFancyProduct->triggeredAt = 250;
			break;
		case 10: $badgeFancyProduct->notificationText = 'The Connoisseur - 1 Star';
			  $badgeFancyProduct->bbucks = 12000;
			  $badgeFancyProduct->triggeredAt = 300;
			break;
		case 11: $badgeFancyProduct->notificationText = 'The Connoisseur - 2 Star';
			  $badgeFancyProduct->bbucks = 12000;
			  $badgeFancyProduct->triggeredAt = 350;
			break;
		case 12: $badgeFancyProduct->notificationText = 'The Connoisseur - 3 Star';
			  $badgeFancyProduct->bbucks = 12000;
			  $badgeFancyProduct->triggeredAt = 450;
			break;
		case 13: $badgeFancyProduct->notificationText = 'The Curator - 0 Star';
			  $badgeFancyProduct->bbucks = 15000;
			  $badgeFancyProduct->triggeredAt = 500;
			break;
		case 14: $badgeFancyProduct->notificationText = 'The Curator - 1 Star';
			  $badgeFancyProduct->bbucks = 20000;
			  $badgeFancyProduct->triggeredAt = 650;
			break;
		case 15: $badgeFancyProduct->notificationText = 'The Curator - 2 Star';
			  $badgeFancyProduct->bbucks = 25000;
			  $badgeFancyProduct->triggeredAt = 750;
			break;
		case 16: $badgeFancyProduct->notificationText = 'The Curator - 3 Star';
			  $badgeFancyProduct->bbucks = 30000;
			  $badgeFancyProduct->triggeredAt = 900;
			break;
	}
	$fancyBadges[$i] = $badgeFancyProduct;
}

$bragBadges = array();
for($i = 1; $i <= 16; $i++)
{
	$badgeBragProduct =  new badgeDetails;
	$badgeBragProduct->type = 5;
	$badgeBragProduct->typeDesc = 'You get these badges when you brag products';
	$badgeBragProduct->level = $i;
	switch($i)
	{
		case 1: $badgeBragProduct->notificationText = 'Eye for Beauty - 0 Star';
			  $badgeBragProduct->bbucks = 250;
			  $badgeBragProduct->triggeredAt = 2;
			break;
		case 2: $badgeBragProduct->notificationText = 'Eye for Beauty - 1 Star';
			  $badgeBragProduct->bbucks = 500;
			  $badgeBragProduct->triggeredAt = 5;
			break;
		case 3: $badgeBragProduct->notificationText = 'Eye for Beauty - 2 Star';
			  $badgeBragProduct->bbucks = 750;
			  $badgeBragProduct->triggeredAt = 10;
			break;
		case 4: $badgeBragProduct->notificationText = 'Eye for Beauty - 3 Star';
			  $badgeBragProduct->bbucks = 1000;
			  $badgeBragProduct->triggeredAt = 25;
			break;
		case 5: $badgeBragProduct->notificationText = 'The Aficionado - 0 Star';
			  $badgeBragProduct->bbucks = 1000;
			  $badgeBragProduct->triggeredAt = 45;
			break;
		case 6: $badgeBragProduct->notificationText = 'The Aficionado - 1 Star';
			  $badgeBragProduct->bbucks = 2500;
			  $badgeBragProduct->triggeredAt = 85;
			break;
		case 7: $badgeBragProduct->notificationText = 'The Aficionado - 2 Star';
			  $badgeBragProduct->bbucks = 3000;
			  $badgeBragProduct->triggeredAt = 150;
			break;
		case 8: $badgeBragProduct->notificationText = 'The Aficionado - 3 Star';
			  $badgeBragProduct->bbucks = 3500;
			  $badgeBragProduct->triggeredAt = 200;
			break;
		case 9: $badgeBragProduct->notificationText = 'The Connoisseur - 0 Star';
			  $badgeBragProduct->bbucks = 4500;
			  $badgeBragProduct->triggeredAt = 250;
			break;
		case 10: $badgeBragProduct->notificationText = 'The Connoisseur - 1 Star';
			  $badgeBragProduct->bbucks = 5000;
			  $badgeBragProduct->triggeredAt = 350;
			break;
		case 11: $badgeBragProduct->notificationText = 'The Connoisseur - 2 Star';
			  $badgeBragProduct->bbucks = 6000;
			  $badgeBragProduct->triggeredAt = 450;
			break;
		case 12: $badgeBragProduct->notificationText = 'The Connoisseur - 3 Star';
			  $badgeBragProduct->bbucks = 7000;
			  $badgeBragProduct->triggeredAt = 550;
			break;
		case 13: $badgeBragProduct->notificationText = 'The Curator - 0 Star';
			  $badgeBragProduct->bbucks = 10000;
			  $badgeBragProduct->triggeredAt = 750;
			break;
		case 14: $badgeBragProduct->notificationText = 'The Curator - 1 Star';
			  $badgeBragProduct->bbucks = 12000;
			  $badgeBragProduct->triggeredAt = 950;
			break;
		case 15: $badgeBragProduct->notificationText = 'The Curator - 2 Star';
			  $badgeBragProduct->bbucks = 14000;
			  $badgeBragProduct->triggeredAt = 1200;
			break;
		case 16: $badgeBragProduct->notificationText = 'The Curator - 3 Star';
			  $badgeBragProduct->bbucks = 15000;
			  $badgeBragProduct->triggeredAt = 1500;
			break;
	}
	$bragBadges[$i] = $badgeBragProduct;
}

$buyBadges = array();
for($i = 1; $i <= 16; $i++)
{
	$badgeBuyProduct =  new badgeDetails;
	$badgeBuyProduct->type = 6;
	$badgeBuyProduct->typeDesc = 'You get these badges when you purchase products by making prepaid payments and completing the orders';
	$badgeBuyProduct->level = $i;
	switch($i)
	{
		case 1: $badgeBuyProduct->notificationText = 'The Newbie Shopper - 0 Star';
			  $badgeBuyProduct->bbucks = 1500;
			  $badgeBuyProduct->triggeredAt = 1;
			break;
		case 2: $badgeBuyProduct->notificationText = 'The Newbie Shopper - 1 Star';
			  $badgeBuyProduct->bbucks = 2500;
			  $badgeBuyProduct->triggeredAt = 2;
			break;
		case 3: $badgeBuyProduct->notificationText = 'The Newbie Shopper - 2 Star';
			  $badgeBuyProduct->bbucks = 3500;
			  $badgeBuyProduct->triggeredAt = 3;
			break;
		case 4: $badgeBuyProduct->notificationText = 'The Newbie Shopper - 3 Star';
			  $badgeBuyProduct->bbucks = 4000;
			  $badgeBuyProduct->triggeredAt = 4;
			break;
		case 5: $badgeBuyProduct->notificationText = 'The Serious Shopper - 0 Star';
			  $badgeBuyProduct->bbucks = 8000;
			  $badgeBuyProduct->triggeredAt = 5;
			break;
		case 6: $badgeBuyProduct->notificationText = 'The Serious Shopper - 1 Star';
			  $badgeBuyProduct->bbucks = 10000;
			  $badgeBuyProduct->triggeredAt = 6;
			break;
		case 7: $badgeBuyProduct->notificationText = 'The Serious Shopper - 2 Star';
			  $badgeBuyProduct->bbucks = 12000;
			  $badgeBuyProduct->triggeredAt = 7;
			break;
		case 8: $badgeBuyProduct->notificationText = 'The Serious Shopper - 3 Star';
			  $badgeBuyProduct->bbucks = 15000;
			  $badgeBuyProduct->triggeredAt = 12;
			break;
		case 9: $badgeBuyProduct->notificationText = 'The Veteran Shopper - 0 Star';
			  $badgeBuyProduct->bbucks = 20000;
			  $badgeBuyProduct->triggeredAt = 15;
			break;
		case 10: $badgeBuyProduct->notificationText = 'The Veteran Shopper - 1 Star';
			  $badgeBuyProduct->bbucks = 25000;
			  $badgeBuyProduct->triggeredAt = 20;
			break;
		case 11: $badgeBuyProduct->notificationText = 'The Veteran Shopper - 2 Star';
			  $badgeBuyProduct->bbucks = 35000;
			  $badgeBuyProduct->triggeredAt = 25;
			break;
		case 12: $badgeBuyProduct->notificationText = 'The Veteran Shopper - 3 Star';
			  $badgeBuyProduct->bbucks = 45000;
			  $badgeBuyProduct->triggeredAt = 30;
			break;
		case 13: $badgeBuyProduct->notificationText = 'The Shopaholic - 0 Star';
			  $badgeBuyProduct->bbucks = 55000;
			  $badgeBuyProduct->triggeredAt = 45;
			break;
		case 14: $badgeBuyProduct->notificationText = 'The Shopaholic - 1 Star';
			  $badgeBuyProduct->bbucks = 75000;
			  $badgeBuyProduct->triggeredAt = 50;
			break;
		case 15: $badgeBuyProduct->notificationText = 'The Shopaholic - 2 Star';
			  $badgeBuyProduct->bbucks = 100000;
			  $badgeBuyProduct->triggeredAt = 65;
			break;
		case 16: $badgeBuyProduct->notificationText = 'The Shopaholic - 3 Star';
			  $badgeBuyProduct->bbucks = 125000;
			  $badgeBuyProduct->triggeredAt = 100;
			break;
	}
	$buyBadges[$i] = $badgeBuyProduct;
}

?>
