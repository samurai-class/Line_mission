<?php

$Fp = fopen("data_1.txt", "r");
$Result_Code = 0;

// 1回目のデータ読み込み /////////////////////////////////////////////////////
$Data = fgets($Fp);
$Value = explode(' ', $Data);
// 現在の時刻
$Current_TimeStamp = $Value[0];   
// 前回記録時からの走行距離
$Mileage_Since_Last_Time_m = $Value[1] ;
// 画面表示
echo "現在の時刻：".$Current_TimeStamp."<br>";
echo "前回記録時からの走行距離：".$Mileage_Since_Last_Time_m." [m]<br><br>";

//2回目のデータを読みこむ前に前回の時刻を保存する変数を更新
$Last_TimeStamp = $Current_TimeStamp;




// 2回目のデータ読み込み /////////////////////////////////////////////////////
// 読み込むログデータの行数の最大
$Max_Num = 500;
$Reference_Low_Speed = 10;
$Midnight_TimeStamp = "22:00:00.000";
$Sum_of_Low_Speed_Running_Time = (float)0;
$Sum_of_Mileage = (float)0;
$Base_Fare_Mileage = 1052;

for ($Num = 1; $Num < $Max_Num; $Num++){
    
    $Data = fgets($Fp);

    // 読み込むデータがない場合、処理を終了
    if($Data == null){
        break;
    }

    $Value = explode(' ', $Data);

    // 現在の時刻
    $Current_TimeStamp = $Value[0];   

     // 前回記録時からの走行距離
    $Mileage_Since_Last_Time_m = $Value[1] ;

    // 一番初めは前回記録時の時刻が無い為、差分が出ないように調整する
    // if($Num == 0){
    //     $Last_TimeStamp = $Current_TimeStamp;
    // }

    // 前回記録時からの時間を算出
    $diff_seconds = (strtotime($Current_TimeStamp) - strtotime($Last_TimeStamp));

    $Mileage_Since_Last_Time_km = (double)$Mileage_Since_Last_Time_m / 1000 ;
    $diff_hour = $diff_seconds / 3600 ;

    // 低速走行時間の合計を算出
    $kmph = $Mileage_Since_Last_Time_km / $diff_hour ;
    if($kmph < $Reference_Low_Speed){
        $Sum_of_Low_Speed_Running_Time += (float)$diff_seconds;
    }

    // 走行距離の合計を算出　(夜間も考慮)
    if(strtotime($Current_TimeStamp) < strtotime($Midnight_TimeStamp)){
        $Sum_of_Mileage += (float)$Mileage_Since_Last_Time_m;
    }
    else{
        $Sum_of_Mileage += (float)($Mileage_Since_Last_Time_m*1.25);
    }

    // 画面表示
    echo "現在の時刻：".$Current_TimeStamp."<br>";
    echo "前回記録時からの走行距離：".$Mileage_Since_Last_Time_m." [m]<br>";
    echo "前回記録時からの時間：".(int)number_format($diff_seconds)." [秒]<br>";
    echo "時速：".number_format($kmph,2)."[km/h]<br><br>";

    // 次の処理に移る前に"前回の記録時刻"を更新
    $Last_TimeStamp = $Current_TimeStamp;
}

    //運賃を算出する/////////////////////////////////////////////////////////

    //低速走行の運賃
    $Sum_of_Low_Speed_Running_Fare = ($Sum_of_Low_Speed_Running_Time / 90) * 80;

    //通常の運賃
    if($Sum_of_Mileage < $Base_Fare_Mileage){
        $Sum_of_Normal_Fare = 410 + $Sum_of_Low_Speed_Running_Fare;
    }
    else{
        $Sum_of_Normal_Fare = 410 + (($Sum_of_Mileage - 1052) / 237 ) * 80;
    }

    $Sum_of_Fare = $Sum_of_Low_Speed_Running_Fare + $Sum_of_Normal_Fare;

// 画面表示
echo "低速走行時間合計：".$Sum_of_Low_Speed_Running_Time."[秒]<br>";
echo "乗車距離の合計：".$Sum_of_Mileage."[m]<br>";
echo "運賃：".(int)$Sum_of_Fare."[円]<br>";



// 関数 //////////////////////////////////////////////////////////////////
function CalculationFare(){
    echo "";
}



?>