<html>
    <head>
        <title>Windows Tiles</title>
        <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo $baseURL; ?>assets/css/menu.css" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="jquery.transit.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="container-large">
                <div class="tile tile-normal">
                    <div class="front">
                        <input type="BUTTON" class="btn_style" value="Report"/> 
                    </div>
                    <div class="back">
                        <input type="BUTTON" class="btn_style" value="Report"/> 
                    </div>
                </div>
                <div class="tile tile-normal">
                    <div class="front">
                        <input type="BUTTON" class="btn_style" value="Logout"/> 
                    </div>
                    <div class="back">
                        <input type="BUTTON" class="btn_style" value="Logout"/> 
                    </div>
                </div>
            </div>
            <div class="container-small">
                <div class="tile tile-small">
                    <div class="front">
                        <input type="BUTTON" class="btn_style" value="Orders CSV"/>
                    </div>
                    <div class="back">
                        <input type="BUTTON" class="btn_style" value="Orders CSV"/> 
                    </div>
                </div>
                <div class="tile tile-small">
                    <div class="front">
                        <input type="BUTTON" class="btn_style" value="Seller Details"/> 
                    </div>
                    <div class="back">
                        <input type="BUTTON" class="btn_style" value="Seller Details"/> 
                    </div>
                </div>
                <div class="tile tile-small">
                    <div class="front">
                        <input type="BUTTON" class="btn_style" value="Pickup Today"/> 
                    </div>
                    <div class="back">
                        <input type="BUTTON" class="btn_style" value="Pickup Today"/> 
                    </div>
                </div>
                <div class="tile tile-small">
                    <div class="front">
                        <input type="BUTTON" class="btn_style" value="Change Pickup Date"/> 
                    </div>
                    <div class="back">
                        <input type="BUTTON" class="btn_style" value="Change Pickup Date"/> 
                    </div>
                </div>
            </div>
            <div class="tile tile-wide">
                <div class="front">
                    <input type="BUTTON" class="btn_style" value="All Orders"/> 
                </div>
                <div class="back">
                    <input type="BUTTON" class="btn_style" value="All Orders"/> 
                </div>
            </div>
        </div>
    </body>
</html>