<?php
header('Access-Control-Allow-Origin: *');
require_once('php_includes/db_conx.php');

function getMagicSakhi()
{
	$preFinalSakhis = getAvailableSakhi();
	//print_r($preFinalSakhis);

	$distance = array();
	$dist = array();

	for($i=0;$i<=count($preFinalSakhis)-1;$i++)
	{
		$distance[$i][0] = $preFinalSakhis[$i][0];
		$distance[$i][1] = trim(GetDistance('19.045429', $preFinalSakhis[$i][1], '72.888903', $preFinalSakhis[$i][2])," km");
		$dist[$i] = trim(GetDistance('19.045429', $preFinalSakhis[$i][1], '72.888903', $preFinalSakhis[$i][2])," km");
	}

	function cmp($a, $b) {
		if ($a[1] == $b[1]) {
			return 0;
		}
		return ($a[1] < $b[1]) ? -1 : 1;
	}

	usort($distance, "cmp");

	//print_r($distance);

	return $distance[0][0];

}

function getAvailableSakhi()
{
	$arr = array();

	$sql = "SELECT id FROM `sakhis` WHERE `availability`=1";
	$result = mysqli_query($GLOBALS['connection'], $sql);
	$x=0;

	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$arr[$x] = $row["id"]; //Sakhi ID
			$x = $x + 1;
		}
	}

	//print_r($arr);
	return getSakhiLocations($arr);
}

function getSakhiLocations($sakhis)
{
	for($i=0;$i<=count($sakhis)-1;$i++)
	{
		$sql = "SELECT `id`,`address` FROM `sakhis` WHERE `id`=".$sakhis[$i]."";
		$result = mysqli_query($GLOBALS['connection'], $sql);

		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$arr[$i][0] = $row["id"]; //Sakhi ID
				$a = $row["address"];
				$latLong = getCoords($a);
				$latLongSplit = explode(',',$latLong);
				$arr[$i][1] = $latLongSplit[0]; //Sakhi Lat
				$arr[$i][2] = $latLongSplit[1]; //Sakhi Long
			}
		}
	}

	//print_r($arr);

	return $arr;
}


function getCoords($sakhiAddress)
{
$Address = urlencode($sakhiAddress);
  $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
  $xml = simplexml_load_file($request_url) or die("url not loading");
  $status = $xml->status;
  if ($status=="OK") {
      $Lat = $xml->result->geometry->location->lat;
      $Lon = $xml->result->geometry->location->lng;
      $LatLng = "$Lat,$Lon";
	  return $LatLng;
  }
  else
  {
	  return '';
  }
}


function get_coordinates($address)
{
    $address = urlencode($address);
    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response);
    $status = $response_a->status;

    if ( $status == 'ZERO_RESULTS' )
    {
        return FALSE;
    }
    else
    {
        $return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
        return $return;
    }
}

function GetDistance($lat1, $lat2, $long1, $long2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

	return $dist;
    //return array('distance' => $dist, 'time' => $time);
}

/*
$coordinates1 = get_coordinates('Suprabhat, Neelam Nagar, Mulund East');
$coordinates2 = get_coordinates('Suprabhat, Prism Towers, Goregoan, Mumbai');

if ( !$coordinates1 || !$coordinates2 )
{
    echo 'Bad address.';
}
else
{
    $dist = GetDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
    echo 'Distance: <b>'.$dist['distance'].'</b><br>Travel time duration: <b>'.$dist['time'].'</b>';
}
*/

function getnewsakhi_oncancel( $lmt)
{
	$preFinalSakhis = getAvailableSakhi();
	//print_r($preFinalSakhis);

	$distance = array();
	$dist = array();

	for($i=0;$i<=count($preFinalSakhis)-1;$i++)
	{
		$distance[$i][0] = $preFinalSakhis[$i][0];
		$distance[$i][1] = trim(GetDistance('19.045429', $preFinalSakhis[$i][1], '72.888903', $preFinalSakhis[$i][2])," km");
		$dist[$i] = trim(GetDistance('19.045429', $preFinalSakhis[$i][1], '72.888903', $preFinalSakhis[$i][2])," km");
	}

	function cmp($a, $b) {
		if ($a[1] == $b[1]) {
			return 0;
		}
		return ($a[1] < $b[1]) ? -1 : 1;
	}

	usort($distance, "cmp");
		return $distance[$lmt][0];

}

?>
