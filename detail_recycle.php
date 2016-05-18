<?php include 'header.php';?>
<? $takerisk_id=$_GET[takerisk_id];?>
<form action="prcWriteRisk.php" name="form1" enctype="multipart/form-data" method="get">
<label><h3>เหตุผลที่ย้ายลงถังขยะ</h3></label>
<textarea name="detail_recycle" cols="80" rows="" class="form-control" placeholder="รายละเอียด" required></textarea><br>
<input type="hidden" name="method" value='recycle'>
<input type="hidden" name="takerisk_id" value="<?=$takerisk_id?>">
<input type="submit" name="submit" value="ตกลง" class="btn btn-success">
</form>
 <?php include 'footer.php';?>