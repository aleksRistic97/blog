<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class GetParamsService {

    public function getParams(array $criteria): array {

        $parameters = [];

        foreach ($criteria as $key => $value)
        {

            if ( $value !== null )
            {
                switch ( $key ) :

                    case 'date':
                        $date = $value->format("Y-m-d");
                        $parameters[$key] = $date;
                        break;
                    default:
                        $parameters[$key] = $value;
                        break;
                endswitch;

            }
        }

        return $parameters;
    }
}