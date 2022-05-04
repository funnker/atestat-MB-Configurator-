<?php
    // $apikey = "3f42b118-8c53-442a-b9a3-acaafaa02d6f"; //c4b2ba2f-3db6-485b-b395-ef581c2d568d
    // $ch = "https://api.mercedes-benz.com/configurator/v1/markets/ro_RO/models/2053151/configurations/";
    // $result = $ch . "AU-651_GC-421_LE-L_LU-040_MJ-802_PC-30P-431-P29-P31-P65-PYB-PYH_PS-089%23_SA-08U-09U-218-258-270-274-287-294-309-33B-345-351-355-362-367-440-475-486-506-51U-537-580-5U4-632-737-739-772-776-79B-824-840-876-893-916-927-968-989-999-B01-B16-B51-B59-K11-L5C-R01-RSJ-U01-U02-U09-U10-U22-U26-U29-U60_SC-1B3-1P6-2U1-2U8-3U1-52V-5P6-6P5-6S8-8P8-8U6-8U8-998-AA6-B09-B10-K15-K27-K31-PZB/images/vehicle?apikey=4db44704-adf3-4b37-a993-dfbcff5df01b";

    $ch = curl_init("https://api.mercedes-benz.com/configurator_tryout/v1/markets/de_DE/models/2229801/configurations/AU-501_GC-427_LE-L_LU-040_MJ-800_PC-23P-P07-P09-P17-P21-P34-P35-P47-P54-P64_PS-064%23-121%23-124%23-241%23-290%23-292%23-345%23-352%23-516%23-518%23-538%23-953%23-H71%23-M11%23-S18%23_SA-01U-02B-02U-08U-09U-11R-14U-16U-17U-223-231-233-235-249-266-275-276-293-297-351-362-367-401-402-413-432-439-448-452-453-463-475-487-501-513-531-540-546-551-581-582-596-61U-628-642-70B-735-79B-810-840-871-874-877-881-882-883-889-897-8U0-902-915-927-969-H29-K11-K32-K33-K34-L2B-R01-R66-U01-U10-U12-U25-U60_SC-2U8-3U1-502-51B-54V-6P5-8U6-8U8-998-B10-K15-K31-LS2-PZB/images/vehicle?perspectives=EXT020%2CINT1&roofOpen=false&night=false&apikey=3656443a-3bb0-45dd-9ef5-3c262711358c");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    curl_close($ch);

    $results = json_decode($response, true);

    var_dump($results);
