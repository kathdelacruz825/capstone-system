<?php
require_once("../config/index.php");



$qry=mysqli_query($conn,"Select * from tbl_accounts_student") or die(mysqli_error($conn));

  

  echo "<table>";

    echo "<tr>";

      echo "<td width='10%'>ID</td>";

    // 	echo "<td width='10%'>AccountType</td>";

    // 	echo "<td width='10%'>AccountStatus</td>";

    // 	echo "<td width='10%'>AccountOnlineState</td>";

      echo "<td width='10%'>AccountID</td>";

      echo "<td width='10%'>AccountPassword</td>";

      echo "<td width='10%'>LastName</td>";

      echo "<td width='10%'>FirstName</td>";

      echo "<td width='10%'>MiddleName</td>";

      echo "<td width='10%'>YearLevel</td>";

      echo "<td width='10%'>Course</td>";

    echo "</tr>";

    

    while($res=mysqli_fetch_array($qry))

    {

    echo "<tr>";

        echo "<td>"; echo $res["ID"]; echo"</td>";

    // 		echo "<td>"; echo $res["AccountType"]; echo"</td>";

    // 		echo "<td>"; echo $res["AccountStatus"]; echo"</td>";

    // 		echo "<td>"; echo $res["AccountOnlineState"]; echo"</td>";

        echo "<td>"; echo $res["AccountID"]; echo"</td>";

        echo "<td>"; echo $res["AccountPassword"]; echo"</td>";

        echo "<td>"; echo $res["LastName"]; echo"</td>";

        echo "<td>"; echo $res["FirstName"]; echo"</td>";

        echo "<td>"; echo $res["MiddleName"]; echo"</td>";

        echo "<td>"; echo $res["YearLevel"]; echo"</td>";

        echo "<td>"; echo $res["Course"]; echo"</td>";

    echo "</tr>";

    }

    

  echo "</table>";	

  exit;

?>