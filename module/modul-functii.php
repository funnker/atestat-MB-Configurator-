<?php
    function TipMasina($prefix) //Returneaza tipul masinii in functie de prefixul fisierului
    {
        switch($prefix)
        {
            case 'c':
                $tip = "coupe";
                break;
            case 's':
                $tip = "suv";
                break;
            case 'l':
                $tip = "sedan";
                break;
        }
        return $tip;
    }

    function ModelMasina($model, $tip)
    {
        switch($model)
        {
            case "cclass":
                $nume_model = "Clasa C";
                break;
            case "sclass":
                $nume_model = "Clasa S";
                break;
            case "gle":
                $nume_model = "Clasa GLE";
                break;
            case "gls":
                $nume_model = "Clasa GLS";
                break;
            case "eclass":
                $nume_model = "Clasa E";
                break;
        }
        switch($tip)
        {
            case 'c':
                $nume_model .= " Coupe";
                break;
            case 's':
                $nume_model .= " SUV";
                break;
            case 'l':
                $nume_model .= " Limuzină";
                break;
        }
        return $nume_model;
    }

    function NumeCuloare($culoare)
    {
        switch($culoare)
        {
            case "LU-040":
                $nume_culoare = "Vopsea nemetalizată neagră";
                break;
            case "LU-799":
                $nume_culoare = "Vopsea MANUFAKTUR Alb Diamond Bright";
                break;
            case "LU-890":
                $nume_culoare = "Vopsea nemetalizată albastru Nautic";
                break;
        }
        return $nume_culoare;
    }

    function Extensie($nume_fisier) //Returneaza extensia fisierului
    {
        $v = explode(".", $nume_fisier);
        return end($v);
        // return $v[Count($v) - 1];
    }

    function EsteImagine($nume_fisier) //Verifica daca fisierul este imagine
    {
        return in_array(strtolower(Extensie($nume_fisier)) , ['jpg', 'jpe', 'jpeg', 'png', 'webp', 'bmp', 'gif']);
    }

    function check_login($con)
    {
        if(isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            $query = "select * from users where user_id = '$id' limit 1";

            $result = mysqli_query($con, $query);
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
        //Redirectionare spre Login
        header("Location: login.php");
        die;
    }

    function Login()
    {
        if(isset($_SESSION['user_id']))
            return $_SESSION['user_id'];
        return false;   
    }

    function random_num($length)
    {
        $text = "";
        if($length < 5)
        {
            $length - 5;
        }

        $len = rand(4, $length);
        for($i = 0; $i < $len; $i++)
        {
            $text .= rand(0,9);
        }

        return $text;
    }

    function PretModel($nume)
    {
        switch($nume)
        {
            case "Clasa C Coupe":
                $pret = 46770;
                break;
            case "Clasa S Limuzina":
                $pret = 105141;
                break;
            case "Clasa E Limuzina":
                $pret = 55100;
                break;
            case "Clasa GLE SUV":
                $pret = 73560;
                break;
            case "Clasa GLS SUV":
                $pret = 94190;
                break;
        }
        return $pret;
    }

?>