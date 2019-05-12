<?php
//require_once('auth.php');
//$username = $_SESSION['SESS_MEMBER_ID_'];
//require_once("dao/dbconnector.php");
include('dao/connect.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>content</title>
        <link href="css/style_blue.css" type="text/css" rel="stylesheet">
            <link href="css/pages_layout.css" type="text/css" rel="stylesheet">
                <link href='css/opa-icons.css' rel='stylesheet'>

                    <link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
                    <style type="text/css" class="init">

                    </style>
                    <script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
                    <script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
                    <script type="text/javascript" language="javascript" class="init">
                        $(document).ready(function () {
                            $('#example').dataTable({
                                "columnDefs": [
                                    {
                                        // The `data` parameter refers to the data for the cell (defined by the
                                        // `data` option, which defaults to the column being worked with, in
                                        // this case `data: 0`.
                                        //"render": function ( data, type, row ) {
                                        //	return data +' ('+ row[3]+')';
                                        //},
                                        //"targets": 0
                                    },
                                            //{ "visible": false,  "targets": [ 3 ] }
                                ]
                            });
                        });

                    </script>
                    <script type='text/javascript'>//<![CDATA[ 
                        $(window).load(function () {
                            setTimeout(function () {
                                $("#blocker").hide();
                            }, 1000);

                        });//]]>  

                    </script>
                    </head>
                    <body>
                        <div id="blocker">
                            <div><img src="images/loading.gif" />Loading...</div>
                        </div>
                        <div id="display_Area">
                            <div id="page_tabs_content">
                                <div class="clear"></div>
                                <table class="borders" cellpadding="5" cellspacing="0">
                                    <tr style="height:30px;">
                                        <td class="dataListHeader">Registered Zones</td>
                                    </tr>
                                    <tr>
                                        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th align='center'>           </th>
                                                        <th align='center'>Zone Name</th>
                                                        <th align='center'>Address</th>
                                                        <th align='center'>Other Info</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $myqueryis = "select * from zones order by zone_name asc";
                                                    $toexecute = mysql_query($myqueryis);
                                                    $num = 0;
                                                    while ($rowr = mysql_fetch_array($toexecute)) {
                                                        $num++;
                                                        ?>

                                                        <tr class="record">
                                                            <td align='center'> </td>
                                                            <td align='center'> <?php echo $rowr['zone_name']; ?></td>
                                                            <td align='center'> <?php echo $rowr['address']; ?></td>
                                                            <td align='center'> <?php echo $rowr['other_infor']; ?></td>



                                                            <td><a href="#editExamModal<?php echo $rowr['zone_id'] ?>" title="Click to Edit Zone"><i class="icon icon-orange icon-edit"></i></a>
                                                                <div id="editExamModal<?php echo $rowr['zone_id'] ?>" class="modalDialog">
                                                                    <div> <a href="#close" title="Close" class="close">X</a>
                                                                        <form id="contact-form" action="update_zone.php" name="catsform" method="post">
                                                                            <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
                                                                                <tr style='height:30px;'>
                                                                                    <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Edit Zone</font></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="alterCell" width="25%">Zone Name</td>
                                                                                    <td class="alterCell3" ><input type="text" name="name" class="inputFields" tabindex="5" value="<?php echo $rowr['zone_name']; ?>" required autofocus />
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="alterCell" width="25%">Address</td>
                                                                                    <td class="alterCell3" ><input type="text" name="address" class="inputFields" value="<?php echo $rowr['address']; ?>" tabindex="5"  />
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="alterCell" width="25%">Other Info</td>
                                                                                    <td class="alterCell3" ><input type="text" name="otherinfo" class="inputFields" value="<?php echo $rowr['other_infor']; ?>" tabindex="5"  />
                                                                                    </td>
                                                                                </tr>



                                                                                <tr>
                                                                                    <td class="alterCell">&nbsp&nbsp;</td>
                                                                                    <td  class="alterCell2"><input class="btn btn-primary" type="submit" value="Update Zone"/></td>
                                                                                </tr>
                                                                            </table>
                                                                            <input name="id" type="hidden"  value="<?php echo $rowr['zone_id']; ?>" />
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                            
                                                            
                                                            <td><a href="delete_zone.php?id=<?php echo $rowr['zone_id'] ?>"><i class="icon icon-orange icon-trash"></i></a></td>
                                                        </tr>

                                                        <?php
                                                    }
                                                    ?>		
                                                </tbody>
                                            </table></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- end of login form-->
                        </div>
                        </div>
                        <!--end of display area-->

                    </body>
                    </html>
