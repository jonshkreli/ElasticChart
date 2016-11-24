<?php
/**
 * Created by PhpStorm.
 * User: pa kod
 * Date: 22-Nov-16
 * Time: 11:22 PM
 */
//var_dump($_POST);

function get_xml_from_url($url){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    $xmlstr = curl_exec($ch);
    curl_close($ch);

    return $xmlstr;
}

if(isset($_POST['Requested_Site'])){
    //$xml=simplexml_load_file($_POST['Requested_Site']) or die("Error: Cannot create object");
    $xml = get_xml_from_url($_POST['Requested_Site']);
    $xmlobj = new SimpleXMLElement($xml);
    $xmlobj = (array)$xmlobj;//optional
    $xmlobj['GetTime'] = date_format(new DateTime(),"Y-m-d H:i:s");

   echo json_encode($xmlobj);
    //echo date_format(new DateTime(),"Y-m-d H:i:s");
}
else echo "Incorrect parameters";

