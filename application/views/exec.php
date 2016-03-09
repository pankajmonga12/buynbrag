<script type="text/javascript">
	$(".drop").selectbox();
</script> <?php $value = $q; $type = $typeID; if ($type == 1) {
	if ($value == "1") { ?> <select class="drop" name="sub_category" id="sub_category"
	                                onChange="showCategories(this.value,2)">
		<option value="00" selected="selected" disabled="disabled">select sub category</option>
		<option value="6">Furniture</option>
		<option value="7">Dining &amp; Entertaining</option>
		<option value="8">Decor &amp; Accessories</option>
		<option value="9">Outdoor</option>
		<option value="10">Lighting</option>
	</select> <?php } else { ?> <select class="drop" name="sub_category_home2" id="sub_category_home2">
		<option value="00">select sub category</option>
	</select> <?php }
} if ($type == 2) {
	if ($value == "6") { ?> <select class="drop" name="sub2_category" id="sub2_category"
	                                onChange="showCategories(this.value,3)">
		<option value="000" selected="selected" disabled="disabled">select sub sub category</option>
		<option value="11">Living Room</option>
		<option value="12">Dining &amp; Kitchen Furniture</option>
		<option value="13">Bedroom</option>
		<option value="14">Home Office</option>
		<option value="15">Entry Way</option>
	</select> <?php }
	if ($value == "DiningEntertaining") { ?> <select class="drop" name="sub2_category_dining" id="sub2_category_dining"
	                                                 onChange="showCategories(this.value,3)">
		<option value="select category" selected="selected" disabled="disabled">select sub sub category</option>
		<option value="Dinnerware">Dinnerware</option>
		<option value="Drinkware">Drinkware</option>
		<option value="Flatware">Flatware</option>
		<option value="Serverware">Serverware</option>
		<option value="TableLinens">Table Linens</option>
	</select> <?php }
	if ($value == "DecorAccessories") { ?> <select class="drop" name="sub2_category_decor" id="sub2_category_decor"
	                                               onChange="showCategories(this.value,3)">
		<option value="select category" selected="selected" disabled="disabled">select sub sub category</option>
		<option value="CarpetsRugs">Carpets &amp; Rugs</option>
		<option value="CushionsDecor">Cushions</option>
		<option value="CurtainsHardware">Curtains &amp; Hardware</option>
		<option value="CandlesCandleHoldersVasesFragrances">Candles,Candle holders, Vases &amp; Fragrances</option>
		<option value="HomeAccessories">Home Accessories</option>
	</select> <?php }
	if ($value == "Outdoor") { ?> <select class="drop" name="sub2_category_outdoor" id="sub2_category_outdoor"
	                                      onChange="showCategories(this.value,3)">
		<option value="select category" selected="selected" disabled="disabled">select sub sub category</option>
		<option value="Dining">Dining</option>
		<option value="Lounging">Lounging</option>
		<option value="Umbrellas">Umbrellas</option>
		<option value="CushionsOutdoor">Cushions</option>
		<option value="LightingLanterns">Lighting &amp; Lanterns</option>
	</select> <?php }
	if ($value == "Lighting") { ?> <select class="drop" name="sub2_category_lighting" id="sub2_category_lighting"
	                                       onChange="showCategories(this.value,3)">
		<option value="select category" selected="selected" disabled="disabled">select sub sub category</option>
		<option value="Ceiling">Ceiling</option>
		<option value="TableTaskLamp">Table &amp; Task Lamp</option>
		<option value="Sconces">Sconces</option>
		<option value="OutdoorLighting">OutdoorLighting</option>
		<option value="ShadesAndAccessories">Shades and Accessories</option>
	</select> <?php }
} if ($type == 3) {
	if ($value == "11") { ?> <select class="drop" name="sub3_category" id="sub3_category">
		<option value="0000" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="16">Sofas</option>
		<option value="17">Sleeper Sofas</option>
		<option value="18">Chairs</option>
		<option value="19">Day beds</option>
		<option value="20">Ottomans</option>
	</select> <?php }
	if ($value == "DiningKitchenFurniture") { ?> <select class="drop" name="sub3_category_kitchen"
	                                                     id="sub3_category_kitchen">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="DiningSets">Dining Sets</option>
		<option value="DiningTables">Dining Tables</option>
		<option value="DiningChairs">Dining Chairs</option>
		<option value="Barstools">Barstools</option>
		<option value="ChairCushions">Chair Cushions</option>
	</select> <?php }
	if ($value == "Bedroom") { ?> <select class="drop" name="sub3_category_bedroom" id="sub3_category_bedroom">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="Beds">Beds</option>
		<option value="Mattresses">Mattresses</option>
		<option value="Nightstands">Nightstands</option>
		<option value="DressersChests">Dressers &amp; Chests</option>
		<option value="Armoires">Armoires</option>
	</select> <?php }
	if ($value == "HomeOffice") { ?> <select class="drop" name="sub3_category_ho" id="sub3_category_ho">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="Desks">Desks</option>
		<option value="Office Chairs">Office Chairs</option>
		<option value="Book Cases">Book Cases</option>
		<option value="Cabinets">Cabinets</option>
		<option value="FillingCabinets">Filling Cabinets</option>
	</select> <?php }
	if ($value == "EntryWay") { ?> <select class="drop" name="sub3_category_entry" id="sub3_category_entry">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="Chests">Chests</option>
		<option value="Cabinets">Cabinets</option>
		<option value="Tables">Tables</option>
		<option value="EntrywayBenches">Entryway Benches</option>
	</select> <?php }
	if ($value == "Dinnerware") { ?> <select class="drop" name="sub3_category_dinner" id="sub3_category_dinner">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="DinnerwareSets">Dinnerware Sets</option>
		<option value="DinnerPlatesBuffetChargerPlates">Dinner Plates,Buffet &amp; Charger Plates</option>
		<option value="AppetizersDessertPlates">Appetizers &amp; Dessert Plates</option>
		<option value="IndividualBowls">Individual Bowls</option>
	</select> <?php }
	if ($value == "Drinkware") { ?> <select class="drop" name="sub3_category_drink" id="sub3_category_drink">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="WineGlasses">Wine Glasses</option>
		<option value="ChampagneFlutes">Champagne Flutes</option>
		<option value="BarDrinkingGlasses">Bar &amp; Drinking Glasses</option>
		<option value="BarAccessories">Bar Accessories</option>
		<option value="PitchersDecanters">Pitchers &amp; Decanters</option>
	</select> <?php }
	if ($value == "Flatware") { ?> <select class="drop" name="sub3_category_flat" id="sub3_category_flat">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="PlaceSettings">Place Settings</option>
		<option value="FlatwareSets">Flatware Sets</option>
		<option value="ServingPlatesSets">Serving Plates &amp; Sets</option>
		<option value="SteakKnives">Steak Knives</option>
	</select> <?php }
	if ($value == "Serverware") { ?> <select class="drop" name="sub3_category_server" id="sub3_category_server">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="ServingPlatters">Serving Platters</option>
		<option value="ServingBowls">Serving Bowls</option>
		<option value="AppetizerDessertPlates">Appetizer &amp; Dessert Plates</option>
		<option value="BuffetPlates">Buffet Plates</option>
		<option value="Teapots">Teapots</option>
	</select> <?php }
	if ($value == "TableLinens") { ?> <select class="drop" name="sub3_category_linens" id="sub3_category_linens">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="Placemats">Placemats</option>
		<option value="TableCloths">Table Cloths</option>
		<option value="Napkins">Napkins</option>
		<option value="TableRunners">Table Runners</option>
	</select> <?php }
	if ($value == "CarpetsRugs") { ?> <select class="drop" name="sub3_category_carpet" id="sub3_category_carpet">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="SilkCarpets">Silk Carpets</option>
		<option value="AreaRugs">Area Rugs</option>
		<option value="OutdoorRugs">Outdoor Rugs</option>
		<option value="RoundRugs">Round Rugs</option>
		<option value="FloorRunners">Floor Runners</option>
	</select> <?php }
	if ($value == "CushionsDecor") { ?> <select class="drop" name="sub3_category_cushion" id="sub3_category_cushion">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="DecorativeCushions">Decorative Cushions</option>
		<option value="FloorCushions">Floor Cushions</option>
		<option value="OutdoorCushions">Outdoor Cushions</option>
		<option value="CushionInserts">Cushion Inserts</option>
	</select> <?php }
	if ($value == "CurtainsHardware") { ?> <select class="drop" name="sub3_category_curtain" id="sub3_category_curtain">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="Curtains">Curtains</option>
		<option value="Hardware">Hardware</option>
	</select> <?php }
	if ($value == "CandlesCandleHoldersVasesFragrances") { ?> <select class="drop" name="sub3_category_candles"
	                                                                  id="sub3_category_candles">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="Candles">Candles</option>
		<option value="CandleHolders">Candle Holders</option>
		<option value="Vases">Vases</option>
	</select> <?php }
	if ($value == "HomeAccessories") { ?> <select class="drop" name="sub3_category_ha" id="sub3_category_ha">
		<option value="select category" selected="selected" disabled="disabled">select sub sub sub category</option>
		<option value="Baskets">Baskets</option>
		<option value="CentrepieceBowls">Centrepiece Bowls</option>
		<option value="FramesLedges">Frames &amp; Ledges</option>
		<option value="HomeAccents">Home Accents</option>
		<option value="MagazineRacks">Magazine Racks</option>
	</select> <?php }
	if (($value == 'Dining') || ($value == 'Lounging') || ($value == 'Umbrellas') || ($value == 'CushionsOutdoor') || ($value == 'LightingLanterns') || ($value == 'Ceiling') || ($value == 'TableTaskLamp') || ($value == 'Sconces') || ($value == 'OutdoorLighting') || ($value == 'ShadesAndAccessories')) { ?>
		<select class="drop" name="sub3_category_noval" id="sub3_category_noval">
			<option value="select category">select sub sub sub category</option>
		</select> <?php }
} ?>