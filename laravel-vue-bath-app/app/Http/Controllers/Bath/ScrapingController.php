<?php

namespace App\Http\Controllers\Bath;

use App\Http\Controllers\Controller;
use App\Models\Bath;
use App\Services\CodeNameService;
use Goutte\Client;

/**
 * お風呂スクレイピング用 コントローラー
 */
class ScrapingController extends Controller
{
    /** コード名称サービス */
    protected $codeNameService;

    /**
     * コンストラクタ
     *
     * @param CodeNameService $codeNameService コード名称サービスのインスタンス
     */
    public function __construct(CodeNameService $codeNameService)
    {
        $this->codeNameService = $codeNameService;
    }

    public function getBath()
    {
        $client = new Client();
        $hokaido = $client->request('GET', "https://www.supersento.com/hokaidotohoku/hokaido.html");
        $aomori = $client->request('GET', "https://www.supersento.com/hokaidotohoku/aomori.html");
        $iwate = $client->request('GET', "https://www.supersento.com/hokaidotohoku/iwate.html");
        $akita = $client->request('GET', "https://www.supersento.com/hokaidotohoku/akita.html");
        $yamagata = $client->request('GET', "https://www.supersento.com/hokaidotohoku/yamagata.html");
        $miyagi = $client->request('GET', "https://www.supersento.com/hokaidotohoku/miyagi.html");
        $fukushima = $client->request('GET', "https://www.supersento.com/hokaidotohoku/fukushima.html");
        $ibaraki = $client->request('GET', "https://www.supersento.com/kanto/ibaraki.html");
        $tochigi = $client->request('GET', "https://www.supersento.com/kanto/tochigi.html");
        $gunma = $client->request('GET', "https://www.supersento.com/kanto/gunma.html");
        $saitama = $client->request('GET', "https://www.supersento.com/kanto/saitama.html");
        $chiba = $client->request('GET', "https://www.supersento.com/kanto/chiba.html");
        $tokyo = $client->request('GET', "https://www.supersento.com/kanto/tokyo.html");
        $kanagawa = $client->request('GET', "https://www.supersento.com/kanto/kanagawa.html");
        $niigata = $client->request('GET', "https://www.supersento.com/hokuriku/niigata.html");
        $toyama = $client->request('GET', "https://www.supersento.com/hokuriku/toyama.html");
        $ishikawa = $client->request('GET', "https://www.supersento.com/hokuriku/ishikawa.html");
        $fukui = $client->request('GET', "https://www.supersento.com/hokuriku/fukui.html");
        $yamanashi = $client->request('GET', "https://www.supersento.com/kanto/yamanashi.html");
        $nagano = $client->request('GET', "https://www.supersento.com/hokuriku/nagano.html");
        $gifu = $client->request('GET', "https://www.supersento.com/chubu/gifu.html");
        $shizuoka = $client->request('GET', "https://www.supersento.com/chubu/shizuoka.html");
        $aichi = $client->request('GET', "https://www.supersento.com/chubu/aichi/aichi.html");
        $mie = $client->request('GET', "https://www.supersento.com/chubu/mie.html");

        $shiga = $client->request('GET', "https://www.supersento.com/kinki/shiga.html");
        $kyoto = $client->request('GET', "https://www.supersento.com/kinki/kyoto.html");
        $osaka = $client->request('GET', "https://www.supersento.com/kinki/osaka.html");
        $hyogo = $client->request('GET', "https://www.supersento.com/kinki/hyogo.html");
        $nara = $client->request('GET', "https://www.supersento.com/kinki/nara.html");
        $wakayama = $client->request('GET', "https://www.supersento.com/kinki/wakayama.html");

        $totori = $client->request('GET', "https://www.supersento.com/chugoku/totori.html");
        $shimane = $client->request('GET', "https://www.supersento.com/chugoku/shimane.html");
        $okayama = $client->request('GET', "https://www.supersento.com/chugoku/okayama.html");
        $hiroshima = $client->request('GET', "https://www.supersento.com/chugoku/hiroshima.html");
        $yamaguchi = $client->request('GET', "https://www.supersento.com/chugoku/yamaguchi.html");

        $tokushima = $client->request('GET', "https://www.supersento.com/shikoku/tokushima.html");
        $kagawa = $client->request('GET', "https://www.supersento.com/shikoku/kagawa.html");
        $ehime = $client->request('GET', "https://www.supersento.com/shikoku/ehime.html");
        $kochi = $client->request('GET', "https://www.supersento.com/shikoku/kochi.html");

        $fukuoka = $client->request('GET', "https://www.supersento.com/kyusyu/fukuoka.html");
        $saga = $client->request('GET', "https://www.supersento.com/kyusyu/saga.html");
        $nagasaki = $client->request('GET', "https://www.supersento.com/kyusyu/nagasaki.html");
        $kumamoto = $client->request('GET', "https://www.supersento.com/kyusyu/kumamoto.html");
        $ooita = $client->request('GET', "https://www.supersento.com/kyusyu/ooita.html");
        $miyazaki = $client->request('GET', "https://www.supersento.com/kyusyu/miyazaki.html");
        $kagoshima = $client->request('GET', "https://www.supersento.com/kyusyu/kagoshima.html");
        $okinawa = $client->request('GET', "https://www.supersento.com/okinawa/okinawa.html");

        // 全国お風呂名称取得
        $hokaido_name1 = $hokaido->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $hokaido_name2 = $hokaido->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $aomori_name1 = $aomori->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $aomori_name2 = $aomori->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $aomori_name3 = $aomori->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $iwate_name1 = $iwate->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $iwate_name2 = $iwate->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $iwate_name3 = $iwate->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $akita_name1 = $akita->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $akita_name2 = $akita->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $akita_name3 = $akita->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $yamagata_name = $yamagata->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $miyagi_name1 = $miyagi->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $miyagi_name2 = $miyagi->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $fukushima_name1 = $fukushima->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $fukushima_name2 = $fukushima->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $fukushima_name3 = $fukushima->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $ibaraki_name1 = $ibaraki->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $ibaraki_name2 = $ibaraki->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $tochigi_name1 = $tochigi->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $tochigi_name2 = $tochigi->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $gunma_name1 = $gunma->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $gunma_name2 = $gunma->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $saitama_name1 = $saitama->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $saitama_name2 = $saitama->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $chiba_name1 = $chiba->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $chiba_name2 = $chiba->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $tokyo_name1 = $tokyo->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $tokyo_name2 = $tokyo->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $tokyo_name3 = $tokyo->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $kanagawa_name1 = $kanagawa->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $kanagawa_name2 = $kanagawa->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $niigata_name1 = $niigata->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $niigata_name2 = $niigata->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $niigata_name3 = $niigata->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $toyama_name1 = $toyama->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $toyama_name2 = $toyama->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $toyama_name3 = $toyama->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $ishikawa_name1 = $ishikawa->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $ishikawa_name2 = $ishikawa->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $ishikawa_name3 = $ishikawa->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $fukui_name1 = $fukui->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $fukui_name2 = $fukui->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $fukui_name3 = $fukui->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $yamanashi_name1 = $yamanashi->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $yamanashi_name2 = $yamanashi->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $yamanashi_name3 = $yamanashi->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $nagano_name1 = $nagano->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $nagano_name2 = $nagano->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $gifu_name1 = $gifu->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $gifu_name2 = $gifu->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $shizuoka_name1 = $shizuoka->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $shizuoka_name2 = $shizuoka->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $aichi_name1 = $aichi->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $aichi_name2 = $aichi->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $mie_name1 = $mie->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $mie_name2 = $mie->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $shiga_name1 = $shiga->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $shiga_name2 = $shiga->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $kyoto_name1 = $kyoto->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $kyoto_name2 = $kyoto->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $kyoto_name3 = $kyoto->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $osaka_name1 = $osaka->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $osaka_name2 = $osaka->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $hyogo_name1 = $hyogo->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $hyogo_name2 = $hyogo->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $nara_name1 = $nara->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $nara_name2 = $nara->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $nara_name3 = $nara->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $wakayama_name1 = $wakayama->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $wakayama_name2 = $wakayama->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $wakayama_name3 = $wakayama->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $totori_name1 = $totori->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $shimane_name1 = $shimane->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $shimane_name2 = $shimane->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $shimane_name3 = $shimane->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $okayama_name1 = $okayama->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $okayama_name2 = $okayama->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $okayama_name3 = $okayama->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $hiroshima_name1 = $hiroshima->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $hiroshima_name2 = $hiroshima->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $yamaguchi_name1 = $yamaguchi->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $yamaguchi_name2 = $yamaguchi->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $yamaguchi_name3 = $yamaguchi->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $tokushima_name1 = $tokushima->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $tokushima_name2 = $tokushima->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $kagawa_name1 = $kagawa->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $kagawa_name2 = $kagawa->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $ehime_name1 = $ehime->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $ehime_name2 = $ehime->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $ehime_name3 = $ehime->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $kochi_name1 = $kochi->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $fukuoka_name1 = $fukuoka->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $fukuoka_name2 = $fukuoka->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $saga_name1 = $saga->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $saga_name2 = $saga->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $nagasaki_name1 = $nagasaki->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $nagasaki_name2 = $nagasaki->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $kumamoto_name1 = $kumamoto->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $kumamoto_name2 = $kumamoto->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $ooita_name1 = $ooita->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $ooita_name2 = $ooita->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $ooita_name3 = $ooita->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $miyazaki_name1 = $miyazaki->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $miyazaki_name2 = $miyazaki->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $kagoshima_name1 = $kagoshima->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $kagoshima_name2 = $kagoshima->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $kagoshima_name3 = $kagoshima->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });
        $okinawa_name1 = $okinawa->filter('.res_tenmei')->each(function ($node) { return $node->text(); });
        $okinawa_name2 = $okinawa->filter('.res_tenmei2')->each(function ($node) { return $node->text(); });
        $okinawa_name3 = $okinawa->filter('.res_tenmei3')->each(function ($node) { return $node->text(); });

        $hokaido_name = array_merge($hokaido_name1, $hokaido_name2);
        $aomori_name = array_merge($aomori_name1, $aomori_name2, $aomori_name3);
        $iwate_name = array_merge($iwate_name1, $iwate_name2, $iwate_name3);
        $akita_name = array_merge($akita_name1, $akita_name2, $akita_name3);
        $miyagi_name = array_merge($miyagi_name1, $miyagi_name2);
        $fukushima_name = array_merge($fukushima_name1, $fukushima_name2, $fukushima_name3);
        $ibaraki_name = array_merge($ibaraki_name1, $ibaraki_name2);
        $tochigi_name = array_merge($tochigi_name1, $tochigi_name2);
        $gunma_name = array_merge($gunma_name1, $gunma_name2);
        $saitama_name = array_merge($saitama_name1, $saitama_name2);
        $chiba_name = array_merge($chiba_name1, $chiba_name2);
        $tokyo_name = array_merge($tokyo_name1, $tokyo_name2, $tokyo_name3);
        $kanagawa_name = array_merge($kanagawa_name1, $kanagawa_name2);
        $niigata_name = array_merge($niigata_name1, $niigata_name2, $niigata_name3);
        $toyama_name = array_merge($toyama_name1, $toyama_name2, $toyama_name3);
        $ishikawa_name = array_merge($ishikawa_name1, $ishikawa_name2, $ishikawa_name3);
        $fukui_name = array_merge($fukui_name1, $fukui_name2, $fukui_name3);
        $yamanashi_name = array_merge($yamanashi_name1, $yamanashi_name2, $yamanashi_name3);
        $nagano_name = array_merge($nagano_name1, $nagano_name2);
        $gifu_name = array_merge($gifu_name1, $gifu_name2);
        $shizuoka_name = array_merge($shizuoka_name1, $shizuoka_name2);
        $aichi_name = array_merge($aichi_name1, $aichi_name2);
        $mie_name = array_merge($mie_name1, $mie_name2);
        $shiga_name = array_merge($shiga_name1, $shiga_name2);
        $kyoto_name = array_merge($kyoto_name1, $kyoto_name2, $kyoto_name3);
        $osaka_name = array_merge($osaka_name1, $osaka_name2);
        $hyogo_name = array_merge($hyogo_name1, $hyogo_name2);
        $nara_name = array_merge($nara_name1, $nara_name2, $nara_name3);
        $wakayama_name = array_merge($wakayama_name1, $wakayama_name2, $wakayama_name3);
        $totori_name = array_merge($totori_name1);
        $shimane_name = array_merge($shimane_name1, $shimane_name2, $shimane_name3);
        $okayama_name = array_merge($okayama_name1, $okayama_name2, $okayama_name3);
        $hiroshima_name = array_merge($hiroshima_name1, $hiroshima_name2);
        $yamaguchi_name = array_merge($yamaguchi_name1, $yamaguchi_name2, $yamaguchi_name3);
        $tokushima_name = array_merge($tokushima_name1, $tokushima_name2);
        $kagawa_name = array_merge($kagawa_name1, $kagawa_name2);
        $ehime_name = array_merge($ehime_name1, $ehime_name2, $ehime_name3);
        $kochi_name = array_merge($kochi_name1);
        $fukuoka_name = array_merge($fukuoka_name1, $fukuoka_name2);
        $saga_name = array_merge($saga_name1, $saga_name2);
        $nagasaki_name = array_merge($nagasaki_name1, $nagasaki_name2);
        $kumamoto_name = array_merge($kumamoto_name1, $kumamoto_name2);
        $ooita_name = array_merge($ooita_name1, $ooita_name2, $ooita_name3);
        $miyazaki_name = array_merge($miyazaki_name1, $miyazaki_name2);
        $kagoshima_name = array_merge($kagoshima_name1, $kagoshima_name2, $kagoshima_name3);
        $okinawa_name = array_merge($okinawa_name1, $okinawa_name2);

        $names = array_merge(
            $hokaido_name, $aomori_name, $iwate_name, $miyagi_name, $akita_name, $yamagata_name, $fukushima_name, $tochigi_name, $ibaraki_name,
            $gunma_name, $saitama_name, $chiba_name, $tokyo_name, $kanagawa_name, $niigata_name, $toyama_name, $ishikawa_name, $fukui_name,
            $yamanashi_name, $nagano_name, $gifu_name, $shizuoka_name, $aichi_name, $mie_name, $shiga_name, $kyoto_name, $osaka_name, $hyogo_name,
            $nara_name, $wakayama_name, $totori_name, $shimane_name, $okayama_name, $hiroshima_name, $yamaguchi_name, $tokushima_name, $kagawa_name,
            $ehime_name, $kochi_name, $fukuoka_name, $saga_name, $nagasaki_name, $kumamoto_name, $ooita_name, $miyazaki_name, $kagoshima_name,
            $okinawa_name
        );

        // 全国お風呂休館日取得
        $hokaido_yasumi = $hokaido->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $aomori_yasumi = $aomori->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $akita_yasumi = $akita->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $iwate_yasumi = $iwate->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $yamagata_yasumi = $yamagata->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $miyagi_yasumi = $miyagi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $fukushima_yasumi = $fukushima->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $ibaraki_yasumi = $ibaraki->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $tochigi_yasumi = $tochigi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $gunma_yasumi = $gunma->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $saitama_yasumi = $saitama->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $chiba_yasumi = $chiba->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $tokyo_yasumi = $tokyo->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $kanagawa_yasumi = $kanagawa->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $niigata_yasumi = $niigata->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $toyama_yasumi = $toyama->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $ishikawa_yasumi = $ishikawa->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $fukui_yasumi = $fukui->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $yamanashi_yasumi = $yamanashi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $nagano_yasumi = $nagano->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $gifu_yasumi = $gifu->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $shizuoka_yasumi = $shizuoka->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $aichi_yasumi = $aichi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $mie_yasumi = $mie->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $shiga_yasumi = $shiga->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $kyoto_yasumi = $kyoto->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $osaka_yasumi = $osaka->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $hyogo_yasumi = $hyogo->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $hokaido_yasumi_value = array_values(array_diff($hokaido_yasumi, array('休業日')));
        $aomori_yasumi_value = array_values(array_diff($aomori_yasumi, array('休業日')));
        $akita_yasumi_value = array_values(array_diff($akita_yasumi, array('休業日')));
        $iwate_yasumi_value = array_values(array_diff($iwate_yasumi, array('休業日')));
        $yamagata_yasumi_value = array_values(array_diff($yamagata_yasumi, array('休業日')));
        $miyagi_yasumi_value = array_values(array_diff($miyagi_yasumi, array('休業日')));
        $fukushima_yasumi_value = array_values(array_diff($fukushima_yasumi, array('休業日')));
        $ibaraki_yasumi_value = array_values(array_diff($ibaraki_yasumi, array('休業日')));
        $tochigi_yasumi_value = array_values(array_diff($tochigi_yasumi, array('休業日')));
        $gunma_yasumi_value = array_values(array_diff($gunma_yasumi, array('休業日')));
        $saitama_yasumi_value = array_values(array_diff($saitama_yasumi, array('休業日')));
        $chiba_yasumi_value = array_values(array_diff($chiba_yasumi, array('休業日')));
        $tokyo_yasumi_value = array_values(array_diff($tokyo_yasumi, array('休業日')));
        $kanagawa_yasumi_value = array_values(array_diff($kanagawa_yasumi, array('休業日')));
        $niigata_yasumi_value = array_values(array_diff($niigata_yasumi, array('休業日')));
        $toyama_yasumi_value = array_values(array_diff($toyama_yasumi, array('休業日')));
        $ishikawa_yasumi_value = array_values(array_diff($ishikawa_yasumi, array('休業日')));
        $fukui_yasumi_value = array_values(array_diff($fukui_yasumi, array('休業日')));
        $yamanashi_yasumi_value = array_values(array_diff($yamanashi_yasumi, array('休業日')));
        $nagano_yasumi_value = array_values(array_diff($nagano_yasumi, array('休業日')));
        $gifu_yasumi_value = array_values(array_diff($gifu_yasumi, array('休業日')));
        $shizuoka_yasumi_value = array_values(array_diff($shizuoka_yasumi, array('休業日')));
        $aichi_yasumi_value = array_values(array_diff($aichi_yasumi, array('休業日')));
        $mie_yasumi_value = array_values(array_diff($mie_yasumi, array('休業日')));
        $shiga_yasumi_value = array_values(array_diff($shiga_yasumi, array('休業日')));
        $kyoto_yasumi_value = array_values(array_diff($kyoto_yasumi, array('休業日')));
        $osaka_yasumi_value = array_values(array_diff($osaka_yasumi, array('休業日')));
        $hyogo_yasumi_value = array_values(array_diff($hyogo_yasumi, array('休業日')));

        $nara_yasumi = $nara->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $nara_yasumi_value = array_values(array_diff($nara_yasumi, array('休業日')));
        $wakayama_yasumi = $wakayama->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $wakayama_yasumi_value = array_values(array_diff($wakayama_yasumi, array('休業日')));
        $totori_yasumi = $totori->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $totori_yasumi_value = array_values(array_diff($totori_yasumi, array('休業日')));
        $shimane_yasumi = $shimane->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $shimane_yasumi_value = array_values(array_diff($shimane_yasumi, array('休業日')));
        $okayama_yasumi = $okayama->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $okayama_yasumi_value = array_values(array_diff($okayama_yasumi, array('休業日')));
        $hiroshima_yasumi = $hiroshima->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $hiroshima_yasumi_value = array_values(array_diff($hiroshima_yasumi, array('休業日')));
        $yamaguchi_yasumi = $yamaguchi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $yamaguchi_yasumi_value = array_values(array_diff($yamaguchi_yasumi, array('休業日')));
        $tokushima_yasumi = $tokushima->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $tokushima_yasumi_value = array_values(array_diff($tokushima_yasumi, array('休業日')));
        $kagawa_yasumi = $kagawa->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $kagawa_yasumi_value = array_values(array_diff($kagawa_yasumi, array('休業日')));
        $ehime_yasumi = $ehime->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $ehime_yasumi_value = array_values(array_diff($ehime_yasumi, array('休業日')));
        $kochi_yasumi = $kochi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $kochi_yasumi_value = array_values(array_diff($kochi_yasumi, array('休業日')));
        $fukuoka_yasumi = $fukuoka->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $fukuoka_yasumi_value = array_values(array_diff($fukuoka_yasumi, array('休業日')));
        $saga_yasumi = $saga->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $saga_yasumi_value = array_values(array_diff($saga_yasumi, array('休業日')));
        $nagasaki_yasumi = $nagasaki->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $nagasaki_yasumi_value = array_values(array_diff($nagasaki_yasumi, array('休業日')));
        $kumamoto_yasumi = $kumamoto->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $kumamoto_yasumi_value = array_values(array_diff($kumamoto_yasumi, array('休業日')));
        $ooita_yasumi = $ooita->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $ooita_yasumi_value = array_values(array_diff($ooita_yasumi, array('休業日')));
        $miyazaki_yasumi = $miyazaki->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $miyazaki_yasumi_value = array_values(array_diff($miyazaki_yasumi, array('休業日')));
        $kagoshima_yasumi = $kagoshima->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $kagoshima_yasumi_value = array_values(array_diff($kagoshima_yasumi, array('休業日')));
        $okinawa_yasumi = $okinawa->filter('.yasumi')->each(function ($node) { return $node->text(); });
        $okinawa_yasumi_value = array_values(array_diff($okinawa_yasumi, array('休業日')));
        $closes = array_merge(
            $hokaido_yasumi_value, $aomori_yasumi_value, $iwate_yasumi_value, $miyagi_yasumi_value, $akita_yasumi_value,
            $yamagata_yasumi_value, $fukushima_yasumi_value, $tochigi_yasumi_value, $ibaraki_yasumi_value, $gunma_yasumi_value,
            $saitama_yasumi_value, $chiba_yasumi_value, $tokyo_yasumi_value, $kanagawa_yasumi_value, $niigata_yasumi_value,
            $toyama_yasumi_value, $ishikawa_yasumi_value, $fukui_yasumi_value, $yamanashi_yasumi_value, $nagano_yasumi_value,
            $gifu_yasumi_value, $shizuoka_yasumi_value, $aichi_yasumi_value, $mie_yasumi_value, $shiga_yasumi_value, $kyoto_yasumi_value,
            $osaka_yasumi_value, $hyogo_yasumi_value, $nara_yasumi_value, $wakayama_yasumi_value, $totori_yasumi_value, $shimane_yasumi_value,
            $okayama_yasumi_value, $hiroshima_yasumi_value, $yamaguchi_yasumi_value, $tokushima_yasumi_value, $kagawa_yasumi_value,
            $ehime_yasumi_value, $kochi_yasumi_value, $fukuoka_yasumi_value, $saga_yasumi_value, $nagasaki_yasumi_value, $kumamoto_yasumi_value,
            $ooita_yasumi_value, $miyazaki_yasumi_value, $kagoshima_yasumi_value, $okinawa_yasumi_value
        );

        $prefecures = array_merge(
            array_fill(0, count($hokaido_name), '北海道'),
            array_fill(0, count($aomori_name), '青森県'),array_fill(0, count($iwate_name), '岩手県'),array_fill(0, count($miyagi_name), '宮城県')
            ,array_fill(0, count($akita_name), '秋田県'),array_fill(0, count($yamagata_name), '山形県'),array_fill(0, count($fukushima_name), '福島県')
            ,array_fill(0, count($ibaraki_name), '茨城県'),array_fill(0, count($tochigi_name), '栃木県'),array_fill(0, count($gunma_name), '群馬県')
            ,array_fill(0, count($saitama_name), '埼玉県'),array_fill(0, count($chiba_name), '千葉県'),array_fill(0, count($tokyo_name), '東京都')
            ,array_fill(0, count($kanagawa_name), '神奈川県'),array_fill(0, count($niigata_name), '新潟県'),array_fill(0, count($toyama_name), '富山県')
            ,array_fill(0, count($ishikawa_name), '石川県'),array_fill(0, count($fukui_name), '福井県'),array_fill(0, count($yamanashi_name), '山梨県')
            ,array_fill(0, count($nagano_name), '長野県'),array_fill(0, count($gifu_name), '岐阜県'),array_fill(0, count($shizuoka_name), '静岡県')
            ,array_fill(0, count($aichi_name), '愛知県'),array_fill(0, count($mie_name), '三重県'),array_fill(0, count($shiga_name), '滋賀県')
            ,array_fill(0, count($kyoto_name), '京都府'),array_fill(0, count($osaka_name), '大阪府'),array_fill(0, count($hyogo_name), '兵庫県')
            ,array_fill(0, count($nara_name), '奈良県'),array_fill(0, count($wakayama_name), '和歌山'),array_fill(0, count($totori_name), '鳥取県')
            ,array_fill(0, count($shimane_name), '島根県'),array_fill(0, count($okayama_name), '岡山県'),array_fill(0, count($hiroshima_name), '広島県')
            ,array_fill(0, count($yamaguchi_name), '山口県'),array_fill(0, count($tokushima_name), '徳島県'),array_fill(0, count($kagawa_name), '香川県')
            ,array_fill(0, count($ehime_name), '愛媛県'),array_fill(0, count($kochi_name), '高知県'),array_fill(0, count($fukuoka_name), '福岡県')
            ,array_fill(0, count($saga_name), '佐賀県'),array_fill(0, count($nagasaki_name), '長崎県'),array_fill(0, count($kumamoto_name), '熊本県')
            ,array_fill(0, count($ooita_name), '大分県'),array_fill(0, count($miyazaki_name), '宮崎県'),array_fill(0, count($kagoshima_name), '鹿児島')
            ,array_fill(0, count($okinawa_name), '沖縄県')
        );
        for($i=0; $i<count($names);$i++) {
            Bath::insert([
                'name' => $names[$i],
                'closing_day' => $closes[$i],
                'place' => $prefecures[$i],
            ]);
        }
    }
}
