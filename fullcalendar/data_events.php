<?php
header("Content-type:application/json; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);    
?>
 [
  {
    "title": "กิจกรรมตลอดทั้งวัน",
    "start": "2015-01-30-01",
    "color":"#F1C54D"
  },
  {
    "title": "กิจกรรมยาวต่อเนื่อง",
    "start": "<?=date("Y-m")?>-07",
    "end": "<?=date("Y-m")?>-10",
    "color":"#FF0000"
  },
  {
    "id": "999",
    "title": "กิจกรรมจัดซ้ำ",
    "start": "<?=date("Y-m")?>-09T16:00:00-05:00",
    "color":"#9ABEE6"
  },
  {
    "id": "999",
    "title": "กิจกรรมจัดซ้ำ",
    "start": "<?=date("Y-m")?>-16T16:00:00-05:00",
    "color":"#9ABEE6"    
  },
  {
    "title": "สัมนา",
    "start": "<?=date("Y-m")?>-11",
    "end": "<?=date("Y-m")?>-13",
    "color":"#F1C54D"    
  },
  {
    "title": "ประชุม",
    "start": "<?=date("Y-m")?>-12T10:30:00-05:00",
    "end": "<?=date("Y-m")?>-12T12:30:00-05:00",
    "color":"#D79AE6"
  },
  {
    "title": "พักเที่ยง",
    "start": "<?=date("Y-m")?>-12T12:00:00-05:00",
    "color":"#F1C54D"    
  },
  {
    "title": "ประชุม",
    "start": "<?=date("Y-m")?>-12T14:30:00-05:00",
    "color":"#F1C54D"    
  },
  {
    "title": "ชั่วโมงแห่งสุข",
    "start": "<?=date("Y-m")?>-12T17:30:00-05:00",
    "color":"#F1C54D"    
  },
  {
    "title": "มื้อเย็น",
    "start": "<?=date("Y-m")?>-12T20:00:00",
    "color":"#A3DCA6"
  },
  {
    "title": "ปาร์ตี้วันเกิด",
    "start": "<?=date("Y-m")?>-13T07:00:00-05:00"
  },
  {
    "title": "ลิ้งค์ไปเว็บ ninenik",
    "url": "http://www.ninenik.com/",
    "start": "<?=date("Y-m")?>-28",
    "color":"#A3DCA6"
  }
]