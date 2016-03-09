var _bnbDashboard = {

    prodQuantityChange : function(){

        var template1 = '<div style="position:relative; top:-10px; left:40px; color:#008000;">Saved!<div>',
            template2 = '<div style="position:relative; top:-10px; left:40px; color:#FF0000;">Error!<div>';

        var animate = function(template, parElem) {
            parElem.append(template);

            setTimeout(function(){
                parElem.find('div').remove();
            },2000);
        };

        $(document).on('blur', 'input.prodQuantity', function(){

            var elemThis = this,
                baseUrl = document.location.origin,
                quantity = parseInt(this.value),prodID = parseInt($(this).attr('name').split('_')[1]);

            $.ajax({
                type: "GET",
                url: baseUrl + '/dashboard/changeQuantity/' + prodID + '/' + quantity,
                beforeSend: function() { $('#loading').show(); }, //Show spinner
                success: function(data, status, xhr){

                    var response = $.parseJSON(xhr.responseText),
                        father = $(elemThis).parent();

                    animate(template1, $(elemThis).parent());

                    if(quantity === 0) {
                         $(elemThis).parent().parent().children().children('.onsaleImage').addClass('soldoutImage').removeClass('onsaleImage');
                    }
                    else{
                             $(elemThis).parent().parent().children().children('.soldoutImage').addClass('onsaleImage').removeClass('soldoutImage')
                    }

                },
                error: function(data, status, xhr){
                    
                    animate(template2, $(elemThis).parent());
                },
                complete: function() { $('#loading').hide(); } //Hide spinner
            });

        });

    },

    statusSwitch : function(){

        console.log('_bnbDashboard.statusSwitch initialized');

        $(document).on('click', ".onOffSwitch", function () {

//    var baseUrl ='<?php echo $base_url; ?>';
            var baseUrl = document.location.origin;

            var elemThis = this;

            var prodID = parseInt($(this).attr('id').split('_')[1]);

            var status = "enable";

            if ($(this).hasClass("active")) {
                status = "disable";
            }

            $.ajax({
                url: baseUrl + '/dashboard/' + status+ 'Product/' + prodID,
                beforeSend: function() { $('#loading').show(); }, //Show spinner
                success: function (data, status, xhr) {

                    var response = $.parseJSON(xhr.responseText);

                    if(response.result){
                        if ($(elemThis).hasClass("active")) {
                            $(elemThis).removeClass('active');
                        } else{
                            $(elemThis).addClass('active');
                        }
                    }else{
                        alert('Unable to process, please try again later');
                    }
                },
                error:function(){
                    console.log('error');
                    if ($(elemThis).hasClass("active")) {
                        $(elemThis).removeClass('active');
                    } else{
                        $(elemThis).addClass('active');
                    }
                },
                complete: function() { $('#loading').hide(); } //Hide spinner
            })
        });

    }

};