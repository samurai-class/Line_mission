<?php

$Fp = fopen("data.txt", "r");
       // 今読み込んでいるデータの行数
$Max_Num = 5;　 // 読み込むデータの行数の最大値

// $Last_TimeStamp = (date)0;


for ($Num = 0; $Num < $Max_Num; $Num++){
    
    $Data = fgets($Fp);

    $Mileage_Since_Last_Time = $Data[0] ;   // 前回記録時からの走行距離
    $Current_TimeStamp = $Data[1];               //現在の時刻

    echo $Mileage_Since_Last_Time;
    echo $Current_TimeStamp;



    $Last_TimeStamp = $TimeStamp;     // 次の処理に移る前に"前回の記録時刻"を更新

}







?>