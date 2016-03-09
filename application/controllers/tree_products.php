<?php
class Tree_products extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('categoriesdb');
		$this->load->model('saledb');
		$this->load->model('poll_model');
		$this->config->load('payu', TRUE);
		/*
		//Added by lee
		$url_suffix = $this->config->item('url_suffix'); //Gets the Url suffix if any is set in config file.
		$current_url = current_url(); //Gets the current url. e.g.: http(s)://www.hostname.com/index.php/[controller]/[function]/[param1]/[param2]
		if (!empty($url_suffix))
			$current_url = strstr($current_url, $url_suffix, TRUE);
		$curl = explode('/', $current_url);
		$site_url = explode('/', site_url()); //Gets the site url. e.g.: http(s)://www.hostname.com/index.php
		$params = array_diff($curl, $site_url); //Seperates the [controller]/[function]/[param1]/[param2] and is stored in $params.
		$page = implode('/', $params);
		log_message('Info', "User with userid: " . $this->session->userdata('id') . " and ip: " . $this->input->ip_address() . " is accessing: $page.");

		if (!$this->session->userdata('id')) {
			//Added by lee
			log_message('Info', "User Session Broke for the user with ip: " . $this->input->ip_address() . " While he was in: $page via ajax.");
			$red_url = base_url('user_info/homepage_afterlogin');
			redirect($red_url);
		}
		*/
		$data['base_url'] = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];

	}

	function sub_prod($sssc_id, $sssc_type = 1)
	{

		$base_url = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$store_url = $myconfig['store_url'];
		$products = $this->categoriesdb->get_sub_prod(0, $sssc_id, $sssc_type, 0, 0, 1, "0000000", array(''));
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
			//anant fancy
			$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
			//var_dump($fancy);
			$fancy_array = array();
			$i = 0;
			foreach ($fancy as $key => $val)
			{
				foreach ($val as $key => $prod_id)
				{
					//var_dump ($prod_id);
					$fancy_array[$i] = $prod_id;
					$i++;
				}
			}
			$fancied = array_unique($fancy_array);
			$fancied_products = array_merge($fancied);
			foreach ($fancied_products as $f_item)
			{
				$fancied_prods[$f_item] = 1;
 			}
			//thejas polls
			$p_prod = $this->poll_model->my_poll_products($this->session->userdata('id'));
		}
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css" />
		<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
		<script type="text/javascript">
			$(function () {
				var totalScroll = 0;

				$(".button_left_style").click(function () {
					if (totalScroll <= 0) return;
					totalScroll = totalScroll - 760;
					$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
				});
				$(".button_right_style").click(function () {

					var x =<?php echo ceil(count($products)/3); ?>;
					if (x == 1) {
					} else {
						maxScroll = parseInt($(".slider").css("width")) - parseInt($(".sliderParentDiv").width());
						if (totalScroll > maxScroll) return;
						totalScroll = totalScroll + 760;
						$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
						var totalWidth = x * 760;
						$("#slider").css("width", totalWidth + "px");
					}
				});
			});
		</script>
		<?php
		include 'fancy_script.php';
		foreach ($p_prod as $p_item)
		{
			$poll_prods[$p_item->product_id] = 1;
		}
		?>
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">

				<div class="slider" id="slider">
					<?php for ($i = 0; $i < count($products); $i++): ?>
						<?php
						if (($i % 3) == 0) {
							$class = "store-list paddingLeft0";
						} else {
							$class = "store-list";
						}
						?>
						<div class="<?php echo $class; ?>">
							<div class="rightPanelImageHolder1">
								<a href="<?php echo $base_url?>order/product_page/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>">
									<img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>/img1_240x200.jpg"/>
								</a>

								<div class="storeDecoratingText pro_name"><?php echo $products[$i]->product_name; ?></div>
								<div class="fl">

									<div class="storeDecoratingText font12 stor_nm"><?php echo $products[0]->store_name; ?></div>
									<div class="storeFancyHolder">
										<div class="fanciedIcon"></div>
										<div class="fancyNumber storeExtraStyle"><?php echo $products[$i]->fancy_counter; ?></div>
										<div class="fancyText storeExtraStyle">fancied</div>
									</div>
								</div>


								<!-- added by Rajeeb-->
								<?php if ($products[$i]->is_on_discount == 0) { ?>
									<div class="priceHolder"><span class="rupee">`</span>
										<?php echo intval($products[$i]->selling_price); ?>

									</div>


								<?php } else { ?>
									<div class="priceHolder" style="height:40px;">
										<div><span class="rupee">`</span>
											<del><?php echo intval($products[$i]->selling_price); ?></del>
										</div>
										<div><span
												class="rupee">`</span> <?php echo intval($products[$i]->selling_price - $products[$i]->discount); ?>
										</div>
									</div>
								<?php }?>
								<!-- End-->
							</div>

							<div class="hoverHolder">
								<div class="fancyHolder">
									<?php if (isset($fancied_prods[$products[$i]->product_id])): ?>
										<input type="hidden" value="<?php echo $i + 1; ?>" class="hiddenFieldDiv1"/>
										<input type="hidden" value="<?php echo $products[$i]->store_id; ?>"
										       class="hiddenFieldStoreid"/>
										<input type="hidden" value="<?php echo $products[$i]->product_id; ?>"
										       class="hiddenFieldProductid"/>
										<div class="hoverFancyNext" id="hoverFancy<?php echo $i + 1; ?>"></div>
										<div class="hoverText" id="hoverText<?php echo $i + 1; ?>">FANCIED</div>
									<?php else: ?>
										<input type="hidden" value="<?php echo $i + 1; ?>" class="hiddenFieldDiv1"/>
										<input type="hidden" value="<?php echo $products[$i]->store_id; ?>"
										       class="hiddenFieldStoreid"/>
										<input type="hidden" value="<?php echo $products[$i]->product_id; ?>"
										       class="hiddenFieldProductid"/>
										<div class="hoverFancy" id="hoverFancy<?php echo $i + 1; ?>"></div>
										<div class="hoverText" id="hoverText<?php echo $i + 1; ?>">FANCY</div>
									<?php endif; ?>
								</div>
								<?php if (isset($poll_prods[$products[$i]->product_id])) : ?>
									<div class="PollHolder">
										<div class="hoverPoll"
										     style="background-image: url('<?php echo $base_url; ?>assets/images/polled.png');"></div>
										<div class="hoverText">POLLED</div>
									</div>
								<?php else: ?>
									<div id="poll_<?php echo $products[$i]->product_id; ?>" class="PollHolder">
										<div class="hoverPoll"
										     onClick="return AddPoll(<?php echo $products[$i]->product_id; ?>)"></div>
										<div class="hoverText">POLL</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endfor; ?>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	<?php
	}


	function sub_prod2($sssc_id, $sssc_type = 0, $page_type = 0)
	{
		$base_url = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$store_url = $myconfig['store_url'];
		$cat_id = $this->input->get('cat_id', TRUE);
		$price1 = 0;
		$price2 = 0;
		$sort_price = 0;
		$price1 = (int)$this->input->get('price1', TRUE);
		$price2 = (int)$this->input->get('price2', TRUE);
		$sort_price = (int)$this->input->get('sort_price', TRUE);
		$range_bits = $this->input->get('range_bits', TRUE);
		$sale_id = $this->input->get('sale_id', TRUE); //Sale page
		$occasion = $this->input->get('occasion', TRUE); //occasion page
		$occasions = $this->input->get('occasions', TRUE); //cat prod page occasions filter
		$occasions = explode(',', $occasions);
		if ($page_type == 4) //occasions page(Diwali,Christmas etc)
			$products = $this->categoriesdb->get_prod_occ($occasion, $price1, $price2, $sort_price, $range_bits, $sssc_id, $sssc_type);
		elseif ($page_type == 5) //Sale page(SSScategory wise)
		{
			$products = $this->saledb->get_prod_sales($sale_id, $price1, $price2, $sort_price, $range_bits);
		}
		elseif ($sssc_type > 0)
		{
			$products = $this->categoriesdb->get_sub_prod(0, $sssc_id, $sssc_type, $price1, $price2, $sort_price, $range_bits, $occasions);
		}
		else
		{
			$products = $this->categoriesdb->get_sub_prod($cat_id, $sssc_id, $sssc_type, $price1, $price2, $sort_price, $range_bits, $occasions);
		}
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
			//Fancy - Ananth
			$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
			//var_dump($fancy);
			$fancy_array = array();
			$i = 0;
			foreach ($fancy as $key => $val)
			{
				foreach ($val as $key => $prod_id)
				{
					//var_dump ($prod_id);
					$fancy_array[$i] = $prod_id;
					$i++;
				}
			}
			$fancied = array_unique($fancy_array);
			$fancied_products = array_merge($fancied);
			foreach ($fancied_products as $f_item)
			{
				$fancied_prods[$f_item] = 1;
			}
			// END Fancy
			//thejas polls
			$p_prod = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($p_prod as $p_item)
			{
				$poll_prods[$p_item->product_id] = 1;
			}
		}
		include 'fancy_script.php';
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
		<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
		<script type="text/javascript">
			$(function () {
				var totalScroll = 0;

				$(".button_left_style").click(function () {
					if (totalScroll <= 0) return;
					totalScroll = totalScroll - 760;
					$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
				});

				$(".button_right_style").click(function () {

					var x =<?php echo ceil(count($products)/3); ?>;
					if (x == 1) {
					} else {
						maxScroll = parseInt($(".slider").css("width")) - parseInt($(".sliderParentDiv").width());
						if (totalScroll > maxScroll) return;
						totalScroll = totalScroll + 760;
						$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
						var totalWidth = x * 760;
						$("#slider").css("width", totalWidth + "px");
					}
				});
			});
		</script>

		<?php for ($i = 0; $i < count($products); $i++): ?>
		<?php
		if (($i % 3) == 0) {
			$class = "rightPanelImageHolders clear_both";
			$class2 = "discountContainer";
		} elseif (($i % 3) == 1) {
			$class = "rightPanelImageHolders";
			$class2 = "discountContainer";
		} elseif (($i % 3) == 2) {
			$class = "rightPanelImageHolders productMarginNone";
			$class2 = "discountContainer rightStyle";
		}
		?>


		<div class="store-list1 message_box" id="<?php echo $products[$i]->product_id; ?>">
			<?php if ($products[$i]->is_on_discount == 1): ?>
				<div class="<?php echo $class2; ?>">
					<div
						class="numberPercent"><?php echo (floor($products[$i]->discount / $products[$i]->selling_price * 100)); ?> </div>
					<div class="percentSign">%</div>
					<div class="offPercent clear_both">OFF</div>
				</div>
			<?php endif; ?>
			<div class="<?php echo $class; ?> ">

				<a href="<?php echo $base_url?>order/product_page/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>">
					<img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>/img1_240x200.jpg"/>
				</a>

				<div class="storeDecoratingText"><?php echo $products[$i]->product_name; ?></div>
				<div class="fl">

					<div class="storeDecoratingText stor_nm font12"><?php echo $products[$i]->store_name; ?></div>
					<div class="storeFancyHolder">
						<div class="fanciedIcon"></div>
						<div class="fancyNumber storeExtraStyle"><?php echo $products[$i]->fancy_counter; ?></div>
						<div class="fancyText storeExtraStyle">fancied</div>
					</div>
				</div>
				<?php if ($products[$i]->is_on_discount == 0) { ?>
					<div class="priceHolder"
					     perc="<?php echo floor($products[$i]->discount / $products[$i]->selling_price * 100); ?>"
					     id="<?php echo intval($products[$i]->selling_price); ?>"><span class="rupee">`</span>
						<?php echo intval($products[$i]->selling_price); ?>

					</div>

				<?php } else { ?>
					<div class="priceHolder"
					     perc="<?php echo floor($products[$i]->discount / $products[$i]->selling_price * 100); ?>"
					     id="<?php echo intval($products[$i]->selling_price - $products[$i]->discount); ?>"
					     style="height:40px;  width:85px">
						<div><span class="rupee">`</span>
							<del><?php echo intval($products[$i]->selling_price); ?></del>
						</div>
						<div><span
								class="rupee">`</span> <?php echo intval($products[$i]->selling_price - $products[$i]->discount); ?>
						</div>
					</div>
				<?php }?>
			</div>
			<div class="hoverHolder">
				<div class="fancyHolder showtooltip" title="Love It? FANCY It!" id="fancyHolder<?php echo $products[$i]->product_id; ?>" onClick="<?php echo (isset($fancied_prods[$products[$i]->product_id])) ? "unFancyProduct(" . $products[$i]->product_id . ", this.id)" : "fancyProduct(" . $products[$i]->product_id . ", this.id)";?>">
					<?php if (isset($fancied_prods[$products[$i]->product_id])): ?>
						<input type="hidden" value="<?php echo $products[$i]->product_id; ?>" class="hiddenFieldDiv1"
						       id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/>
						<input type="hidden" value="<?php echo $products[$i]->store_id; ?>" class="hiddenFieldStoreid"/>
						<input type="hidden" value="<?php echo $products[$i]->product_id; ?>"
						       class="hiddenFieldProductid"/>
						<div class="hoverFancyNext" id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
						<div class="hoverText" id="hoverText<?php echo $products[$i]->product_id; ?>">FANCIED</div>
					<?php else: ?>
						<input type="hidden" value="<?php echo $products[$i]->product_id; ?>" class="hiddenFieldDiv1"
						       id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/>
						<input type="hidden" value="<?php echo $products[$i]->store_id; ?>" class="hiddenFieldStoreid"/>
						<input type="hidden" value="<?php echo $products[$i]->product_id; ?>"
						       class="hiddenFieldProductid"/>
						<div class="hoverFancy" id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
						<div class="hoverText" id="hoverText<?php echo $products[$i]->product_id; ?>">FANCY</div>
					<?php endif; ?>
				</div>
				<?php if (isset($brag_prods[$products[$i]->product_id])) : ?>
					<div class="PollHolder showtooltip" title="Brag On FB!">
						<div class="hoverBrag"
						     style="background-image: url('<?php echo $base_url; ?>assets/images/brag_pink.png');"></div>
						<div class="hoverText">BRAGGED!</div>
					</div>
				<?php else: ?>
					<div id="brag_<?php echo $products[$i]->product_id; ?>" class="PollHolder showtooltip" title="Brag On FB!">
						<div class="hoverBrag" onClick="return brag(<?php echo $products[$i]->product_id; ?>, <?php echo $products[$i]->store_id; ?>, '<?php echo substr($products[$i]->product_name,0,42); ?>')"></div>
						<div class="hoverText">BRAG!</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endfor; ?>

		<div id="more_1" class="slideBackground moreWidthStyleProduct">
			<div class="slideNormal" id="slideNormal_1"></div>
		</div>

	<?php
	}


	function sub_stores($sssc_id, $sssc_type = 1)
	{
		$base_url = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$store_url = $myconfig['store_url'];
		$store = $this->categoriesdb->get_sub_stores($sssc_id, $sssc_type);
		$sprod = array();
		foreach ($store as $st_id) {
			$key = '_' . $st_id->store_id;
			$var = array($key => $this->categoriesdb->sub_catstoreprod($sssc_id, $sssc_type, $st_id->store_id));
			$sprod = array_merge($sprod, $var);
		}
		?>
		<script type="text/javascript">
		$(function () {
			var totalScroll2 = 0;

			$(".button_left_style2").click(function () {
				if (totalScroll2 <= 0) return;
				totalScroll2 = totalScroll2 - 768;
				$('.sliderParentDiv2').animate({scrollLeft: totalScroll2}, 1550);
			});

			$(".button_right_style2").click(function () {
				var x2 =<?php echo ceil(count($store)/2); ?>;
				if (x2 == 1) {
				} else {
					maxScroll = parseInt($(".slider2").css("width")) - parseInt($(".sliderParentDiv2").width());
					if (totalScroll2 > maxScroll) return;
					totalScroll2 = totalScroll2 + 768;
					$('.sliderParentDiv2').animate({scrollLeft: totalScroll2}, 1550);
					var totalWidth2 = x2 * 768;
					$("#slider2").css("width", totalWidth2 + "px");
				}
			});
		});
		</script>
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">

				<div class="slider2" id="slider2">
					<?php for ($i = 0; $i < count($store); $i++): $sid = '_' . $store[$i]->store_id; ?>

						<?php
						//Generate a random number for fetching images -AS
						$max = count($sprod["$sid"]) - 1;
						$tm1 = mt_rand(0, $max);
						$tm2 = mt_rand(0, $max);
						$tm3 = mt_rand(0, $max);
						//Condition check for slider -AS
						if (($i % 2) == 0) {
							$class = "store-list2 paddingLeft0";
						} else {
							$class = "store-list2";
						}
						?>
						<div class="<?php echo $class; ?>">
							<a href="<?php echo $base_url?>order/store_page/<?php echo $store[$i]->store_id; ?>">
								<div class="images_holder">
									<img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm1"]->product_id; ?>/img1_product.jpg"
										alt="big image"/>

									<div class="banner_Image">
										<img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/top_banner.png"/>
									</div>
									<div class="smallImage"><img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm2"]->product_id; ?>/img1_product.jpg"
											alt="small image"/></div>
									<div class="mediumImage"><img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm3"]->product_id; ?>/img1_product.jpg"
											alt="medium image"/></div>
									<div class="fancyBragedHolder">
										<div class="fancy_Icon"></div>
										<div class="fancy_number"><?php echo $store[$i]->fancy_counter; ?></div>
										<div class="fancy_name">Fancied</div>
										<div class="brag_Icon clear_both"></div>
										<div class="fancy_number"><?php echo $store[$i]->brag_counter; ?></div>
										<div class="fancy_name">Bragged</div>
									</div>
									<div class="product_number">
										<?php echo $max + 1; ?>
										<div class="braged_name">Products</div>
									</div>
								</div>
							</a>
						</div>
					<?php endfor; ?>


				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	<?php
	}


	function sub_stores2($sssc_id, $sssc_type = 1)
	{
		$base_url = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$store_url = $myconfig['store_url'];
		$store = $this->categoriesdb->get_sub_stores($sssc_id, $sssc_type);
		$sprod = array();
		foreach ($store as $st_id) {
			$key = '_' . $st_id->store_id;
			$var = array($key => $this->categoriesdb->sub_catstoreprod($sssc_id, $sssc_type, $st_id->store_id));
			$sprod = array_merge($sprod, $var);
		}

		?>
		<?php for ($i = 0; $i < count($store); $i++): $sid = '_' . $store[$i]->store_id; ?>

		<?php
		//Generate a random number for fetching images -AS
		$max = count($sprod["$sid"]) - 1;
		$tm1 = mt_rand(0, $max);
		$tm2 = mt_rand(0, $max);
		$tm3 = mt_rand(0, $max);
		//Condition check for slider -AS
		if (($i % 2) == 0) {
			$class = "images_holder  clear_both";
		} else {
			$class = "images_holder image2margin";
		}
		?>




		<a href="<?php echo $base_url?>order/store_page/<?php echo $store[$i]->store_id; ?>">
			<div class="<?php echo $class; ?> message_box" id="<?php echo $store[$i]->store_id; ?>">
				<img
					src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm1"]->product_id; ?>/img1_product.jpg"
					alt="big image"/>

				<div class="banner_Image">
					<img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/top_banner.png"/>
				</div>
				<div class="smallImage"><img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm2"]->product_id; ?>/img1_product.jpg"/>
				</div>
				<div class="mediumImage"><img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm3"]->product_id; ?>/img1_product.jpg"
						alt="medium image"/></div>
				<div class="fancyBragedHolder">
					<div class="fancy_Icon"></div>
					<div class="fancy_number"><?php echo $store[$i]->fancy_counter; ?></div>
					<div class="fancy_name">Fancied</div>
					<div class="brag_Icon clear_both"></div>
					<div class="fancy_number"><?php echo $store[$i]->brag_counter; ?></div>
					<div class="fancy_name">Bragged</div>
				</div>
				<div class="product_number">
					<?php echo $max + 1; ?>
					<div class="braged_name">Products</div>
				</div>
			</div>
		</a>
	<?php endfor; ?>



		<!--                        <div id="more_1" class="slideBackground moreWidthStyle clear_both">-->
		<!--                            <div class="slideNormal"></div>-->
		</div>
		</div>
	<?php
	}

}

?>