<div style="margin: 0 auto; width: 400px; text-align: center; font-size: 11px">
    <form action= "<?php echo $baseURL."index.php/deals/getDeal"; ?>" method="post" enctype="multipart/form-data"
          style="border: 2px solid rgb(0,13,26); background-color: rgb(0,27,51); color: white; width: 100%; padding: 10px; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px; text-align: center">
        <p>Create New Deal</p>

        <p style="font-variant: small-caps">
            <label for="textfield">Name of the deal</label>
            <input type="text" name="dealName"/>
        </p>

        <p style="font-variant: small-caps">
            <label for="textfield">Start Date</label>
            <input type="date" name="start"/>
        </p>

        <p style="font-variant: small-caps">
            <label for="textfield">End Date</label>
            <input type="date" name="end"/>
        </p>

        <p style="font-variant: small-caps">
            <label for="textfield">CSV</label>
            <input type="file" name="file"/>
        </p>

        <p>
            <input type="submit" name="submit" id="button" value="Create"/>
        </p>
    </form>
</div>