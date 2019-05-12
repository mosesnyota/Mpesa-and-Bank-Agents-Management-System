<!DOCTYPE HTML>
<html>
    
    <head>
   
        <link rel="stylesheet" type="text/css" href="datatable/media/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="datatable/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="datatable/resources/demo.css">
	<style type="text/css" class="init">
	
	</style>
        <script type="text/javascript" language="javascript" src="datatable/jquery-3.3.1.js"></script>
	<script type="text/javascript" language="javascript" src="datatable/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="datatable/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="datatable/resources/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">
	

$(document).ready(function() {
	$('#example').DataTable();
} );


	</script>
        <?php include 'page_header.php'; ?>
        </head>
    
    <body class="cbp-spmenu-push">
        <div id="blocker">
                            <div><img src="images/loading.gif" />Loading...</div>
        </div>
        <div class="main-content">
            <!--left-fixed -navigation-->
            <?php include 'left_nav.php'; ?>
            
            <!-- header-starts -->
           
            <!-- //header-ends -->
            <!-- main content start-->
       <div id="page-wrapper">
                 
           <div class="container">
               
               
               <section>
                   
                   <table id="example" class="display" style="width:100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Tiger Nixon</td>
						<td>System Architect</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>2011/04/25</td>
						<td>$320,800</td>
					</tr>
					<tr>
						<td>Garrett Winters</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>63</td>
						<td>2011/07/25</td>
						<td>$170,750</td>
					</tr>
					<tr>
						<td>Ashton Cox</td>
						<td>Junior Technical Author</td>
						<td>San Francisco</td>
						<td>66</td>
						<td>2009/01/12</td>
						<td>$86,000</td>
					</tr>
					<tr>
						<td>Cedric Kelly</td>
						<td>Senior Javascript Developer</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2012/03/29</td>
						<td>$433,060</td>
					</tr>
					<tr>
						<td>Airi Satou</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>33</td>
						<td>2008/11/28</td>
						<td>$162,700</td>
					</tr>
					<tr>
						<td>Brielle Williamson</td>
						<td>Integration Specialist</td>
						<td>New York</td>
						<td>61</td>
						<td>2012/12/02</td>
						<td>$372,000</td>
					</tr>
					<tr>
						<td>Herrod Chandler</td>
						<td>Sales Assistant</td>
						<td>San Francisco</td>
						<td>59</td>
						<td>2012/08/06</td>
						<td>$137,500</td>
					</tr>
					<tr>
						<td>Rhona Davidson</td>
						<td>Integration Specialist</td>
						<td>Tokyo</td>
						<td>55</td>
						<td>2010/10/14</td>
						<td>$327,900</td>
					</tr>
					<tr>
						<td>Colleen Hurst</td>
						<td>Javascript Developer</td>
						<td>San Francisco</td>
						<td>39</td>
						<td>2009/09/15</td>
						<td>$205,500</td>
					</tr>
					<tr>
						<td>Sonya Frost</td>
						<td>Software Engineer</td>
						<td>Edinburgh</td>
						<td>23</td>
						<td>2008/12/13</td>
						<td>$103,600</td>
					</tr>
					<tr>
						<td>Jena Gaines</td>
						<td>Office Manager</td>
						<td>London</td>
						<td>30</td>
						<td>2008/12/19</td>
						<td>$90,560</td>
					</tr>
					<tr>
						<td>Quinn Flynn</td>
						<td>Support Lead</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2013/03/03</td>
						<td>$342,000</td>
					</tr>
                                        
                                        </tbody>
				<tfoot>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</tfoot>
			</table>
                   
               </section>
           </div>
                
                
                
                
	</div>
		
          
            <!--footer-->
<?php include 'footer.php'; ?>
            <!--//footer-->
        </div>
<?php include 'toggle.php'; ?>
    </body>
</html>