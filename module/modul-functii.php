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

?>