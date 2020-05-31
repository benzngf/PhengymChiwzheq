<?php
 echo '<h2>選擇練習方式</h2>';
 echo '<p style="margin-top:0; text-indent:0;">*練習需具有聲音播放裝置，請確認連接耳機或喇叭</p>';
 echo '<div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',\'read\');"><h3>讀字練習</h3></div>';
 echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',\'spell\');"><h3>聽寫（拼字）練習</h3></div>';
 echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',[\'read\',\'spell\']);"><h3>綜合練習</h3></div>';
?>
<h2>例句</h2>
<div style="width: 80%; max-width: 750px; text-align: left; margin-left: auto; margin-right: auto; font-size: 1.17em;"> 
<div class="flowcell-tab" style="width: 100%;">Armsii diaarm'diaxm'diam, y ee simzeeng si dviaar'dviax'dvia.</div>
<div class="flowcell-tab" style="width: 100%;">Taau tix ho knggr'kng'kngf, qix ka y dien ho kiirm'kim'kym.</div>
<div class="flowcell-tab" style="width: 100%;">Png zuo kaq liaarm'liam'liaam, zhaix tng ho siooir'sioi'sioy.</div>
</div>
