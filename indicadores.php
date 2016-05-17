    <?php

    function obtenerIndicadores(){


        //Sitio que proporciona la data: http://mindicador.cl/
        $apiUrl = 'http://mindicador.cl/api';


        //Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
        if ( ini_get('allow_url_fopen') ) {

            $json = file_get_contents($apiUrl);

        } else {

            //De otra forma utilizamos cURL
            $curl = curl_init($apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($curl);
            curl_close($curl);

        }
        

        //Decodificamos el json que nos entrega la API.
        $dailyIndicators = json_decode($json);


        //Arreglo con la data
        $indicadoresArreglo = array(
            'UF'                => number_format($dailyIndicators->uf->valor,2,',','.'),
            'DolarObservado'    => number_format($dailyIndicators->dolar->valor,2,',','.'),
            'DolarAcuerdo'      => number_format($dailyIndicators->dolar_intercambio->valor,2,',','.'),
            'Euro'              => number_format($dailyIndicators->euro->valor,2,',','.'),
            'IPC'               => number_format($dailyIndicators->ipc->valor,2,',','.'),
            'UTM'               => number_format($dailyIndicators->utm->valor,2,',','.'),
            'IVP'               => number_format($dailyIndicators->ivp->valor,2,',','.'),
            'Imacec'            => number_format($dailyIndicators->imacec->valor,2,',','.'),
        );


        //Retornamos la data;
        return $indicadoresArreglo;

    }
    ?>