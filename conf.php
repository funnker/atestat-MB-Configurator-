<?php

$ch = curl_init("https://api.mercedes-benz.com/configurator/v1/markets/ro_RO/models/2053151/configurations/AU-227_GC-421_LE-L_LU-040_MJ-802_PC-30P-431-DSP-P29-P31-P47-P49-P65-PYB-PYH-PYO_PS-089%23_SA-01U-02U-08U-09U-14U-16U-17U-235-249-258-270-274-287-294-309-33B-345-351-362-367-413-440-448-464-475-486-500-501-513-51U-531-537-580-5U4-604-611-628-642-737-739-772-776-79B-810-824-840-859-873-876-877-889-893-916-927-968-971-989-B59-K11-L5C-R01-R66-U01-U02-U09-U10-U22-U25-U26-U29-U60-U79-U85_SC-1B3-1P6-2U1-2U8-3U1-502-56V-5P6-6P5-6S8-8B6-8P8-8U6-8U8-998-B09-K14-K27-PZB/images/vehicle?apikey=c4b2ba2f-3db6-485b-b395-ef581c2d568d");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);

$results = json_decode($response, true);

var_dump($results);