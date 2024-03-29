<?php

namespace App\Controller;

use App\Entity\DimensionTemps;
use App\Entity\FaitPays;
use App\Entity\FaitPerfCom;
use App\Entity\FaitPipeline;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KpiGenerauxController extends AbstractController
{
    /**
     * @Route("/kpi/generaux", name="kpi_generaux")
     */
    public function index()
    {
        $annees = $this->getDoctrine()->getRepository(DimensionTemps::class)->yearDistinct();
        return $this->redirectToRoute('kpi_generaux_by_year_id', [
            'id' => $annees[0]->getId()
        ]);
    }

    /**
     * @Route("/kpi/generaux/{id}", name="kpi_generaux_by_year_id")
     */
    public function year($id)
    {
        $annee = $this->getDoctrine()->getRepository(DimensionTemps::class)->find($id);

        $annees = $this->getDoctrine()->getRepository(DimensionTemps::class)->yearDistinct();
        $valuebycountries = $this->getDoctrine()->getRepository(FaitPays::class)->findValuesByCountry($annee->getYear());
        $valuespipeline = $this->getDoctrine()->getRepository(FaitPipeline::class)->valuespipeline($annee->getYear());
        $valuesPerfAllComm = $this->getDoctrine()->getRepository(FaitPerfCom::class)->getPerfAllVendeurByMonth($annee->getYear());
        $CA = $this->getDoctrine()->getRepository(FaitPerfCom::class)->getCA($annee->getYear());
        $FirstComm = $this->getDoctrine()->getRepository(FaitPerfCom::class)->getCommercialFirst($annee->getYear());
        $TopComm = $this->getDoctrine()->getRepository(FaitPerfCom::class)->getTopFiveCommercial($annee->getYear());
        $NbOffre = $this->getDoctrine()->getRepository(FaitPipeline::class)->TotalOffre($annee->getYear());
        $NbDevis = $this->getDoctrine()->getRepository(FaitPipeline::class)->PercentDevis($annee->getYear());
        $NbCmd = $this->getDoctrine()->getRepository(FaitPipeline::class)->PercentCmd($annee->getYear());

        $tauxDevis = ($NbDevis[0]['devis']/$NbOffre[0]['offre'])*100;
        $tauxCmd = ($NbCmd[0]['cmd']/$NbOffre[0]['offre'])*100;

        $code_pays = [
            "AF"=>0,
            "AL"=>0,
            "DZ"=>0,
            "AO"=>0,
            "AG"=>0,
            "AR"=>0,
            "AM"=>0,
            "AU"=>0,
            "AT"=>0,
            "AZ"=>0,
            "BS"=>0,
            "BH"=>0,
            "BD"=>0,
            "BB"=>0,
            "BY"=>0,
            "BE"=>0,
            "BZ"=>0,
            "BJ"=>0,
            "BT"=>0,
            "BO"=>0,
            "BA"=>0,
            "BW"=>0,
            "BR"=>0,
            "BN"=>0,
            "BG"=>0,
            "BF"=>0,
            "BI"=>0,
            "KH"=>0,
            "CM"=>0,
            "CA"=>0,
            "CV"=>0,
            "CF"=>0,
            "TD"=>0,
            "CL"=>0,
            "CN"=>0,
            "CO"=>0,
            "KM"=>0,
            "CD"=>0,
            "CG"=>0,
            "CR"=>0,
            "CI"=>0,
            "HR"=>0,
            "CY"=>0,
            "CZ"=>0,
            "DK"=>0,
            "DJ"=>0,
            "DM"=>0,
            "DO"=>0,
            "EC"=>0,
            "EG"=>0,
            "SV"=>0,
            "GQ"=>0,
            "ER"=>0,
            "EE"=>0,
            "ET"=>0,
            "FJ"=>0,
            "FI"=>0,
            "FR"=>0,
            "GA"=>0,
            "GM"=>0,
            "GE"=>0,
            "DE"=>0,
            "GH"=>0,
            "GR"=>0,
            "GD"=>0,
            "GT"=>0,
            "GN"=>0,
            "GW"=>0,
            "GY"=>0,
            "HT"=>0,
            "HN"=>0,
            "HK"=>0,
            "HU"=>0,
            "IS"=>0,
            "IN"=>0,
            "ID"=>0,
            "IR"=>0,
            "IQ"=>0,
            "IE"=>0,
            "IL"=>0,
            "IT"=>0,
            "JM"=>0,
            "JP"=>0,
            "JO"=>0,
            "KZ"=>0,
            "KE"=>0,
            "KI"=>0,
            "KR"=>0,
            "KW"=>0,
            "KG"=>0,
            "LA"=>0,
            "LV"=>0,
            "LB"=>0,
            "LS"=>0,
            "LR"=>0,
            "LY"=>0,
            "LT"=>0,
            "LU"=>0,
            "MK"=>0,
            "MG"=>0,
            "MW"=>0,
            "MY"=>0,
            "MV"=>0,
            "ML"=>0,
            "MT"=>0,
            "MR"=>0,
            "MU"=>0,
            "MX"=>0,
            "MD"=>0,
            "MN"=>0,
            "ME"=>0,
            "MA"=>0,
            "MZ"=>0,
            "MM"=>0,
            "NA"=>0,
            "NP"=>0,
            "NL"=>0,
            "NZ"=>0,
            "NI"=>0,
            "NE"=>0,
            "NG"=>0,
            "NO"=>0,
            "OM"=>0,
            "PK"=>0,
            "PA"=>0,
            "PG"=>0,
            "PY"=>0,
            "PE"=>0,
            "PH"=>0,
            "PL"=>0,
            "PT"=>0,
            "QA"=>0,
            "RO"=>0,
            "RU"=>0,
            "RW"=>0,
            "WS"=>0,
            "ST"=>0,
            "SA"=>0,
            "SN"=>0,
            "RS"=>0,
            "SC"=>0,
            "SL"=>0,
            "SG"=>0,
            "SK"=>0,
            "SI"=>0,
            "SB"=>0,
            "ZA"=>0,
            "ES"=>0,
            "LK"=>0,
            "KN"=>0,
            "LC"=>0,
            "VC"=>0,
            "SD"=>0,
            "SR"=>0,
            "SZ"=>0,
            "SE"=>0,
            "CH"=>0,
            "SY"=>0,
            "TW"=>0,
            "TJ"=>0,
            "TZ"=>0,
            "TH"=>0,
            "TL"=>0,
            "TG"=>0,
            "TO"=>0,
            "TT"=>0,
            "TN"=>0,
            "TR"=>0,
            "TM"=>0,
            "UG"=>0,
            "UA"=>0,
            "AE"=>0,
            "GB"=>0,
            "US"=>0,
            "UY"=>0,
            "UZ"=>0,
            "VU"=>0,
            "VE"=>0,
            "VN"=>0,
            "YE"=>0,
            "ZM"=>0,
            "ZW"=>0
        ];
        $top3_countries = array();
        foreach ($valuebycountries as $valuebycountry) {
            $code_pays[$valuebycountry['code_pays']] = $valuebycountry['total_valeur'];
        }

        /*arsort($code_pays);
        for($i=0;$i<3;$i++){
            $top3_countries[pos(key($code_pays))] = pos($code_pays));
            next($code_pays);
        }
        dump($top3_countries);die;*/
        return $this->render('kpi_generaux/index.html.twig', [
            'controller_name' => 'KpiGenerauxController',
            'valuebycountries' => $code_pays,
            'annees' => $annees,
            'annee' => $annee,
            'valuespipeline' => $valuespipeline,
            'valuesPerfAllComm' => $valuesPerfAllComm,
            'CA' => $CA,
            'firstComm' => $FirstComm,
            'topComm' => $TopComm,
            'tauxDevis' => $tauxDevis,
            'tauxCmd' => $tauxCmd,
        ]);
    }
}
