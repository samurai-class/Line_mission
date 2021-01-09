<?php

$fp = fopen("data.txt", "r");

$line_max = 10;
$line_num = 1;
$Total_Mileage = 0;
$Total_Ride_Time = 0;
$fare = 0;
$PreTimeStamp = 0;

while ($line_num < $line_max){

    // データの読み込みを確認
    $line = fgets($fp);
    echo "$line<br>";

    // 読み込んだデータを分割し、変数に代入
    $value = explode(' ', $line);
    $TimeStamp = $value[0];
    $Mileage = $value[1];

    // データの読み込みを確認
    // echo "前回記録時点からの走行距離[m]".$value;
    // echo "記録時刻".$Time;

    // 乗車時間と走行距離の総和
    $Total_Ride_Time += (var_dump($TimeStamp - $PreTimeStamp));
    $Total_Mileage += (float)$Mileage;





    $PreTimeStamp = $TimeStamp;     // 次の処理に移る前に"前回の記録時刻"を更新
    $line_num += 1;



    function CalculationTimeDiff($a_NowRecordedTime, $a_LastRecordedTime){
        echo "";
        return $a_NowRecordedTime - $a_LastRecordedTime;
    }


    function CalculationNormalFare($a_){
        echo "";
    }

    // //通常運賃の計算
    // if($Total_Mileage < 1052){
    //     $fare = 410;
    // }
    // else{
    //     $Remaining_Mileage = $Total_Mileage -1052;
    //     $fare = 410 + 80 * (int)($Remaining_Mileage / 237);
    // }

    // //低速運賃の計算



    // //夜間運賃の計算



    // // echo "$line_num<br>";

    // echo "記録時刻".$line_num."：".$value[0]."<br>";

    // // 走行距離確認[km]
    // echo "走行距離：";
    // echo $Mileage."[m]<br>";

    // echo "運賃：";
    // echo $fare."[円]<br>";
    
    // echo "<br><br>";

}

fclose($fp);

?>