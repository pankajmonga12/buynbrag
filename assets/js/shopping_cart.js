$(function () {
    $(".checkbox").dgStyl();
    $(".shoppingIcon").click(function () {
        $("#sendPopup").dialog({
            width: 605,
            height: 293,
            modal: true
        })
    });
    $("#send_close").click(function () {
        $("#sendPopup").dialog("close")
    });
    // $(".drop").selectbox();
	$("#redeem_credits").click(function ()
	{
		$("#redeemId").hide();
		$("#confirmId").show();
		$("#couponId").val('');
		$("#redeemVal").html('0');
		$("#redeemModal").modal('show');
	});
});