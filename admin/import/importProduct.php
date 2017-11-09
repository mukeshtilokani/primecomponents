<?php header( 'Content-Type: text/html; charset=utf-8' ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Untitled Document</title>
</head>

<body>
<form class="form-horizontal" id="frmContact" name="frmContact" action="../include/excel/importProduct.php" method="post" enctype="multipart/form-data">
       
        <table style="width:80%; margin-left:auto; margin-right:auto;">
          <tr>
            <td style="vertical-align:top;" ><table>
                 
                 <tr>
                  <td> File: </td>
                  <td>
                     <input type="file" name="file" id="file">
                   </td>
                </tr>
                 
                
               
                <tr>
                  <td>&nbsp;</td>
                  <td ><button class="k-button" >Import</button></td>
                </tr>
              </table></td>
            
          </tr>
        </table>
   </form>
</body>
</html>