<?php
$id=$_GET['g'];
$res = $col_user->find(array("password"=>$id));
foreach($res as $row)
					{
						$aktif =$row['aktif'];
					}	

?>