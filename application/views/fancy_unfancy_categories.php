<input type="hidden" id="sid" value=""/> <input type="hidden" id="pid" value=""/>
<div class="FancyPopupContainer" id="FancyPopupContainer">
	<div class="FancyPopupWrapper">
		<div class="FancyPopupTransp"></div>
		<div class="FancyPopupActual">
			<div class="headingAndClose">
				<div class="Addtofancytext">ADD TO FANCY LISTS</div>
				<div class="PopupClose" id="popUpClose1"></div>
			</div>
			<div class="leftRightPop">
				<div class="leftPop fl">
					<div class="ImageHolder"><img id="f_img" width="322" height="313"/>

						<div class="fanciedholder">
							<div class="fancyBg">
								<div class="fanciedimage"></div>
								<div class="fanciedText">FANCIED</div>
							</div>
						</div>
						<!-- <div class="fl"> <div class="storeDecoratingText"><?php echo $products[0]->product_name; ?></div> <div class="storeDecoratingText font12"><?php echo $products[0]->product_name; ?></div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle"><?php echo $products[0]->fancy_counter; ?></div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> -->
						<!--<div class="priceHolder"><span class="rupee">`</span> <?php echo intval($products[0]->selling_price); ?></div>-->
					</div>
				</div>
				<div class="rightest">
					<div class="rightPop2" id="popup_category"></div>
					<div class="createNewList2"><input type="text" placeholder="create a new list" name="newlist"
					                                   id="fancylist"/>
						<button type="button" id="plusText" class="plusText" onclick="addlist()">+</button>
						<!-- <div class="radioText"> <div class="radio1 pradio"><input type="radio" id="public1" name="cards" checked="checked"/></div> <div class="checkText">Public</div> </div> <div class="radioText"> <div class="radio1 pradio"><input type="radio" id="private1" name="cards"/></div> <div class="checkText">Private</div> </div>-->
					</div>
				</div>
			</div>
			<div class="bottomButton">
				<button class="prod_continue" style="width:160px;" id="addtolist" type="submit"
				        onclick="fancy_product_add();">Add to Lists
				</button>
				</form>
				<!-- <div class="checkBoxText2"> <div class="checkbox"><input type="checkbox" name="check2"/></div> <div class="checkText2">Don�t show Lists anymore</div> </div>-->
			</div>
		</div>
	</div>
</div>
<div class="FancyPopupContainer" id="EditPopupContainer">
	<div class="FancyPopupWrapper">
		<div class="FancyPopupTransp"></div>
		<div class="FancyPopupActual">
			<div class="headingAndClose">
				<div class="Addtofancytext">ADD TO FANCY LISTS</div>
				<div class="PopupClose" id="popUpClose2"></div>
			</div>
			<div class="leftRightPop">
				<div class="leftPop fl">
					<div class="ImageHolder"><img id="uf_img" width="322" height="313"/>

						<div class="fanciedholder">
							<div class="fancyBg">
								<div class="fanciedimage"></div>
								<div class="fanciedText">FANCIED</div>
							</div>
						</div>
						<!-- <div class="fl"> <div class="storeDecoratingText"><?php echo $products[0]->product_name; ?></div> <div class="storeDecoratingText font12"><?php echo $products[0]->product_name; ?></div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle"><?php echo $products[0]->fancy_counter; ?></div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> <?php echo intval($products[0]->selling_price); ?></div>-->
					</div>
				</div>
				<div class="rightest">
					<div class="rightPop2" id="popup_category1"></div>
					<div class="createNewList2"><input type="text" placeholder="create a new list" name="newlist"
					                                   id="unfancylist"/>
						<button type="button" id="plusText" class="plusText" onclick="addlist1()">+</button>
						<!-- <div class="radioText"> <div class="radio1 pradio"><input type="radio" id="public2" name="cards" checked="checked"/></div> <div class="checkText">Public</div> </div> <div class="radioText"> <div class="radio1 pradio"><input type="radio" id="private2" name="cards"/></div> <div class="checkText">Private</div> </div>-->
					</div>
					<!-- <button class="updateList" type="button" onclick="fancy_product_updt();">Update List</button>-->
				</div>
			</div>
			<div class="bottomButton">
				<button class="prod_continue" id="unfancy" type="submit" onclick="fancy_product_del();">Unfancy</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function fancy_product_add() {
		var store_id = $("#sid").val();
		var product_id = $("#pid").val();
		$("#hoverText" + product_id).html("FANCIED");
		$("#hoverFancy" + product_id).removeClass('hoverFancy');
		$("#hoverFancy" + product_id).addClass('hoverFancyNext');
		var postdata = [];
		$('#checkbox input[name="checkbox5"]:checked').each(function () {
			postdata.push($(this).val()); //push each val into the array
		});
		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_addlist?store_id=' + store_id + '&product_id=' + product_id + '&postdata=' + postdata,
			success: function (data) {
				//window.location.reload();
				//document.getElementById("fancy_hidden").value=2;
				$('#fan').html(data);
			}
		});
	}
	function fancy_product_del() {
		var store_id = $("#sid").val();
		var product_id = $("#pid").val();
		$("#hoverText" + product_id).html("FANCY");
		$("#hoverFancy" + product_id).removeClass('hoverFancyNext');
		$("#hoverFancy" + product_id).removeClass('editFancynext');
		$("#hoverFancy" + product_id).addClass('hoverFancy');

		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_unfancy?store_id=' + store_id + '&product_id=' + product_id,
			success: function (data) {
				// window.location.reload();
				// document.getElementById("fancy_hidden").value=1;
				//$('#fan').html(data);
			}
		});

	}
	function addlist() {
		var store_id = $("#sid").val();
		var product_id = $("#pid").val();
//var type=$('#fancy_hidden').val();
		var name = $('#fancylist').val();

		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_list_add?store_id=' + store_id + '&product_id=' + product_id + '&name=' + name,
			success: function (data) {
				//document.getElementById("fancy_hidden").value=1;
				$('#popup_category').html(data);
				//document.getElementById("fancy_hidden").value=2;
				//$('#popup_category1').html(data);
			}
		});
	}
	function addlist1() {
		var store_id = $("#sid").val();
		var product_id = $("#pid").val();
//var type=$('#fancy_hidden').val();
		var name = $('#unfancylist').val();

		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_list_add?store_id=' + store_id + '&product_id=' + product_id + '&name=' + name,
			success: function (data) {
				//document.getElementById("fancy_hidden").value=1;
				$('#popup_category1').html(data);
				//document.getElementById("fancy_hidden").value=2;
				//$('#popup_category1').html(data);
			}
		});
	}
	function fancy_product_updt() {
		var store_id = $("#sid").val();
		var product_id = $("#pid").val();
		var postdata = [];
		$('#checkbox input[name="checkbox5"]:checked').each(function () {
			postdata.push($(this).val()); //push each val into the array
		});
		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_update?store_id=' + store_id + '&product_id=' + product_id + '&postdata=' + postdata,
			success: function (data) {
				// document.getElementById("fancy_hidden").value=1;
				//$('#fan').html(data);
			}
		});
	}
</script>