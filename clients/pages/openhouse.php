<!--BEGIN Open House menu-->
<CENTER>
    <TABLE class="table table-light" BGCOLOR="#FFFFFF" style="width:100%;"><TR><TD>
        <TABLE BGCOLOR="#FFFFFF" WIDTH="1200"><TR>
            <TD><B style="color:#1296db;font-size:30px;">OPEN HOUSE MANAGEMENT</B></TD></TR>
        </TABLE>
            
        <div align="left" style="font-family:Verdana,Arial,Helvetica;font-size:20px;padding:15px;margin:10px;width:1200px;border-radius:15px;height:275px;">
        <ul>
            <style type="text/css">
            li{margin:15px 0;}
            </style>
            
            <a class="btn btn-order" href="<?php echo "$PHP_SELF?op=openhouse-add";?>">Add an Open Listing</a><BR><BR>
            <a class="btn btn-order" href="<?php echo "$PHP_SELF?op=openhouse-list";?>">Show/Edit All Open House Listings<?php if(isset($group)){echo $group ;} ?></a><BR><BR>
            <a class="btn btn-order" href="https://www.BostonApartments.com/openhouse.php?cli=<?php if(isset($grid)){echo $grid;} ?>" target=_NEW>Public View of Open House Listings<?php if(isset($group)) { echo $group ;} ?></a><BR><BR>
            <a class="btn btn-order" href="https://www.BostonApartments.com/openhouse.php" target=_openhouse>Current Open House Listings</a>
    
        </ul></div></TD></TR>
    </TABLE>        
</CENTER>
<!--END Open House menu -->
