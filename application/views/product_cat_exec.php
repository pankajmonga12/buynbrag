<script type="text/javascript">
	$(".drop").selectbox();
</script> <?php $typeNewId = $typeID + 1; ?> <select class="drop" name="sub<?php echo $typeID; ?>_category"
                                                     id="sub<?php echo $typeID; ?>_category"
                                                     onChange="showCategories(this.value,<?php echo $typeNewId; ?>)">
	<option value="00" selected="selected" disabled="disabled">select sub category
	</option> <?php foreach ($products_sub_cat as $product_subcat_items): ?>
		<option
			value="<?php echo $product_subcat_items->category_id; ?>"><?php echo $product_subcat_items->category_name; ?></option> <?php endforeach;?>
</select>