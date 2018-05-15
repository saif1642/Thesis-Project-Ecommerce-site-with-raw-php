
<?php
if(isset($_POST['submit_range']))
{
	$price1=$_POST['amount1'];
	$price2=$_POST['amount2'];
	
	mysql_connect('localhost','root','');
    mysql_select_db('bkdb');

    $select = mysql_query("select * from sample_items where price BETWEEN '$price1' AND '$price2'");
	echo mysql_num_rows($select);
}
?>


 
