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
        // 各都道府県のお風呂情報url取得
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

        // 【配列】各都道府県のお風呂情報url
        $prefecture_arr = [
            $hokaido, $aomori, $iwate, $akita, $yamagata, $miyagi, $fukushima, $ibaraki, $tochigi, $gunma,
            $saitama, $chiba, $tokyo, $kanagawa, $niigata, $toyama, $ishikawa, $fukui, $yamanashi, $nagano,
            $gifu, $shizuoka, $aichi, $mie, $shiga, $kyoto, $osaka, $hyogo, $nara, $wakayama, $totori, $shimane,
            $okayama, $hiroshima, $yamaguchi, $tokushima, $kagawa, $ehime, $kochi, $fukuoka, $saga, $nagasaki,
            $kumamoto, $ooita, $miyazaki, $kagoshima, $okinawa
        ];

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
            $hokaido_name, $aomori_name, $iwate_name, $akita_name, $yamagata_name, $miyagi_name, $fukushima_name, $ibaraki_name, $tochigi_name,
            $gunma_name, $saitama_name, $chiba_name, $tokyo_name, $kanagawa_name, $niigata_name, $toyama_name, $ishikawa_name, $fukui_name,
            $yamanashi_name, $nagano_name, $gifu_name, $shizuoka_name, $aichi_name, $mie_name, $shiga_name, $kyoto_name, $osaka_name, $hyogo_name,
            $nara_name, $wakayama_name, $totori_name, $shimane_name, $okayama_name, $hiroshima_name, $yamaguchi_name, $tokushima_name, $kagawa_name,
            $ehime_name, $kochi_name, $fukuoka_name, $saga_name, $nagasaki_name, $kumamoto_name, $ooita_name, $miyazaki_name, $kagoshima_name,
            $okinawa_name
        );

        // お風呂URL取得
        $hokaido_href1 = $hokaido->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $hokaido_href2 = $hokaido->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $aomori_href1 = $aomori->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $aomori_href2 = $aomori->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $aomori_href3 = $aomori->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $iwate_href1 = $iwate->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $iwate_href2 = $iwate->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $iwate_href3 = $iwate->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $akita_href1 = $akita->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $akita_href2 = $akita->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $akita_href3 = $akita->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $yamagata_href = $yamagata->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $miyagi_href1 = $miyagi->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $miyagi_href2 = $miyagi->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $fukushima_href1 = $fukushima->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $fukushima_href2 = $fukushima->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $fukushima_href3 = $fukushima->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $ibaraki_href1 = $ibaraki->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $ibaraki_href2 = $ibaraki->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $tochigi_href1 = $tochigi->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $tochigi_href2 = $tochigi->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $gunma_href1 = $gunma->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $gunma_href2 = $gunma->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $saitama_href1 = $saitama->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $saitama_href2 = $saitama->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $chiba_href1 = $chiba->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $chiba_href2 = $chiba->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $tokyo_href1 = $tokyo->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $tokyo_href2 = $tokyo->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $tokyo_href3 = $tokyo->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $kanagawa_href1 = $kanagawa->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $kanagawa_href2 = $kanagawa->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $niigata_href1 = $niigata->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $niigata_href2 = $niigata->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $niigata_href3 = $niigata->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $toyama_href1 = $toyama->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $toyama_href2 = $toyama->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $toyama_href3 = $toyama->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $ishikawa_href1 = $ishikawa->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $ishikawa_href2 = $ishikawa->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $ishikawa_href3 = $ishikawa->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $fukui_href1 = $fukui->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $fukui_href2 = $fukui->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $fukui_href3 = $fukui->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $yamanashi_href1 = $yamanashi->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $yamanashi_href2 = $yamanashi->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $yamanashi_href3 = $yamanashi->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $nagano_href1 = $nagano->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $nagano_href2 = $nagano->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $gifu_href1 = $gifu->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $gifu_href2 = $gifu->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $shizuoka_href1 = $shizuoka->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $shizuoka_href2 = $shizuoka->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $aichi_href1 = $aichi->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $aichi_href2 = $aichi->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $mie_href1 = $mie->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $mie_href2 = $mie->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $shiga_href1 = $shiga->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $shiga_href2 = $shiga->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $kyoto_href1 = $kyoto->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $kyoto_href2 = $kyoto->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $kyoto_href3 = $kyoto->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $osaka_href1 = $osaka->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $osaka_href2 = $osaka->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $hyogo_href1 = $hyogo->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $hyogo_href2 = $hyogo->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $nara_href1 = $nara->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $nara_href2 = $nara->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $nara_href3 = $nara->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $wakayama_href1 = $wakayama->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $wakayama_href2 = $wakayama->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $wakayama_href3 = $wakayama->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $totori_href1 = $totori->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $shimane_href1 = $shimane->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $shimane_href2 = $shimane->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $shimane_href3 = $shimane->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $okayama_href1 = $okayama->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $okayama_href2 = $okayama->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $okayama_href3 = $okayama->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $hiroshima_href1 = $hiroshima->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $hiroshima_href2 = $hiroshima->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $yamaguchi_href1 = $yamaguchi->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $yamaguchi_href2 = $yamaguchi->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $yamaguchi_href3 = $yamaguchi->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $tokushima_href1 = $tokushima->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $tokushima_href2 = $tokushima->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $kagawa_href1 = $kagawa->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $kagawa_href2 = $kagawa->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $ehime_href1 = $ehime->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $ehime_href2 = $ehime->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $ehime_href3 = $ehime->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $kochi_href1 = $kochi->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $fukuoka_href1 = $fukuoka->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $fukuoka_href2 = $fukuoka->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $saga_href1 = $saga->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $saga_href2 = $saga->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $nagasaki_href1 = $nagasaki->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $nagasaki_href2 = $nagasaki->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $kumamoto_href1 = $kumamoto->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $kumamoto_href2 = $kumamoto->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $ooita_href1 = $ooita->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $ooita_href2 = $ooita->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $ooita_href3 = $ooita->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $miyazaki_href1 = $miyazaki->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $miyazaki_href2 = $miyazaki->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $kagoshima_href1 = $kagoshima->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $kagoshima_href2 = $kagoshima->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $kagoshima_href3 = $kagoshima->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });
        $okinawa_href1 = $okinawa->filter('.res_tenmei a')->each(function ($node) { return $node->attr('href'); });
        $okinawa_href2 = $okinawa->filter('.res_tenmei2 a')->each(function ($node) { return $node->attr('href'); });
        $okinawa_href3 = $okinawa->filter('.res_tenmei3 a')->each(function ($node) { return $node->attr('href'); });

        $hokaido_href = array_merge($hokaido_href1, $hokaido_href2);
        $aomori_href = array_merge($aomori_href1, $aomori_href2, $aomori_href3);
        $iwate_href = array_merge($iwate_href1, $iwate_href2, $iwate_href3);
        $akita_href = array_merge($akita_href1, $akita_href2, $akita_href3);
        $miyagi_href = array_merge($miyagi_href1, $miyagi_href2);
        $fukushima_href = array_merge($fukushima_href1, $fukushima_href2, $fukushima_href3);
        $ibaraki_href = array_merge($ibaraki_href1, $ibaraki_href2);
        $tochigi_href = array_merge($tochigi_href1, $tochigi_href2);
        $gunma_href = array_merge($gunma_href1, $gunma_href2);
        $saitama_href = array_merge($saitama_href1, $saitama_href2);
        $chiba_href = array_merge($chiba_href1, $chiba_href2);
        $tokyo_href = array_merge($tokyo_href1, $tokyo_href2, $tokyo_href3);
        $kanagawa_href = array_merge($kanagawa_href1, $kanagawa_href2);
        $niigata_href = array_merge($niigata_href1, $niigata_href2, $niigata_href3);
        $toyama_href = array_merge($toyama_href1, $toyama_href2, $toyama_href3);
        $ishikawa_href = array_merge($ishikawa_href1, $ishikawa_href2, $ishikawa_href3);
        $fukui_href = array_merge($fukui_href1, $fukui_href2, $fukui_href3);
        $yamanashi_href = array_merge($yamanashi_href1, $yamanashi_href2, $yamanashi_href3);
        $nagano_href = array_merge($nagano_href1, $nagano_href2);
        $gifu_href = array_merge($gifu_href1, $gifu_href2);
        $shizuoka_href = array_merge($shizuoka_href1, $shizuoka_href2);
        $aichi_href = array_merge($aichi_href1, $aichi_href2);
        $mie_href = array_merge($mie_href1, $mie_href2);
        $shiga_href = array_merge($shiga_href1, $shiga_href2);
        $kyoto_href = array_merge($kyoto_href1, $kyoto_href2, $kyoto_href3);
        $osaka_href = array_merge($osaka_href1, $osaka_href2);
        $hyogo_href = array_merge($hyogo_href1, $hyogo_href2);
        $nara_href = array_merge($nara_href1, $nara_href2, $nara_href3);
        $wakayama_href = array_merge($wakayama_href1, $wakayama_href2, $wakayama_href3);
        $totori_href = array_merge($totori_href1);
        $shimane_href = array_merge($shimane_href1, $shimane_href2, $shimane_href3);
        $okayama_href = array_merge($okayama_href1, $okayama_href2, $okayama_href3);
        $hiroshima_href = array_merge($hiroshima_href1, $hiroshima_href2);
        $yamaguchi_href = array_merge($yamaguchi_href1, $yamaguchi_href2, $yamaguchi_href3);
        $tokushima_href = array_merge($tokushima_href1, $tokushima_href2);
        $kagawa_href = array_merge($kagawa_href1, $kagawa_href2);
        $ehime_href = array_merge($ehime_href1, $ehime_href2, $ehime_href3);
        $kochi_href = array_merge($kochi_href1);
        $fukuoka_href = array_merge($fukuoka_href1, $fukuoka_href2);
        $saga_href = array_merge($saga_href1, $saga_href2);
        $nagasaki_href = array_merge($nagasaki_href1, $nagasaki_href2);
        $kumamoto_href = array_merge($kumamoto_href1, $kumamoto_href2);
        $ooita_href = array_merge($ooita_href1, $ooita_href2, $ooita_href3);
        $miyazaki_href = array_merge($miyazaki_href1, $miyazaki_href2);
        $kagoshima_href = array_merge($kagoshima_href1, $kagoshima_href2, $kagoshima_href3);
        $okinawa_href = array_merge($okinawa_href1, $okinawa_href2);

        // $hrefs = array_merge(
        //     $hokaido_href, $aomori_href, $iwate_href, $akita_href, $yamagata_href, $miyagi_href, $fukushima_href, $ibaraki_href, $tochigi_href,
        //     $gunma_href, $saitama_href, $chiba_href, $tokyo_href, $kanagawa_href, $niigata_href, $toyama_href, $ishikawa_href, $fukui_href,
        //     $yamanashi_href, $nagano_href, $gifu_href, $shizuoka_href, $aichi_href, $mie_href, $shiga_href, $kyoto_href, $osaka_href, $hyogo_href,
        //     $nara_href, $wakayama_href, $totori_href, $shimane_href, $okayama_href, $hiroshima_href, $yamaguchi_href, $tokushima_href, $kagawa_href,
        //     $ehime_href, $kochi_href, $fukuoka_href, $saga_href, $nagasaki_href, $kumamoto_href, $ooita_href, $miyazaki_href, $kagoshima_href,
        //     $okinawa_href
        // );

        // 全国お風呂休館日取得
        // $hokaido_yasumi = $hokaido->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $aomori_yasumi = $aomori->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $akita_yasumi = $akita->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $iwate_yasumi = $iwate->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $yamagata_yasumi = $yamagata->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $miyagi_yasumi = $miyagi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $fukushima_yasumi = $fukushima->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $ibaraki_yasumi = $ibaraki->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $tochigi_yasumi = $tochigi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $gunma_yasumi = $gunma->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $saitama_yasumi = $saitama->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $chiba_yasumi = $chiba->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $tokyo_yasumi = $tokyo->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $kanagawa_yasumi = $kanagawa->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $niigata_yasumi = $niigata->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $toyama_yasumi = $toyama->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $ishikawa_yasumi = $ishikawa->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $fukui_yasumi = $fukui->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $yamanashi_yasumi = $yamanashi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $nagano_yasumi = $nagano->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $gifu_yasumi = $gifu->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $shizuoka_yasumi = $shizuoka->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $aichi_yasumi = $aichi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $mie_yasumi = $mie->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $shiga_yasumi = $shiga->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $kyoto_yasumi = $kyoto->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $osaka_yasumi = $osaka->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $hyogo_yasumi = $hyogo->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $hokaido_yasumi_value = array_values(array_diff($hokaido_yasumi, array('休業日')));
        // $aomori_yasumi_value = array_values(array_diff($aomori_yasumi, array('休業日')));
        // $akita_yasumi_value = array_values(array_diff($akita_yasumi, array('休業日')));
        // $iwate_yasumi_value = array_values(array_diff($iwate_yasumi, array('休業日')));
        // $yamagata_yasumi_value = array_values(array_diff($yamagata_yasumi, array('休業日')));
        // $miyagi_yasumi_value = array_values(array_diff($miyagi_yasumi, array('休業日')));
        // $fukushima_yasumi_value = array_values(array_diff($fukushima_yasumi, array('休業日')));
        // $ibaraki_yasumi_value = array_values(array_diff($ibaraki_yasumi, array('休業日')));
        // $tochigi_yasumi_value = array_values(array_diff($tochigi_yasumi, array('休業日')));
        // $gunma_yasumi_value = array_values(array_diff($gunma_yasumi, array('休業日')));
        // $saitama_yasumi_value = array_values(array_diff($saitama_yasumi, array('休業日')));
        // $chiba_yasumi_value = array_values(array_diff($chiba_yasumi, array('休業日')));
        // $tokyo_yasumi_value = array_values(array_diff($tokyo_yasumi, array('休業日')));
        // $kanagawa_yasumi_value = array_values(array_diff($kanagawa_yasumi, array('休業日')));
        // $niigata_yasumi_value = array_values(array_diff($niigata_yasumi, array('休業日')));
        // $toyama_yasumi_value = array_values(array_diff($toyama_yasumi, array('休業日')));
        // $ishikawa_yasumi_value = array_values(array_diff($ishikawa_yasumi, array('休業日')));
        // $fukui_yasumi_value = array_values(array_diff($fukui_yasumi, array('休業日')));
        // $yamanashi_yasumi_value = array_values(array_diff($yamanashi_yasumi, array('休業日')));
        // $nagano_yasumi_value = array_values(array_diff($nagano_yasumi, array('休業日')));
        // $gifu_yasumi_value = array_values(array_diff($gifu_yasumi, array('休業日')));
        // $shizuoka_yasumi_value = array_values(array_diff($shizuoka_yasumi, array('休業日')));
        // $aichi_yasumi_value = array_values(array_diff($aichi_yasumi, array('休業日')));
        // $mie_yasumi_value = array_values(array_diff($mie_yasumi, array('休業日')));
        // $shiga_yasumi_value = array_values(array_diff($shiga_yasumi, array('休業日')));
        // $kyoto_yasumi_value = array_values(array_diff($kyoto_yasumi, array('休業日')));
        // $osaka_yasumi_value = array_values(array_diff($osaka_yasumi, array('休業日')));
        // $hyogo_yasumi_value = array_values(array_diff($hyogo_yasumi, array('休業日')));

        // $nara_yasumi = $nara->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $nara_yasumi_value = array_values(array_diff($nara_yasumi, array('休業日')));
        // $wakayama_yasumi = $wakayama->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $wakayama_yasumi_value = array_values(array_diff($wakayama_yasumi, array('休業日')));
        // $totori_yasumi = $totori->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $totori_yasumi_value = array_values(array_diff($totori_yasumi, array('休業日')));
        // $shimane_yasumi = $shimane->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $shimane_yasumi_value = array_values(array_diff($shimane_yasumi, array('休業日')));
        // $okayama_yasumi = $okayama->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $okayama_yasumi_value = array_values(array_diff($okayama_yasumi, array('休業日')));
        // $hiroshima_yasumi = $hiroshima->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $hiroshima_yasumi_value = array_values(array_diff($hiroshima_yasumi, array('休業日')));
        // $yamaguchi_yasumi = $yamaguchi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $yamaguchi_yasumi_value = array_values(array_diff($yamaguchi_yasumi, array('休業日')));
        // $tokushima_yasumi = $tokushima->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $tokushima_yasumi_value = array_values(array_diff($tokushima_yasumi, array('休業日')));
        // $kagawa_yasumi = $kagawa->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $kagawa_yasumi_value = array_values(array_diff($kagawa_yasumi, array('休業日')));
        // $ehime_yasumi = $ehime->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $ehime_yasumi_value = array_values(array_diff($ehime_yasumi, array('休業日')));
        // $kochi_yasumi = $kochi->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $kochi_yasumi_value = array_values(array_diff($kochi_yasumi, array('休業日')));
        // $fukuoka_yasumi = $fukuoka->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $fukuoka_yasumi_value = array_values(array_diff($fukuoka_yasumi, array('休業日')));
        // $saga_yasumi = $saga->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $saga_yasumi_value = array_values(array_diff($saga_yasumi, array('休業日')));
        // $nagasaki_yasumi = $nagasaki->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $nagasaki_yasumi_value = array_values(array_diff($nagasaki_yasumi, array('休業日')));
        // $kumamoto_yasumi = $kumamoto->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $kumamoto_yasumi_value = array_values(array_diff($kumamoto_yasumi, array('休業日')));
        // $ooita_yasumi = $ooita->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $ooita_yasumi_value = array_values(array_diff($ooita_yasumi, array('休業日')));
        // $miyazaki_yasumi = $miyazaki->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $miyazaki_yasumi_value = array_values(array_diff($miyazaki_yasumi, array('休業日')));
        // $kagoshima_yasumi = $kagoshima->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $kagoshima_yasumi_value = array_values(array_diff($kagoshima_yasumi, array('休業日')));
        // $okinawa_yasumi = $okinawa->filter('.yasumi')->each(function ($node) { return $node->text(); });
        // $okinawa_yasumi_value = array_values(array_diff($okinawa_yasumi, array('休業日')));
        // $closes = array_merge(
            // $hokaido_yasumi_value, $aomori_yasumi_value, $iwate_yasumi_value, $akita_yasumi_value, $yamagata_yasumi_value, $miyagi_yasumi_value, $fukushima_yasumi_value, $ibaraki_yasumi_value, $tochigi_yasumi_value,
            // $gunma_yasumi_value, $saitama_yasumi_value, $chiba_yasumi_value, $tokyo_yasumi_value, $kanagawa_yasumi_value, $niigata_yasumi_value, $toyama_yasumi_value, $ishikawa_yasumi_value, $fukui_yasumi_value,
            // $yamanashi_yasumi_value, $nagano_yasumi_value, $gifu_yasumi_value, $shizuoka_yasumi_value, $aichi_yasumi_value, $mie_yasumi_value, $shiga_yasumi_value, $kyoto_yasumi_value, $osaka_yasumi_value, $hyogo_yasumi_value,
            // $nara_yasumi_value, $wakayama_yasumi_value, $totori_yasumi_value, $shimane_yasumi_value, $okayama_yasumi_value, $hiroshima_yasumi_value, $yamaguchi_yasumi_value, $tokushima_yasumi_value, $kagawa_yasumi_value,
            // $ehime_yasumi_value, $kochi_yasumi_value, $fukuoka_yasumi_value, $saga_yasumi_value, $nagasaki_yasumi_value, $kumamoto_yasumi_value, $ooita_yasumi_value, $miyazaki_yasumi_value, $kagoshima_yasumi_value,
            // $okinawa_yasumi_value
        // );

        // それぞれのお風呂：都道府県取得
        $prefecures = array_merge(
            array_fill(0, count($hokaido_name), '北海道'),
            array_fill(0, count($aomori_name), '青森県'),array_fill(0, count($iwate_name), '岩手県'),array_fill(0, count($akita_name), '秋田県')
            ,array_fill(0, count($yamagata_name), '山形県'),array_fill(0, count($miyagi_name), '宮城県'),array_fill(0, count($fukushima_name), '福島県')
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

        // それぞれの都道府県ごとに、お風呂のHPのURL取得
        $hokaido_HP_url_arr = [];
        foreach($hokaido_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokaidotohoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $hokaido_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $hokaido_HP_url_arr[]= [null];
            }
        }
        $merged_hokaido_HP_url_arr = array_merge(
            $hokaido_HP_url_arr[0],$hokaido_HP_url_arr[1],$hokaido_HP_url_arr[2],$hokaido_HP_url_arr[3],$hokaido_HP_url_arr[4],$hokaido_HP_url_arr[5],$hokaido_HP_url_arr[6],$hokaido_HP_url_arr[7],$hokaido_HP_url_arr[8],$hokaido_HP_url_arr[9],$hokaido_HP_url_arr[10],$hokaido_HP_url_arr[11],$hokaido_HP_url_arr[12],$hokaido_HP_url_arr[13],$hokaido_HP_url_arr[14],$hokaido_HP_url_arr[15],$hokaido_HP_url_arr[16],$hokaido_HP_url_arr[17],$hokaido_HP_url_arr[18],$hokaido_HP_url_arr[19],
            $hokaido_HP_url_arr[20],$hokaido_HP_url_arr[21],$hokaido_HP_url_arr[22],$hokaido_HP_url_arr[23],$hokaido_HP_url_arr[24],$hokaido_HP_url_arr[25],$hokaido_HP_url_arr[26],$hokaido_HP_url_arr[27],$hokaido_HP_url_arr[28],$hokaido_HP_url_arr[29],$hokaido_HP_url_arr[30],$hokaido_HP_url_arr[31],$hokaido_HP_url_arr[32],$hokaido_HP_url_arr[33],$hokaido_HP_url_arr[34],$hokaido_HP_url_arr[35],$hokaido_HP_url_arr[36],$hokaido_HP_url_arr[37],$hokaido_HP_url_arr[38],$hokaido_HP_url_arr[39],
            $hokaido_HP_url_arr[40],$hokaido_HP_url_arr[41],$hokaido_HP_url_arr[42],$hokaido_HP_url_arr[43],$hokaido_HP_url_arr[44],$hokaido_HP_url_arr[45],$hokaido_HP_url_arr[46],$hokaido_HP_url_arr[47],$hokaido_HP_url_arr[48],$hokaido_HP_url_arr[49],$hokaido_HP_url_arr[50],$hokaido_HP_url_arr[51],$hokaido_HP_url_arr[52],$hokaido_HP_url_arr[53],$hokaido_HP_url_arr[54],$hokaido_HP_url_arr[55],$hokaido_HP_url_arr[56],$hokaido_HP_url_arr[57],$hokaido_HP_url_arr[58],$hokaido_HP_url_arr[59],
            $hokaido_HP_url_arr[60],$hokaido_HP_url_arr[61],$hokaido_HP_url_arr[62],$hokaido_HP_url_arr[63],$hokaido_HP_url_arr[64],$hokaido_HP_url_arr[65],$hokaido_HP_url_arr[66],$hokaido_HP_url_arr[67],$hokaido_HP_url_arr[68],$hokaido_HP_url_arr[69],$hokaido_HP_url_arr[70],$hokaido_HP_url_arr[71],$hokaido_HP_url_arr[72],$hokaido_HP_url_arr[73],$hokaido_HP_url_arr[74],$hokaido_HP_url_arr[75],$hokaido_HP_url_arr[76],$hokaido_HP_url_arr[77],$hokaido_HP_url_arr[78],$hokaido_HP_url_arr[79],
            $hokaido_HP_url_arr[80],$hokaido_HP_url_arr[81],$hokaido_HP_url_arr[82],$hokaido_HP_url_arr[83],$hokaido_HP_url_arr[84],$hokaido_HP_url_arr[85],$hokaido_HP_url_arr[86],$hokaido_HP_url_arr[87],$hokaido_HP_url_arr[88],$hokaido_HP_url_arr[89],$hokaido_HP_url_arr[90],$hokaido_HP_url_arr[91],$hokaido_HP_url_arr[92],$hokaido_HP_url_arr[93],$hokaido_HP_url_arr[94],$hokaido_HP_url_arr[95],$hokaido_HP_url_arr[96],$hokaido_HP_url_arr[97],$hokaido_HP_url_arr[98],$hokaido_HP_url_arr[99],
            $hokaido_HP_url_arr[100],$hokaido_HP_url_arr[101],$hokaido_HP_url_arr[102],$hokaido_HP_url_arr[103],$hokaido_HP_url_arr[104],$hokaido_HP_url_arr[105],$hokaido_HP_url_arr[106],$hokaido_HP_url_arr[107],$hokaido_HP_url_arr[108],$hokaido_HP_url_arr[109],$hokaido_HP_url_arr[110],$hokaido_HP_url_arr[111],$hokaido_HP_url_arr[112],$hokaido_HP_url_arr[113],$hokaido_HP_url_arr[114],$hokaido_HP_url_arr[115],$hokaido_HP_url_arr[116],$hokaido_HP_url_arr[117],$hokaido_HP_url_arr[118],$hokaido_HP_url_arr[119],
            $hokaido_HP_url_arr[120],$hokaido_HP_url_arr[121],$hokaido_HP_url_arr[122],$hokaido_HP_url_arr[123],$hokaido_HP_url_arr[124],$hokaido_HP_url_arr[125],$hokaido_HP_url_arr[126],$hokaido_HP_url_arr[127],$hokaido_HP_url_arr[128],$hokaido_HP_url_arr[129],$hokaido_HP_url_arr[130],$hokaido_HP_url_arr[131],$hokaido_HP_url_arr[132],$hokaido_HP_url_arr[133],
        );
        $aomori_HP_url_arr = [];
        foreach($aomori_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokaidotohoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $aomori_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $aomori_HP_url_arr[]= [null];
            }
        }
        $merged_aomori_HP_url_arr = array_merge(
            $aomori_HP_url_arr[0],$aomori_HP_url_arr[1],$aomori_HP_url_arr[2],$aomori_HP_url_arr[3],$aomori_HP_url_arr[4],$aomori_HP_url_arr[5],$aomori_HP_url_arr[6],$aomori_HP_url_arr[7],$aomori_HP_url_arr[8],$aomori_HP_url_arr[9],$aomori_HP_url_arr[10],$aomori_HP_url_arr[11],$aomori_HP_url_arr[12],$aomori_HP_url_arr[13],$aomori_HP_url_arr[14],$aomori_HP_url_arr[15],$aomori_HP_url_arr[16],$aomori_HP_url_arr[17],$aomori_HP_url_arr[18],$aomori_HP_url_arr[19],
            $aomori_HP_url_arr[20],$aomori_HP_url_arr[21],$aomori_HP_url_arr[22],$aomori_HP_url_arr[23],$aomori_HP_url_arr[24],$aomori_HP_url_arr[25],$aomori_HP_url_arr[26],$aomori_HP_url_arr[27],$aomori_HP_url_arr[28],$aomori_HP_url_arr[29],$aomori_HP_url_arr[30],$aomori_HP_url_arr[31],$aomori_HP_url_arr[32],$aomori_HP_url_arr[33],$aomori_HP_url_arr[34],$aomori_HP_url_arr[35],$aomori_HP_url_arr[36],$aomori_HP_url_arr[37]
        );
        $iwate_HP_url_arr = [];
        foreach($iwate_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokaidotohoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $iwate_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $iwate_HP_url_arr[]= [null];
            }
        }
        $merged_iwate_HP_url_arr = array_merge(
            $iwate_HP_url_arr[0],$iwate_HP_url_arr[1],$iwate_HP_url_arr[2],$iwate_HP_url_arr[3],$iwate_HP_url_arr[4],$iwate_HP_url_arr[5],$iwate_HP_url_arr[6],$iwate_HP_url_arr[7],$iwate_HP_url_arr[8],$iwate_HP_url_arr[9],$iwate_HP_url_arr[10],$iwate_HP_url_arr[11],$iwate_HP_url_arr[12],$iwate_HP_url_arr[13],$iwate_HP_url_arr[14],$iwate_HP_url_arr[15],$iwate_HP_url_arr[16],$iwate_HP_url_arr[17],$iwate_HP_url_arr[18],$iwate_HP_url_arr[19],
            $iwate_HP_url_arr[20],$iwate_HP_url_arr[21],$iwate_HP_url_arr[22],$iwate_HP_url_arr[23],$iwate_HP_url_arr[24],$iwate_HP_url_arr[25],$iwate_HP_url_arr[26],$iwate_HP_url_arr[27],$iwate_HP_url_arr[28],$iwate_HP_url_arr[29],$iwate_HP_url_arr[30],$iwate_HP_url_arr[31],$iwate_HP_url_arr[32],$iwate_HP_url_arr[33],$iwate_HP_url_arr[34],$iwate_HP_url_arr[35],$iwate_HP_url_arr[36]
        );
        $akita_HP_url_arr = [];
        foreach($akita_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokaidotohoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $akita_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $akita_HP_url_arr[]= [null];
            }
        }
        $merged_akita_HP_url_arr = array_merge(
            $akita_HP_url_arr[0],$akita_HP_url_arr[1],$akita_HP_url_arr[2],$akita_HP_url_arr[3],$akita_HP_url_arr[4],$akita_HP_url_arr[5],$akita_HP_url_arr[6],$akita_HP_url_arr[7],$akita_HP_url_arr[8],$akita_HP_url_arr[9],$akita_HP_url_arr[10],$akita_HP_url_arr[11],$akita_HP_url_arr[12],$akita_HP_url_arr[13],$akita_HP_url_arr[14],$akita_HP_url_arr[15],$akita_HP_url_arr[16],$akita_HP_url_arr[17],$akita_HP_url_arr[18],$akita_HP_url_arr[19],
            $akita_HP_url_arr[20],$akita_HP_url_arr[21],$akita_HP_url_arr[22],$akita_HP_url_arr[23],$akita_HP_url_arr[24],$akita_HP_url_arr[25],$akita_HP_url_arr[26],$akita_HP_url_arr[27]
        );
        $yamagata_HP_url_arr = [];
        foreach($yamagata_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokaidotohoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $yamagata_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $yamagata_HP_url_arr[]= [null];
            }
        }
        $merged_yamagata_HP_url_arr = array_merge(
            $yamagata_HP_url_arr[0],$yamagata_HP_url_arr[1],$yamagata_HP_url_arr[2],$yamagata_HP_url_arr[3],$yamagata_HP_url_arr[4],$yamagata_HP_url_arr[5],$yamagata_HP_url_arr[6],$yamagata_HP_url_arr[7],$yamagata_HP_url_arr[8],$yamagata_HP_url_arr[9],$yamagata_HP_url_arr[10],$yamagata_HP_url_arr[11],$yamagata_HP_url_arr[12],$yamagata_HP_url_arr[13],$yamagata_HP_url_arr[14],$yamagata_HP_url_arr[15],$yamagata_HP_url_arr[16],$yamagata_HP_url_arr[17],$yamagata_HP_url_arr[18],$yamagata_HP_url_arr[19],
            $yamagata_HP_url_arr[20],$yamagata_HP_url_arr[21],$yamagata_HP_url_arr[22],$yamagata_HP_url_arr[23],$yamagata_HP_url_arr[24],$yamagata_HP_url_arr[25],$yamagata_HP_url_arr[26],$yamagata_HP_url_arr[27],$yamagata_HP_url_arr[28],$yamagata_HP_url_arr[29],$yamagata_HP_url_arr[30],$yamagata_HP_url_arr[31],$yamagata_HP_url_arr[32]
        );
        $miyagi_HP_url_arr = [];
        foreach($miyagi_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokaidotohoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $miyagi_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $miyagi_HP_url_arr[]= [null];
            }
        }
        $merged_miyagi_HP_url_arr = array_merge(
            $miyagi_HP_url_arr[0],$miyagi_HP_url_arr[1],$miyagi_HP_url_arr[2],$miyagi_HP_url_arr[3],$miyagi_HP_url_arr[4],$miyagi_HP_url_arr[5],$miyagi_HP_url_arr[6],$miyagi_HP_url_arr[7],$miyagi_HP_url_arr[8],$miyagi_HP_url_arr[9],$miyagi_HP_url_arr[10],$miyagi_HP_url_arr[11],$miyagi_HP_url_arr[12],$miyagi_HP_url_arr[13],$miyagi_HP_url_arr[14],$miyagi_HP_url_arr[15],$miyagi_HP_url_arr[16],$miyagi_HP_url_arr[17],$miyagi_HP_url_arr[18],$miyagi_HP_url_arr[19],
            $miyagi_HP_url_arr[20],$miyagi_HP_url_arr[21],$miyagi_HP_url_arr[22],$miyagi_HP_url_arr[23],$miyagi_HP_url_arr[24],$miyagi_HP_url_arr[25],$miyagi_HP_url_arr[26],$miyagi_HP_url_arr[27],$miyagi_HP_url_arr[28],$miyagi_HP_url_arr[29],$miyagi_HP_url_arr[30],$miyagi_HP_url_arr[31],$miyagi_HP_url_arr[32],$miyagi_HP_url_arr[33],$miyagi_HP_url_arr[34],$miyagi_HP_url_arr[35]
        );
        $fukushima_HP_url_arr = [];
        foreach($fukushima_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokaidotohoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $fukushima_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $fukushima_HP_url_arr[]= [null];
            }
        }
        $merged_fukushima_HP_url_arr = array_merge(
            $fukushima_HP_url_arr[0],$fukushima_HP_url_arr[1],$fukushima_HP_url_arr[2],$fukushima_HP_url_arr[3],$fukushima_HP_url_arr[4],$fukushima_HP_url_arr[5],$fukushima_HP_url_arr[6],$fukushima_HP_url_arr[7],$fukushima_HP_url_arr[8],$fukushima_HP_url_arr[9],$fukushima_HP_url_arr[10],$fukushima_HP_url_arr[11],$fukushima_HP_url_arr[12],$fukushima_HP_url_arr[13],$fukushima_HP_url_arr[14],$fukushima_HP_url_arr[15],$fukushima_HP_url_arr[16],$fukushima_HP_url_arr[17],$fukushima_HP_url_arr[18],$fukushima_HP_url_arr[19],
            $fukushima_HP_url_arr[20],$fukushima_HP_url_arr[21],$fukushima_HP_url_arr[22],$fukushima_HP_url_arr[23],$fukushima_HP_url_arr[24],$fukushima_HP_url_arr[25],$fukushima_HP_url_arr[26],$fukushima_HP_url_arr[27],$fukushima_HP_url_arr[28],$fukushima_HP_url_arr[29],$fukushima_HP_url_arr[30],$fukushima_HP_url_arr[31],$fukushima_HP_url_arr[32]
        );
        $ibaraki_HP_url_arr = [];
        foreach($ibaraki_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kanto/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $ibaraki_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $ibaraki_HP_url_arr[]= [null];
            }
        }
        $merged_ibaraki_HP_url_arr = array_merge(
            $ibaraki_HP_url_arr[0],$ibaraki_HP_url_arr[1],$ibaraki_HP_url_arr[2],$ibaraki_HP_url_arr[3],$ibaraki_HP_url_arr[4],$ibaraki_HP_url_arr[5],$ibaraki_HP_url_arr[6],$ibaraki_HP_url_arr[7],$ibaraki_HP_url_arr[8],$ibaraki_HP_url_arr[9],$ibaraki_HP_url_arr[10],$ibaraki_HP_url_arr[11],$ibaraki_HP_url_arr[12],$ibaraki_HP_url_arr[13],$ibaraki_HP_url_arr[14],$ibaraki_HP_url_arr[15],$ibaraki_HP_url_arr[16],$ibaraki_HP_url_arr[17],$ibaraki_HP_url_arr[18],$ibaraki_HP_url_arr[19],
            $ibaraki_HP_url_arr[20],$ibaraki_HP_url_arr[21],$ibaraki_HP_url_arr[22],$ibaraki_HP_url_arr[23],$ibaraki_HP_url_arr[24],$ibaraki_HP_url_arr[25],$ibaraki_HP_url_arr[26],$ibaraki_HP_url_arr[27],$ibaraki_HP_url_arr[28],$ibaraki_HP_url_arr[29],$ibaraki_HP_url_arr[30],$ibaraki_HP_url_arr[31],$ibaraki_HP_url_arr[32],$ibaraki_HP_url_arr[33],$ibaraki_HP_url_arr[34],$ibaraki_HP_url_arr[35],$ibaraki_HP_url_arr[36],$ibaraki_HP_url_arr[37],$ibaraki_HP_url_arr[38],$ibaraki_HP_url_arr[39],
            $ibaraki_HP_url_arr[40],$ibaraki_HP_url_arr[41],$ibaraki_HP_url_arr[42],$ibaraki_HP_url_arr[43],$ibaraki_HP_url_arr[44],$ibaraki_HP_url_arr[45],$ibaraki_HP_url_arr[46],
        );
        $tochigi_HP_url_arr = [];
        foreach($tochigi_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kanto/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $tochigi_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $tochigi_HP_url_arr[]= [null];
            }
        }
        $merged_tochigi_HP_url_arr = array_merge(
            $tochigi_HP_url_arr[0],$tochigi_HP_url_arr[1],$tochigi_HP_url_arr[2],$tochigi_HP_url_arr[3],$tochigi_HP_url_arr[4],$tochigi_HP_url_arr[5],$tochigi_HP_url_arr[6],$tochigi_HP_url_arr[7],$tochigi_HP_url_arr[8],$tochigi_HP_url_arr[9],$tochigi_HP_url_arr[10],$tochigi_HP_url_arr[11],$tochigi_HP_url_arr[12],$tochigi_HP_url_arr[13],$tochigi_HP_url_arr[14],$tochigi_HP_url_arr[15],$tochigi_HP_url_arr[16],$tochigi_HP_url_arr[17],$tochigi_HP_url_arr[18],$tochigi_HP_url_arr[19],
            $tochigi_HP_url_arr[20],$tochigi_HP_url_arr[21],$tochigi_HP_url_arr[22],$tochigi_HP_url_arr[23],$tochigi_HP_url_arr[24],$tochigi_HP_url_arr[25],$tochigi_HP_url_arr[26],$tochigi_HP_url_arr[27],$tochigi_HP_url_arr[28],$tochigi_HP_url_arr[29],$tochigi_HP_url_arr[30],$tochigi_HP_url_arr[31],$tochigi_HP_url_arr[32],$tochigi_HP_url_arr[33],$tochigi_HP_url_arr[34],$tochigi_HP_url_arr[35],$tochigi_HP_url_arr[36],$tochigi_HP_url_arr[37],$tochigi_HP_url_arr[38],$tochigi_HP_url_arr[39],
            $tochigi_HP_url_arr[40],$tochigi_HP_url_arr[41],$tochigi_HP_url_arr[42],$tochigi_HP_url_arr[43],$tochigi_HP_url_arr[44],$tochigi_HP_url_arr[45],$tochigi_HP_url_arr[46]
        );
        $gunma_HP_url_arr = [];
        foreach($gunma_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kanto/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $gunma_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $gunma_HP_url_arr[]= [null];
            }
        }
        $merged_gunma_HP_url_arr = array_merge(
            $gunma_HP_url_arr[0],$gunma_HP_url_arr[1],$gunma_HP_url_arr[2],$gunma_HP_url_arr[3],$gunma_HP_url_arr[4],$gunma_HP_url_arr[5],$gunma_HP_url_arr[6],$gunma_HP_url_arr[7],$gunma_HP_url_arr[8],$gunma_HP_url_arr[9],$gunma_HP_url_arr[10],$gunma_HP_url_arr[11],$gunma_HP_url_arr[12],$gunma_HP_url_arr[13],$gunma_HP_url_arr[14],$gunma_HP_url_arr[15],$gunma_HP_url_arr[16],$gunma_HP_url_arr[17],$gunma_HP_url_arr[18],$gunma_HP_url_arr[19],
            $gunma_HP_url_arr[20],$gunma_HP_url_arr[21],$gunma_HP_url_arr[22],$gunma_HP_url_arr[23],$gunma_HP_url_arr[24],$gunma_HP_url_arr[25],$gunma_HP_url_arr[26],$gunma_HP_url_arr[27],$gunma_HP_url_arr[28],$gunma_HP_url_arr[29],$gunma_HP_url_arr[30],$gunma_HP_url_arr[31],$gunma_HP_url_arr[32],$gunma_HP_url_arr[33],$gunma_HP_url_arr[34],$gunma_HP_url_arr[35],$gunma_HP_url_arr[36],$gunma_HP_url_arr[37],$gunma_HP_url_arr[38],$gunma_HP_url_arr[39],
            $gunma_HP_url_arr[40],$gunma_HP_url_arr[41],$gunma_HP_url_arr[42],$gunma_HP_url_arr[43],$gunma_HP_url_arr[44],$gunma_HP_url_arr[45],$gunma_HP_url_arr[46],$gunma_HP_url_arr[47],$gunma_HP_url_arr[48],$gunma_HP_url_arr[49],$gunma_HP_url_arr[50],$gunma_HP_url_arr[51]
        );
        $saitama_HP_url_arr = [];
        foreach($saitama_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kanto/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $saitama_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $saitama_HP_url_arr[]= [null];
            }
        }
        $merged_saitama_HP_url_arr = array_merge(
            $saitama_HP_url_arr[0],$saitama_HP_url_arr[1],$saitama_HP_url_arr[2],$saitama_HP_url_arr[3],$saitama_HP_url_arr[4],$saitama_HP_url_arr[5],$saitama_HP_url_arr[6],$saitama_HP_url_arr[7],$saitama_HP_url_arr[8],$saitama_HP_url_arr[9],$saitama_HP_url_arr[10],$saitama_HP_url_arr[11],$saitama_HP_url_arr[12],$saitama_HP_url_arr[13],$saitama_HP_url_arr[14],$saitama_HP_url_arr[15],$saitama_HP_url_arr[16],$saitama_HP_url_arr[17],$saitama_HP_url_arr[18],$saitama_HP_url_arr[19],
            $saitama_HP_url_arr[20],$saitama_HP_url_arr[21],$saitama_HP_url_arr[22],$saitama_HP_url_arr[23],$saitama_HP_url_arr[24],$saitama_HP_url_arr[25],$saitama_HP_url_arr[26],$saitama_HP_url_arr[27],$saitama_HP_url_arr[28],$saitama_HP_url_arr[29],$saitama_HP_url_arr[30],$saitama_HP_url_arr[31],$saitama_HP_url_arr[32],$saitama_HP_url_arr[33],$saitama_HP_url_arr[34],$saitama_HP_url_arr[35],$saitama_HP_url_arr[36],$saitama_HP_url_arr[37],$saitama_HP_url_arr[38],$saitama_HP_url_arr[39],
            $saitama_HP_url_arr[40],$saitama_HP_url_arr[41],$saitama_HP_url_arr[42],$saitama_HP_url_arr[43],$saitama_HP_url_arr[44],$saitama_HP_url_arr[45],$saitama_HP_url_arr[46],$saitama_HP_url_arr[47],$saitama_HP_url_arr[48],$saitama_HP_url_arr[49],$saitama_HP_url_arr[50],$saitama_HP_url_arr[51],$saitama_HP_url_arr[52],$saitama_HP_url_arr[53],$saitama_HP_url_arr[54],$saitama_HP_url_arr[55],$saitama_HP_url_arr[56],$saitama_HP_url_arr[57],$saitama_HP_url_arr[58],$saitama_HP_url_arr[59],
            $saitama_HP_url_arr[60],$saitama_HP_url_arr[61],$saitama_HP_url_arr[62],$saitama_HP_url_arr[63],$saitama_HP_url_arr[64],$saitama_HP_url_arr[65],$saitama_HP_url_arr[66],$saitama_HP_url_arr[67],$saitama_HP_url_arr[68],$saitama_HP_url_arr[69],$saitama_HP_url_arr[70],$saitama_HP_url_arr[71],$saitama_HP_url_arr[72],$saitama_HP_url_arr[73],$saitama_HP_url_arr[74],$saitama_HP_url_arr[75],$saitama_HP_url_arr[76],$saitama_HP_url_arr[77],$saitama_HP_url_arr[78]
        );
        $chiba_HP_url_arr = [];
        foreach($chiba_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kanto/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $chiba_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $chiba_HP_url_arr[]= [null];
            }
        }
        $merged_chiba_HP_url_arr = array_merge(
            $chiba_HP_url_arr[0],$chiba_HP_url_arr[1],$chiba_HP_url_arr[2],$chiba_HP_url_arr[3],$chiba_HP_url_arr[4],$chiba_HP_url_arr[5],$chiba_HP_url_arr[6],$chiba_HP_url_arr[7],$chiba_HP_url_arr[8],$chiba_HP_url_arr[9],$chiba_HP_url_arr[10],$chiba_HP_url_arr[11],$chiba_HP_url_arr[12],$chiba_HP_url_arr[13],$chiba_HP_url_arr[14],$chiba_HP_url_arr[15],$chiba_HP_url_arr[16],$chiba_HP_url_arr[17],$chiba_HP_url_arr[18],$chiba_HP_url_arr[19],
            $chiba_HP_url_arr[20],$chiba_HP_url_arr[21],$chiba_HP_url_arr[22],$chiba_HP_url_arr[23],$chiba_HP_url_arr[24],$chiba_HP_url_arr[25],$chiba_HP_url_arr[26],$chiba_HP_url_arr[27],$chiba_HP_url_arr[28],$chiba_HP_url_arr[29],$chiba_HP_url_arr[30],$chiba_HP_url_arr[31],$chiba_HP_url_arr[32],$chiba_HP_url_arr[33],$chiba_HP_url_arr[34],$chiba_HP_url_arr[35],$chiba_HP_url_arr[36],$chiba_HP_url_arr[37],$chiba_HP_url_arr[38],$chiba_HP_url_arr[39],
            $chiba_HP_url_arr[40],$chiba_HP_url_arr[41],$chiba_HP_url_arr[42],$chiba_HP_url_arr[43],$chiba_HP_url_arr[44],$chiba_HP_url_arr[45],$chiba_HP_url_arr[46],$chiba_HP_url_arr[47],$chiba_HP_url_arr[48],$chiba_HP_url_arr[49],$chiba_HP_url_arr[50],$chiba_HP_url_arr[51],$chiba_HP_url_arr[52],$chiba_HP_url_arr[53],$chiba_HP_url_arr[54],$chiba_HP_url_arr[55],$chiba_HP_url_arr[56],$chiba_HP_url_arr[57],$chiba_HP_url_arr[58],$chiba_HP_url_arr[59],
            $chiba_HP_url_arr[60],$chiba_HP_url_arr[61],$chiba_HP_url_arr[62],$chiba_HP_url_arr[63],$chiba_HP_url_arr[64],$chiba_HP_url_arr[65],$chiba_HP_url_arr[66],$chiba_HP_url_arr[67],$chiba_HP_url_arr[68],$chiba_HP_url_arr[69],$chiba_HP_url_arr[70],$chiba_HP_url_arr[71]
        );
        $tokyo_HP_url_arr = [];
        foreach($tokyo_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kanto/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $tokyo_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $tokyo_HP_url_arr[]= [null];
            }
        }
        $merged_tokyo_HP_url_arr = array_merge(
            $tokyo_HP_url_arr[0],$tokyo_HP_url_arr[1],$tokyo_HP_url_arr[2],$tokyo_HP_url_arr[3],$tokyo_HP_url_arr[4],$tokyo_HP_url_arr[5],$tokyo_HP_url_arr[6],$tokyo_HP_url_arr[7],$tokyo_HP_url_arr[8],$tokyo_HP_url_arr[9],$tokyo_HP_url_arr[10],$tokyo_HP_url_arr[11],$tokyo_HP_url_arr[12],$tokyo_HP_url_arr[13],$tokyo_HP_url_arr[14],$tokyo_HP_url_arr[15],$tokyo_HP_url_arr[16],$tokyo_HP_url_arr[17],$tokyo_HP_url_arr[18],$tokyo_HP_url_arr[19],
            $tokyo_HP_url_arr[20],$tokyo_HP_url_arr[21],$tokyo_HP_url_arr[22],$tokyo_HP_url_arr[23],$tokyo_HP_url_arr[24],$tokyo_HP_url_arr[25],$tokyo_HP_url_arr[26],$tokyo_HP_url_arr[27],$tokyo_HP_url_arr[28],$tokyo_HP_url_arr[29],$tokyo_HP_url_arr[30],$tokyo_HP_url_arr[31],$tokyo_HP_url_arr[32],$tokyo_HP_url_arr[33],$tokyo_HP_url_arr[34],$tokyo_HP_url_arr[35],$tokyo_HP_url_arr[36],$tokyo_HP_url_arr[37],$tokyo_HP_url_arr[38],$tokyo_HP_url_arr[39],
            $tokyo_HP_url_arr[40],$tokyo_HP_url_arr[41],$tokyo_HP_url_arr[42],$tokyo_HP_url_arr[43],$tokyo_HP_url_arr[44],$tokyo_HP_url_arr[45],$tokyo_HP_url_arr[46],$tokyo_HP_url_arr[47],$tokyo_HP_url_arr[48],$tokyo_HP_url_arr[49],$tokyo_HP_url_arr[50],$tokyo_HP_url_arr[51],$tokyo_HP_url_arr[52],$tokyo_HP_url_arr[53],$tokyo_HP_url_arr[54],$tokyo_HP_url_arr[55],$tokyo_HP_url_arr[56],$tokyo_HP_url_arr[57],$tokyo_HP_url_arr[58],$tokyo_HP_url_arr[59],
            $tokyo_HP_url_arr[60],$tokyo_HP_url_arr[61],$tokyo_HP_url_arr[62],$tokyo_HP_url_arr[63],$tokyo_HP_url_arr[64],$tokyo_HP_url_arr[65],$tokyo_HP_url_arr[66],$tokyo_HP_url_arr[67],$tokyo_HP_url_arr[68],$tokyo_HP_url_arr[69],$tokyo_HP_url_arr[70],$tokyo_HP_url_arr[71],$tokyo_HP_url_arr[72],$tokyo_HP_url_arr[73],$tokyo_HP_url_arr[74],$tokyo_HP_url_arr[75],$tokyo_HP_url_arr[76],$tokyo_HP_url_arr[77],$tokyo_HP_url_arr[78],$tokyo_HP_url_arr[79],
            $tokyo_HP_url_arr[80],$tokyo_HP_url_arr[81],$tokyo_HP_url_arr[82],$tokyo_HP_url_arr[83],$tokyo_HP_url_arr[84],$tokyo_HP_url_arr[85],$tokyo_HP_url_arr[86],$tokyo_HP_url_arr[87],$tokyo_HP_url_arr[88],$tokyo_HP_url_arr[89],$tokyo_HP_url_arr[90],$tokyo_HP_url_arr[91],$tokyo_HP_url_arr[92],$tokyo_HP_url_arr[93],$tokyo_HP_url_arr[94],$tokyo_HP_url_arr[95],$tokyo_HP_url_arr[96],$tokyo_HP_url_arr[97],$tokyo_HP_url_arr[98],$tokyo_HP_url_arr[99],
            $tokyo_HP_url_arr[100],$tokyo_HP_url_arr[101],$tokyo_HP_url_arr[102],$tokyo_HP_url_arr[103],$tokyo_HP_url_arr[104],$tokyo_HP_url_arr[105],$tokyo_HP_url_arr[106],$tokyo_HP_url_arr[107],$tokyo_HP_url_arr[108],$tokyo_HP_url_arr[109]
        );
        $kanagawa_HP_url_arr = [];
        foreach($kanagawa_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kanto/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $kanagawa_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $kanagawa_HP_url_arr[]= [null];
            }
        }
        $merged_kanagawa_HP_url_arr = array_merge(
            $kanagawa_HP_url_arr[0],$kanagawa_HP_url_arr[1],$kanagawa_HP_url_arr[2],$kanagawa_HP_url_arr[3],$kanagawa_HP_url_arr[4],$kanagawa_HP_url_arr[5],$kanagawa_HP_url_arr[6],$kanagawa_HP_url_arr[7],$kanagawa_HP_url_arr[8],$kanagawa_HP_url_arr[9],$kanagawa_HP_url_arr[10],$kanagawa_HP_url_arr[11],$kanagawa_HP_url_arr[12],$kanagawa_HP_url_arr[13],$kanagawa_HP_url_arr[14],$kanagawa_HP_url_arr[15],$kanagawa_HP_url_arr[16],$kanagawa_HP_url_arr[17],$kanagawa_HP_url_arr[18],$kanagawa_HP_url_arr[19],
            $kanagawa_HP_url_arr[20],$kanagawa_HP_url_arr[21],$kanagawa_HP_url_arr[22],$kanagawa_HP_url_arr[23],$kanagawa_HP_url_arr[24],$kanagawa_HP_url_arr[25],$kanagawa_HP_url_arr[26],$kanagawa_HP_url_arr[27],$kanagawa_HP_url_arr[28],$kanagawa_HP_url_arr[29],$kanagawa_HP_url_arr[30],$kanagawa_HP_url_arr[31],$kanagawa_HP_url_arr[32],$kanagawa_HP_url_arr[33],$kanagawa_HP_url_arr[34],$kanagawa_HP_url_arr[35],$kanagawa_HP_url_arr[36],$kanagawa_HP_url_arr[37],$kanagawa_HP_url_arr[38],$kanagawa_HP_url_arr[39],
            $kanagawa_HP_url_arr[40],$kanagawa_HP_url_arr[41],$kanagawa_HP_url_arr[42],$kanagawa_HP_url_arr[43],$kanagawa_HP_url_arr[44],$kanagawa_HP_url_arr[45],$kanagawa_HP_url_arr[46],$kanagawa_HP_url_arr[47],$kanagawa_HP_url_arr[48],$kanagawa_HP_url_arr[49],$kanagawa_HP_url_arr[50],$kanagawa_HP_url_arr[51],$kanagawa_HP_url_arr[52],$kanagawa_HP_url_arr[53],$kanagawa_HP_url_arr[54],$kanagawa_HP_url_arr[55],$kanagawa_HP_url_arr[56],$kanagawa_HP_url_arr[57],$kanagawa_HP_url_arr[58],$kanagawa_HP_url_arr[59],
            $kanagawa_HP_url_arr[60],$kanagawa_HP_url_arr[61],$kanagawa_HP_url_arr[62],$kanagawa_HP_url_arr[63],$kanagawa_HP_url_arr[64],$kanagawa_HP_url_arr[65],$kanagawa_HP_url_arr[66],$kanagawa_HP_url_arr[67],$kanagawa_HP_url_arr[68],$kanagawa_HP_url_arr[69],$kanagawa_HP_url_arr[70],$kanagawa_HP_url_arr[71],$kanagawa_HP_url_arr[72],$kanagawa_HP_url_arr[73],$kanagawa_HP_url_arr[74],$kanagawa_HP_url_arr[75],$kanagawa_HP_url_arr[76],$kanagawa_HP_url_arr[77],$kanagawa_HP_url_arr[78],$kanagawa_HP_url_arr[79]
        );
        $niigata_HP_url_arr = [];
        foreach($niigata_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokuriku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $niigata_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $niigata_HP_url_arr[]= [null];
            }
        }
        $merged_niigata_HP_url_arr = array_merge(
            $niigata_HP_url_arr[0],$niigata_HP_url_arr[1],$niigata_HP_url_arr[2],$niigata_HP_url_arr[3],$niigata_HP_url_arr[4],$niigata_HP_url_arr[5],$niigata_HP_url_arr[6],$niigata_HP_url_arr[7],$niigata_HP_url_arr[8],$niigata_HP_url_arr[9],$niigata_HP_url_arr[10],$niigata_HP_url_arr[11],$niigata_HP_url_arr[12],$niigata_HP_url_arr[13],$niigata_HP_url_arr[14],$niigata_HP_url_arr[15],$niigata_HP_url_arr[16],$niigata_HP_url_arr[17],$niigata_HP_url_arr[18],$niigata_HP_url_arr[19],
            $niigata_HP_url_arr[20],$niigata_HP_url_arr[21],$niigata_HP_url_arr[22],$niigata_HP_url_arr[23],$niigata_HP_url_arr[24],$niigata_HP_url_arr[25],$niigata_HP_url_arr[26],$niigata_HP_url_arr[27],$niigata_HP_url_arr[28],$niigata_HP_url_arr[29],$niigata_HP_url_arr[30],$niigata_HP_url_arr[31],$niigata_HP_url_arr[32],$niigata_HP_url_arr[33],$niigata_HP_url_arr[34],$niigata_HP_url_arr[35],$niigata_HP_url_arr[36],$niigata_HP_url_arr[37],$niigata_HP_url_arr[38],$niigata_HP_url_arr[39],
            $niigata_HP_url_arr[40],$niigata_HP_url_arr[41],$niigata_HP_url_arr[42],$niigata_HP_url_arr[43],$niigata_HP_url_arr[44],$niigata_HP_url_arr[45],$niigata_HP_url_arr[46],$niigata_HP_url_arr[47],$niigata_HP_url_arr[48],$niigata_HP_url_arr[49],$niigata_HP_url_arr[50],$niigata_HP_url_arr[51],$niigata_HP_url_arr[52],$niigata_HP_url_arr[53],$niigata_HP_url_arr[54],$niigata_HP_url_arr[55],$niigata_HP_url_arr[56],$niigata_HP_url_arr[57]
        );
        $toyama_HP_url_arr = [];
        foreach($toyama_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokuriku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $toyama_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $toyama_HP_url_arr[]= [null];
            }
        }
        $merged_toyama_HP_url_arr = array_merge(
            $toyama_HP_url_arr[0],$toyama_HP_url_arr[1],$toyama_HP_url_arr[2],$toyama_HP_url_arr[3],$toyama_HP_url_arr[4],$toyama_HP_url_arr[5],$toyama_HP_url_arr[6],$toyama_HP_url_arr[7],$toyama_HP_url_arr[8],$toyama_HP_url_arr[9],$toyama_HP_url_arr[10],$toyama_HP_url_arr[11],$toyama_HP_url_arr[12],$toyama_HP_url_arr[13],$toyama_HP_url_arr[14],$toyama_HP_url_arr[15],$toyama_HP_url_arr[16],$toyama_HP_url_arr[17],$toyama_HP_url_arr[18],$toyama_HP_url_arr[19],
            $toyama_HP_url_arr[20],$toyama_HP_url_arr[21],$toyama_HP_url_arr[22],$toyama_HP_url_arr[23],$toyama_HP_url_arr[24],$toyama_HP_url_arr[25],$toyama_HP_url_arr[26],$toyama_HP_url_arr[27],$toyama_HP_url_arr[28],$toyama_HP_url_arr[29],$toyama_HP_url_arr[30],$toyama_HP_url_arr[31],$toyama_HP_url_arr[32],$toyama_HP_url_arr[33],$toyama_HP_url_arr[34]
        );
        $ishikawa_HP_url_arr = [];
        foreach($ishikawa_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokuriku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $ishikawa_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $ishikawa_HP_url_arr[]= [null];
            }
        }
        $merged_ishikawa_HP_url_arr = array_merge(
            $ishikawa_HP_url_arr[0],$ishikawa_HP_url_arr[1],$ishikawa_HP_url_arr[2],$ishikawa_HP_url_arr[3],$ishikawa_HP_url_arr[4],$ishikawa_HP_url_arr[5],$ishikawa_HP_url_arr[6],$ishikawa_HP_url_arr[7],$ishikawa_HP_url_arr[8],$ishikawa_HP_url_arr[9],$ishikawa_HP_url_arr[10],$ishikawa_HP_url_arr[11],$ishikawa_HP_url_arr[12],$ishikawa_HP_url_arr[13],$ishikawa_HP_url_arr[14],$ishikawa_HP_url_arr[15],$ishikawa_HP_url_arr[16],$ishikawa_HP_url_arr[17],$ishikawa_HP_url_arr[18],$ishikawa_HP_url_arr[19],
            $ishikawa_HP_url_arr[20],$ishikawa_HP_url_arr[21],$ishikawa_HP_url_arr[22],$ishikawa_HP_url_arr[23],$ishikawa_HP_url_arr[24],$ishikawa_HP_url_arr[25],$ishikawa_HP_url_arr[26],$ishikawa_HP_url_arr[27],$ishikawa_HP_url_arr[28],$ishikawa_HP_url_arr[29],$ishikawa_HP_url_arr[30],$ishikawa_HP_url_arr[31],$ishikawa_HP_url_arr[32],$ishikawa_HP_url_arr[33]
        );
        $fukui_HP_url_arr = [];
        foreach($fukui_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokuriku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $fukui_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $fukui_HP_url_arr[]= [null];
            }
        }
        $merged_fukui_HP_url_arr = array_merge(
            $fukui_HP_url_arr[0],$fukui_HP_url_arr[1],$fukui_HP_url_arr[2],$fukui_HP_url_arr[3],$fukui_HP_url_arr[4],$fukui_HP_url_arr[5],$fukui_HP_url_arr[6],$fukui_HP_url_arr[7],$fukui_HP_url_arr[8],$fukui_HP_url_arr[9],$fukui_HP_url_arr[10],$fukui_HP_url_arr[11],$fukui_HP_url_arr[12],$fukui_HP_url_arr[13],$fukui_HP_url_arr[14],$fukui_HP_url_arr[15],$fukui_HP_url_arr[16],$fukui_HP_url_arr[17],$fukui_HP_url_arr[18],$fukui_HP_url_arr[19],
            $fukui_HP_url_arr[20],$fukui_HP_url_arr[21],$fukui_HP_url_arr[22],$fukui_HP_url_arr[23],$fukui_HP_url_arr[24],$fukui_HP_url_arr[25],$fukui_HP_url_arr[26],$fukui_HP_url_arr[27]
        );
        $yamanashi_HP_url_arr = [];
        foreach($yamanashi_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kanto/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $yamanashi_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $yamanashi_HP_url_arr[]= [null];
            }
        }
        $merged_yamanashi_HP_url_arr = array_merge(
            $yamanashi_HP_url_arr[0],$yamanashi_HP_url_arr[1],$yamanashi_HP_url_arr[2],$yamanashi_HP_url_arr[3],$yamanashi_HP_url_arr[4],$yamanashi_HP_url_arr[5],$yamanashi_HP_url_arr[6],$yamanashi_HP_url_arr[7],$yamanashi_HP_url_arr[8],$yamanashi_HP_url_arr[9],$yamanashi_HP_url_arr[10],$yamanashi_HP_url_arr[11],$yamanashi_HP_url_arr[12],$yamanashi_HP_url_arr[13],$yamanashi_HP_url_arr[14],$yamanashi_HP_url_arr[15],$yamanashi_HP_url_arr[16],$yamanashi_HP_url_arr[17],$yamanashi_HP_url_arr[18],$yamanashi_HP_url_arr[19],
            $yamanashi_HP_url_arr[20],$yamanashi_HP_url_arr[21],$yamanashi_HP_url_arr[22],$yamanashi_HP_url_arr[23],$yamanashi_HP_url_arr[24],$yamanashi_HP_url_arr[25],$yamanashi_HP_url_arr[26],$yamanashi_HP_url_arr[27],$yamanashi_HP_url_arr[28],$yamanashi_HP_url_arr[29],$yamanashi_HP_url_arr[30],$yamanashi_HP_url_arr[31],$yamanashi_HP_url_arr[32],$yamanashi_HP_url_arr[33],$yamanashi_HP_url_arr[34],$yamanashi_HP_url_arr[35],$yamanashi_HP_url_arr[36],$yamanashi_HP_url_arr[37],$yamanashi_HP_url_arr[38],$yamanashi_HP_url_arr[39],
            $yamanashi_HP_url_arr[40],$yamanashi_HP_url_arr[41],$yamanashi_HP_url_arr[42],$yamanashi_HP_url_arr[43],$yamanashi_HP_url_arr[44],$yamanashi_HP_url_arr[45],$yamanashi_HP_url_arr[46],$yamanashi_HP_url_arr[47],$yamanashi_HP_url_arr[48],$yamanashi_HP_url_arr[49],$yamanashi_HP_url_arr[50],$yamanashi_HP_url_arr[51],$yamanashi_HP_url_arr[52],$yamanashi_HP_url_arr[53],$yamanashi_HP_url_arr[54],$yamanashi_HP_url_arr[55],$yamanashi_HP_url_arr[56],$yamanashi_HP_url_arr[57],$yamanashi_HP_url_arr[58],$yamanashi_HP_url_arr[59],
            $yamanashi_HP_url_arr[60],$yamanashi_HP_url_arr[61]
        );
        $nagano_HP_url_arr = [];
        foreach($nagano_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/hokuriku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $nagano_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $nagano_HP_url_arr[]= [null];
            }
        }
        $merged_nagano_HP_url_arr = array_merge(
            $nagano_HP_url_arr[0],$nagano_HP_url_arr[1],$nagano_HP_url_arr[2],$nagano_HP_url_arr[3],$nagano_HP_url_arr[4],$nagano_HP_url_arr[5],$nagano_HP_url_arr[6],$nagano_HP_url_arr[7],$nagano_HP_url_arr[8],$nagano_HP_url_arr[9],$nagano_HP_url_arr[10],$nagano_HP_url_arr[11],$nagano_HP_url_arr[12],$nagano_HP_url_arr[13],$nagano_HP_url_arr[14],$nagano_HP_url_arr[15],$nagano_HP_url_arr[16],$nagano_HP_url_arr[17],$nagano_HP_url_arr[18],$nagano_HP_url_arr[19],
            $nagano_HP_url_arr[20],$nagano_HP_url_arr[21],$nagano_HP_url_arr[22],$nagano_HP_url_arr[23],$nagano_HP_url_arr[24],$nagano_HP_url_arr[25],$nagano_HP_url_arr[26],$nagano_HP_url_arr[27],$nagano_HP_url_arr[28],$nagano_HP_url_arr[29],$nagano_HP_url_arr[30],$nagano_HP_url_arr[31],$nagano_HP_url_arr[32],$nagano_HP_url_arr[33],$nagano_HP_url_arr[34],$nagano_HP_url_arr[35],$nagano_HP_url_arr[36],$nagano_HP_url_arr[37],$nagano_HP_url_arr[38],$nagano_HP_url_arr[39],
            $nagano_HP_url_arr[40],$nagano_HP_url_arr[41],$nagano_HP_url_arr[42],$nagano_HP_url_arr[43],$nagano_HP_url_arr[44],$nagano_HP_url_arr[45],$nagano_HP_url_arr[46],$nagano_HP_url_arr[47],$nagano_HP_url_arr[48],$nagano_HP_url_arr[49],$nagano_HP_url_arr[50],$nagano_HP_url_arr[51],$nagano_HP_url_arr[52],$nagano_HP_url_arr[53],$nagano_HP_url_arr[54],$nagano_HP_url_arr[55],$nagano_HP_url_arr[56],$nagano_HP_url_arr[57],$nagano_HP_url_arr[58],$nagano_HP_url_arr[59],
            $nagano_HP_url_arr[60],$nagano_HP_url_arr[61],$nagano_HP_url_arr[62],$nagano_HP_url_arr[63],$nagano_HP_url_arr[64],$nagano_HP_url_arr[65],$nagano_HP_url_arr[66],$nagano_HP_url_arr[67],$nagano_HP_url_arr[68],$nagano_HP_url_arr[69],$nagano_HP_url_arr[70],$nagano_HP_url_arr[71],$nagano_HP_url_arr[72],$nagano_HP_url_arr[73],$nagano_HP_url_arr[74],$nagano_HP_url_arr[75],$nagano_HP_url_arr[76],$nagano_HP_url_arr[77],$nagano_HP_url_arr[78],$nagano_HP_url_arr[79],
            $nagano_HP_url_arr[80],$nagano_HP_url_arr[81],$nagano_HP_url_arr[82]
        );
        $gifu_HP_url_arr = [];
        foreach($gifu_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/chubu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $gifu_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $gifu_HP_url_arr[]= [null];
            }
        }
        $merged_gifu_HP_url_arr = array_merge(
            $gifu_HP_url_arr[0],$gifu_HP_url_arr[1],$gifu_HP_url_arr[2],$gifu_HP_url_arr[3],$gifu_HP_url_arr[4],$gifu_HP_url_arr[5],$gifu_HP_url_arr[6],$gifu_HP_url_arr[7],$gifu_HP_url_arr[8],$gifu_HP_url_arr[9],$gifu_HP_url_arr[10],$gifu_HP_url_arr[11],$gifu_HP_url_arr[12],$gifu_HP_url_arr[13],$gifu_HP_url_arr[14],$gifu_HP_url_arr[15],$gifu_HP_url_arr[16],$gifu_HP_url_arr[17],$gifu_HP_url_arr[18],$gifu_HP_url_arr[19],
            $gifu_HP_url_arr[20],$gifu_HP_url_arr[21],$gifu_HP_url_arr[22],$gifu_HP_url_arr[23],$gifu_HP_url_arr[24],$gifu_HP_url_arr[25],$gifu_HP_url_arr[26],$gifu_HP_url_arr[27],$gifu_HP_url_arr[28],$gifu_HP_url_arr[29],$gifu_HP_url_arr[30],$gifu_HP_url_arr[31],$gifu_HP_url_arr[32],$gifu_HP_url_arr[33],$gifu_HP_url_arr[34],$gifu_HP_url_arr[35],$gifu_HP_url_arr[36],$gifu_HP_url_arr[37],$gifu_HP_url_arr[38],$gifu_HP_url_arr[39],
            $gifu_HP_url_arr[40],$gifu_HP_url_arr[41],$gifu_HP_url_arr[42],$gifu_HP_url_arr[43],$gifu_HP_url_arr[44],$gifu_HP_url_arr[45],$gifu_HP_url_arr[46],$gifu_HP_url_arr[47],$gifu_HP_url_arr[48],$gifu_HP_url_arr[49],$gifu_HP_url_arr[50],$gifu_HP_url_arr[51],$gifu_HP_url_arr[52],$gifu_HP_url_arr[53],$gifu_HP_url_arr[54],$gifu_HP_url_arr[55],$gifu_HP_url_arr[56],$gifu_HP_url_arr[57]
        );
        $shizuoka_HP_url_arr = [];
        foreach($shizuoka_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/chubu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $shizuoka_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $shizuoka_HP_url_arr[]= [null];
            }
        }
        $merged_shizuoka_HP_url_arr = array_merge(
            $shizuoka_HP_url_arr[0],$shizuoka_HP_url_arr[1],$shizuoka_HP_url_arr[2],$shizuoka_HP_url_arr[3],$shizuoka_HP_url_arr[4],$shizuoka_HP_url_arr[5],$shizuoka_HP_url_arr[6],$shizuoka_HP_url_arr[7],$shizuoka_HP_url_arr[8],$shizuoka_HP_url_arr[9],$shizuoka_HP_url_arr[10],$shizuoka_HP_url_arr[11],$shizuoka_HP_url_arr[12],$shizuoka_HP_url_arr[13],$shizuoka_HP_url_arr[14],$shizuoka_HP_url_arr[15],$shizuoka_HP_url_arr[16],$shizuoka_HP_url_arr[17],$shizuoka_HP_url_arr[18],$shizuoka_HP_url_arr[19],
            $shizuoka_HP_url_arr[20],$shizuoka_HP_url_arr[21],$shizuoka_HP_url_arr[22],$shizuoka_HP_url_arr[23],$shizuoka_HP_url_arr[24],$shizuoka_HP_url_arr[25],$shizuoka_HP_url_arr[26],$shizuoka_HP_url_arr[27],$shizuoka_HP_url_arr[28],$shizuoka_HP_url_arr[29],$shizuoka_HP_url_arr[30],$shizuoka_HP_url_arr[31],$shizuoka_HP_url_arr[32],$shizuoka_HP_url_arr[33],$shizuoka_HP_url_arr[34],$shizuoka_HP_url_arr[35],$shizuoka_HP_url_arr[36],$shizuoka_HP_url_arr[37],$shizuoka_HP_url_arr[38],$shizuoka_HP_url_arr[39],
            $shizuoka_HP_url_arr[40],$shizuoka_HP_url_arr[41],$shizuoka_HP_url_arr[42],$shizuoka_HP_url_arr[43],$shizuoka_HP_url_arr[44],$shizuoka_HP_url_arr[45],$shizuoka_HP_url_arr[46],$shizuoka_HP_url_arr[47],$shizuoka_HP_url_arr[48],$shizuoka_HP_url_arr[49],$shizuoka_HP_url_arr[50],$shizuoka_HP_url_arr[51],$shizuoka_HP_url_arr[52],$shizuoka_HP_url_arr[53],$shizuoka_HP_url_arr[54],$shizuoka_HP_url_arr[55],$shizuoka_HP_url_arr[56],$shizuoka_HP_url_arr[57],$shizuoka_HP_url_arr[58],$shizuoka_HP_url_arr[59],
            $shizuoka_HP_url_arr[60],$shizuoka_HP_url_arr[61],$shizuoka_HP_url_arr[62],$shizuoka_HP_url_arr[63],$shizuoka_HP_url_arr[64],$shizuoka_HP_url_arr[65],$shizuoka_HP_url_arr[66],$shizuoka_HP_url_arr[67],$shizuoka_HP_url_arr[68],$shizuoka_HP_url_arr[69],$shizuoka_HP_url_arr[70],$shizuoka_HP_url_arr[71],$shizuoka_HP_url_arr[72]
        );
        $aichi_HP_url_arr = [];
        foreach($aichi_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/chubu/aichi/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $aichi_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $aichi_HP_url_arr[]= [null];
            }
        }
        $merged_aichi_HP_url_arr = array_merge(
            $aichi_HP_url_arr[0],$aichi_HP_url_arr[1],$aichi_HP_url_arr[2],$aichi_HP_url_arr[3],$aichi_HP_url_arr[4],$aichi_HP_url_arr[5],$aichi_HP_url_arr[6],$aichi_HP_url_arr[7],$aichi_HP_url_arr[8],$aichi_HP_url_arr[9],$aichi_HP_url_arr[10],$aichi_HP_url_arr[11],$aichi_HP_url_arr[12],$aichi_HP_url_arr[13],$aichi_HP_url_arr[14],$aichi_HP_url_arr[15],$aichi_HP_url_arr[16],$aichi_HP_url_arr[17],$aichi_HP_url_arr[18],$aichi_HP_url_arr[19],
            $aichi_HP_url_arr[20],$aichi_HP_url_arr[21],$aichi_HP_url_arr[22],$aichi_HP_url_arr[23],$aichi_HP_url_arr[24],$aichi_HP_url_arr[25],$aichi_HP_url_arr[26],$aichi_HP_url_arr[27],$aichi_HP_url_arr[28],$aichi_HP_url_arr[29],$aichi_HP_url_arr[30],$aichi_HP_url_arr[31],$aichi_HP_url_arr[32],$aichi_HP_url_arr[33],$aichi_HP_url_arr[34],$aichi_HP_url_arr[35],$aichi_HP_url_arr[36],$aichi_HP_url_arr[37],$aichi_HP_url_arr[38],$aichi_HP_url_arr[39],
            $aichi_HP_url_arr[40],$aichi_HP_url_arr[41],$aichi_HP_url_arr[42],$aichi_HP_url_arr[43],$aichi_HP_url_arr[44],$aichi_HP_url_arr[45],$aichi_HP_url_arr[46],$aichi_HP_url_arr[47],$aichi_HP_url_arr[48],$aichi_HP_url_arr[49],$aichi_HP_url_arr[50],$aichi_HP_url_arr[51],$aichi_HP_url_arr[52],$aichi_HP_url_arr[53],$aichi_HP_url_arr[54],$aichi_HP_url_arr[55],$aichi_HP_url_arr[56],$aichi_HP_url_arr[57],$aichi_HP_url_arr[58],$aichi_HP_url_arr[59],
            $aichi_HP_url_arr[60],$aichi_HP_url_arr[61],$aichi_HP_url_arr[62],$aichi_HP_url_arr[63],$aichi_HP_url_arr[64],$aichi_HP_url_arr[65],$aichi_HP_url_arr[66],$aichi_HP_url_arr[67],$aichi_HP_url_arr[68],$aichi_HP_url_arr[69],$aichi_HP_url_arr[70],$aichi_HP_url_arr[71],$aichi_HP_url_arr[72],$aichi_HP_url_arr[73],$aichi_HP_url_arr[74],$aichi_HP_url_arr[75],$aichi_HP_url_arr[76]
        );
        $mie_HP_url_arr = [];
        foreach($mie_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/chubu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $mie_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $mie_HP_url_arr[]= [null];
            }
        }
        $merged_mie_HP_url_arr = array_merge(
            $mie_HP_url_arr[0],$mie_HP_url_arr[1],$mie_HP_url_arr[2],$mie_HP_url_arr[3],$mie_HP_url_arr[4],$mie_HP_url_arr[5],$mie_HP_url_arr[6],$mie_HP_url_arr[7],$mie_HP_url_arr[8],$mie_HP_url_arr[9],$mie_HP_url_arr[10],$mie_HP_url_arr[11],$mie_HP_url_arr[12],$mie_HP_url_arr[13],$mie_HP_url_arr[14],$mie_HP_url_arr[15],$mie_HP_url_arr[16],$mie_HP_url_arr[17],$mie_HP_url_arr[18],$mie_HP_url_arr[19],
            $mie_HP_url_arr[20],$mie_HP_url_arr[21],$mie_HP_url_arr[22],$mie_HP_url_arr[23],$mie_HP_url_arr[24],$mie_HP_url_arr[25],$mie_HP_url_arr[26],$mie_HP_url_arr[27],$mie_HP_url_arr[28],$mie_HP_url_arr[29],$mie_HP_url_arr[30],$mie_HP_url_arr[31],$mie_HP_url_arr[32],$mie_HP_url_arr[33],$mie_HP_url_arr[34],$mie_HP_url_arr[35],$mie_HP_url_arr[36],$mie_HP_url_arr[37]
        );
        $shiga_HP_url_arr = [];
        foreach($shiga_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kinki/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $shiga_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $shiga_HP_url_arr[]= [null];
            }
        }
        $merged_shiga_HP_url_arr = array_merge(
            $shiga_HP_url_arr[0],$shiga_HP_url_arr[1],$shiga_HP_url_arr[2],$shiga_HP_url_arr[3],$shiga_HP_url_arr[4],$shiga_HP_url_arr[5],$shiga_HP_url_arr[6],$shiga_HP_url_arr[7],$shiga_HP_url_arr[8],$shiga_HP_url_arr[9],$shiga_HP_url_arr[10],$shiga_HP_url_arr[11],$shiga_HP_url_arr[12],$shiga_HP_url_arr[13],$shiga_HP_url_arr[14],$shiga_HP_url_arr[15],$shiga_HP_url_arr[16],$shiga_HP_url_arr[17],$shiga_HP_url_arr[18]
        );
        $kyoto_HP_url_arr = [];
        foreach($kyoto_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kinki/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $kyoto_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $kyoto_HP_url_arr[]= [null];
            }
        }
        $merged_kyoto_HP_url_arr = array_merge(
            $kyoto_HP_url_arr[0],$kyoto_HP_url_arr[1],$kyoto_HP_url_arr[2],$kyoto_HP_url_arr[3],$kyoto_HP_url_arr[4],$kyoto_HP_url_arr[5],$kyoto_HP_url_arr[6],$kyoto_HP_url_arr[7],$kyoto_HP_url_arr[8],$kyoto_HP_url_arr[9],$kyoto_HP_url_arr[10],$kyoto_HP_url_arr[11],$kyoto_HP_url_arr[12],$kyoto_HP_url_arr[13],$kyoto_HP_url_arr[14],$kyoto_HP_url_arr[15],$kyoto_HP_url_arr[16],$kyoto_HP_url_arr[17],$kyoto_HP_url_arr[18],$kyoto_HP_url_arr[19],
            $kyoto_HP_url_arr[20],$kyoto_HP_url_arr[21],$kyoto_HP_url_arr[22],$kyoto_HP_url_arr[23],$kyoto_HP_url_arr[24],$kyoto_HP_url_arr[25],$kyoto_HP_url_arr[26],$kyoto_HP_url_arr[27],$kyoto_HP_url_arr[28],$kyoto_HP_url_arr[29]
        );
        $osaka_HP_url_arr = [];
        foreach($osaka_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kinki/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $osaka_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $osaka_HP_url_arr[]= [null];
            }
        }
        $merged_osaka_HP_url_arr = array_merge(
            $osaka_HP_url_arr[0],$osaka_HP_url_arr[1],$osaka_HP_url_arr[2],$osaka_HP_url_arr[3],$osaka_HP_url_arr[4],$osaka_HP_url_arr[5],$osaka_HP_url_arr[6],$osaka_HP_url_arr[7],$osaka_HP_url_arr[8],$osaka_HP_url_arr[9],$osaka_HP_url_arr[10],$osaka_HP_url_arr[11],$osaka_HP_url_arr[12],$osaka_HP_url_arr[13],$osaka_HP_url_arr[14],$osaka_HP_url_arr[15],$osaka_HP_url_arr[16],$osaka_HP_url_arr[17],$osaka_HP_url_arr[18],$osaka_HP_url_arr[19],
            $osaka_HP_url_arr[20],$osaka_HP_url_arr[21],$osaka_HP_url_arr[22],$osaka_HP_url_arr[23],$osaka_HP_url_arr[24],$osaka_HP_url_arr[25],$osaka_HP_url_arr[26],$osaka_HP_url_arr[27],$osaka_HP_url_arr[28],$osaka_HP_url_arr[29],$osaka_HP_url_arr[30],$osaka_HP_url_arr[31],$osaka_HP_url_arr[32],$osaka_HP_url_arr[33],$osaka_HP_url_arr[34],$osaka_HP_url_arr[35],$osaka_HP_url_arr[36],$osaka_HP_url_arr[37],$osaka_HP_url_arr[38],$osaka_HP_url_arr[39],
            $osaka_HP_url_arr[40],$osaka_HP_url_arr[41],$osaka_HP_url_arr[42],$osaka_HP_url_arr[43],$osaka_HP_url_arr[44],$osaka_HP_url_arr[45],$osaka_HP_url_arr[46],$osaka_HP_url_arr[47],$osaka_HP_url_arr[48],$osaka_HP_url_arr[49],$osaka_HP_url_arr[50],$osaka_HP_url_arr[51],$osaka_HP_url_arr[52],$osaka_HP_url_arr[53],$osaka_HP_url_arr[54],$osaka_HP_url_arr[55],$osaka_HP_url_arr[56],$osaka_HP_url_arr[57],$osaka_HP_url_arr[58],$osaka_HP_url_arr[59],
            $osaka_HP_url_arr[60],$osaka_HP_url_arr[61],$osaka_HP_url_arr[62],$osaka_HP_url_arr[63],$osaka_HP_url_arr[64],$osaka_HP_url_arr[65],$osaka_HP_url_arr[66],$osaka_HP_url_arr[67],$osaka_HP_url_arr[68],$osaka_HP_url_arr[69],$osaka_HP_url_arr[70],$osaka_HP_url_arr[71],$osaka_HP_url_arr[72]
        );
        $hyogo_HP_url_arr = [];
        foreach($hyogo_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kinki/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $hyogo_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $hyogo_HP_url_arr[]= [null];
            }
        }
        $merged_hyogo_HP_url_arr = array_merge(
            $hyogo_HP_url_arr[0],$hyogo_HP_url_arr[1],$hyogo_HP_url_arr[2],$hyogo_HP_url_arr[3],$hyogo_HP_url_arr[4],$hyogo_HP_url_arr[5],$hyogo_HP_url_arr[6],$hyogo_HP_url_arr[7],$hyogo_HP_url_arr[8],$hyogo_HP_url_arr[9],$hyogo_HP_url_arr[10],$hyogo_HP_url_arr[11],$hyogo_HP_url_arr[12],$hyogo_HP_url_arr[13],$hyogo_HP_url_arr[14],$hyogo_HP_url_arr[15],$hyogo_HP_url_arr[16],$hyogo_HP_url_arr[17],$hyogo_HP_url_arr[18],$hyogo_HP_url_arr[19],
            $hyogo_HP_url_arr[20],$hyogo_HP_url_arr[21],$hyogo_HP_url_arr[22],$hyogo_HP_url_arr[23],$hyogo_HP_url_arr[24],$hyogo_HP_url_arr[25],$hyogo_HP_url_arr[26],$hyogo_HP_url_arr[27],$hyogo_HP_url_arr[28],$hyogo_HP_url_arr[29],$hyogo_HP_url_arr[30],$hyogo_HP_url_arr[31],$hyogo_HP_url_arr[32],$hyogo_HP_url_arr[33],$hyogo_HP_url_arr[34],$hyogo_HP_url_arr[35],$hyogo_HP_url_arr[36],$hyogo_HP_url_arr[37],$hyogo_HP_url_arr[38],$hyogo_HP_url_arr[39],
            $hyogo_HP_url_arr[40],$hyogo_HP_url_arr[41],$hyogo_HP_url_arr[42],$hyogo_HP_url_arr[43],$hyogo_HP_url_arr[44],$hyogo_HP_url_arr[45],$hyogo_HP_url_arr[46],$hyogo_HP_url_arr[47],$hyogo_HP_url_arr[48],$hyogo_HP_url_arr[49],$hyogo_HP_url_arr[50],$hyogo_HP_url_arr[51],$hyogo_HP_url_arr[52],$hyogo_HP_url_arr[53],$hyogo_HP_url_arr[54],$hyogo_HP_url_arr[55],$hyogo_HP_url_arr[56],$hyogo_HP_url_arr[57],$hyogo_HP_url_arr[58],$hyogo_HP_url_arr[59],
            $hyogo_HP_url_arr[60],$hyogo_HP_url_arr[61],$hyogo_HP_url_arr[62],$hyogo_HP_url_arr[63],$hyogo_HP_url_arr[64],$hyogo_HP_url_arr[65],$hyogo_HP_url_arr[66],$hyogo_HP_url_arr[67],$hyogo_HP_url_arr[68],$hyogo_HP_url_arr[69],$hyogo_HP_url_arr[70],$hyogo_HP_url_arr[71],$hyogo_HP_url_arr[72],$hyogo_HP_url_arr[73],$hyogo_HP_url_arr[74],$hyogo_HP_url_arr[75],$hyogo_HP_url_arr[76],$hyogo_HP_url_arr[77],$hyogo_HP_url_arr[78],$hyogo_HP_url_arr[79],
            $hyogo_HP_url_arr[80],$hyogo_HP_url_arr[81],$hyogo_HP_url_arr[82],$hyogo_HP_url_arr[83],$hyogo_HP_url_arr[84],$hyogo_HP_url_arr[85],$hyogo_HP_url_arr[86],$hyogo_HP_url_arr[87],$hyogo_HP_url_arr[88],$hyogo_HP_url_arr[89],$hyogo_HP_url_arr[90],$hyogo_HP_url_arr[91],$hyogo_HP_url_arr[92],$hyogo_HP_url_arr[93],$hyogo_HP_url_arr[94],$hyogo_HP_url_arr[95],$hyogo_HP_url_arr[96],$hyogo_HP_url_arr[97],$hyogo_HP_url_arr[98],$hyogo_HP_url_arr[99],
        );
        $nara_HP_url_arr = [];
        foreach($nara_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kinki/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $nara_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $nara_HP_url_arr[]= [null];
            }
        }
        $merged_nara_HP_url_arr = array_merge(
            $nara_HP_url_arr[0],$nara_HP_url_arr[1],$nara_HP_url_arr[2],$nara_HP_url_arr[3],$nara_HP_url_arr[4],$nara_HP_url_arr[5],$nara_HP_url_arr[6],$nara_HP_url_arr[7],$nara_HP_url_arr[8],$nara_HP_url_arr[9],$nara_HP_url_arr[10],$nara_HP_url_arr[11],$nara_HP_url_arr[12],$nara_HP_url_arr[13],$nara_HP_url_arr[14],$nara_HP_url_arr[15],$nara_HP_url_arr[16],$nara_HP_url_arr[17],$nara_HP_url_arr[18],$nara_HP_url_arr[19],
            $nara_HP_url_arr[20],$nara_HP_url_arr[21],$nara_HP_url_arr[22],$nara_HP_url_arr[23]
        );
        $wakayama_HP_url_arr = [];
        foreach($wakayama_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kinki/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $wakayama_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $wakayama_HP_url_arr[]= [null];
            }
        }
        $merged_wakayama_HP_url_arr = array_merge(
            $wakayama_HP_url_arr[0],$wakayama_HP_url_arr[1],$wakayama_HP_url_arr[2],$wakayama_HP_url_arr[3],$wakayama_HP_url_arr[4],$wakayama_HP_url_arr[5],$wakayama_HP_url_arr[6],$wakayama_HP_url_arr[7],$wakayama_HP_url_arr[8],$wakayama_HP_url_arr[9],$wakayama_HP_url_arr[10],$wakayama_HP_url_arr[11],$wakayama_HP_url_arr[12],$wakayama_HP_url_arr[13],$wakayama_HP_url_arr[14],$wakayama_HP_url_arr[15],$wakayama_HP_url_arr[16],$wakayama_HP_url_arr[17],$wakayama_HP_url_arr[18],$wakayama_HP_url_arr[19],
            $wakayama_HP_url_arr[20],$wakayama_HP_url_arr[21],$wakayama_HP_url_arr[22],$wakayama_HP_url_arr[23],$wakayama_HP_url_arr[24],$wakayama_HP_url_arr[25],$wakayama_HP_url_arr[26],$wakayama_HP_url_arr[27],$wakayama_HP_url_arr[28],$wakayama_HP_url_arr[29],$wakayama_HP_url_arr[30],$wakayama_HP_url_arr[31],$wakayama_HP_url_arr[32]
        );
        $totori_HP_url_arr = [];
        foreach($totori_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/chugoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $totori_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $totori_HP_url_arr[]= [null];
            }
        }
        $merged_totori_HP_url_arr = array_merge(
            $totori_HP_url_arr[0],$totori_HP_url_arr[1],$totori_HP_url_arr[2],$totori_HP_url_arr[3],$totori_HP_url_arr[4],$totori_HP_url_arr[5],$totori_HP_url_arr[6],$totori_HP_url_arr[7],$totori_HP_url_arr[8],$totori_HP_url_arr[9],$totori_HP_url_arr[10],$totori_HP_url_arr[11],$totori_HP_url_arr[12],$totori_HP_url_arr[13],$totori_HP_url_arr[14],$totori_HP_url_arr[15],$totori_HP_url_arr[16],$totori_HP_url_arr[17]
        );
        $shimane_HP_url_arr = [];
        foreach($shimane_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/chugoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $shimane_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $shimane_HP_url_arr[]= [null];
            }
        }
        $merged_shimane_HP_url_arr = array_merge(
            $shimane_HP_url_arr[0],$shimane_HP_url_arr[1],$shimane_HP_url_arr[2],$shimane_HP_url_arr[3],$shimane_HP_url_arr[4],$shimane_HP_url_arr[5],$shimane_HP_url_arr[6],$shimane_HP_url_arr[7],$shimane_HP_url_arr[8],$shimane_HP_url_arr[9],$shimane_HP_url_arr[10],$shimane_HP_url_arr[11],$shimane_HP_url_arr[12],$shimane_HP_url_arr[13],$shimane_HP_url_arr[14],$shimane_HP_url_arr[15],$shimane_HP_url_arr[16],$shimane_HP_url_arr[17],$shimane_HP_url_arr[18],$shimane_HP_url_arr[19],
            $shimane_HP_url_arr[20],$shimane_HP_url_arr[21],$shimane_HP_url_arr[22]
        );
        $okayama_HP_url_arr = [];
        foreach($okayama_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/chugoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $okayama_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $okayama_HP_url_arr[]= [null];
            }
        }
        $merged_okayama_HP_url_arr = array_merge(
            $okayama_HP_url_arr[0],$okayama_HP_url_arr[1],$okayama_HP_url_arr[2],$okayama_HP_url_arr[3],$okayama_HP_url_arr[4],$okayama_HP_url_arr[5],$okayama_HP_url_arr[6],$okayama_HP_url_arr[7],$okayama_HP_url_arr[8],$okayama_HP_url_arr[9],$okayama_HP_url_arr[10],$okayama_HP_url_arr[11],$okayama_HP_url_arr[12],$okayama_HP_url_arr[13],$okayama_HP_url_arr[14],$okayama_HP_url_arr[15],$okayama_HP_url_arr[16],$okayama_HP_url_arr[17],$okayama_HP_url_arr[18],$okayama_HP_url_arr[19],
            $okayama_HP_url_arr[20],$okayama_HP_url_arr[21],$okayama_HP_url_arr[22],$okayama_HP_url_arr[23],$okayama_HP_url_arr[24],$okayama_HP_url_arr[25],$okayama_HP_url_arr[26],$okayama_HP_url_arr[27],$okayama_HP_url_arr[28],$okayama_HP_url_arr[29]
        );
        $hiroshima_HP_url_arr = [];
        foreach($hiroshima_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/chugoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $hiroshima_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $hiroshima_HP_url_arr[]= [null];
            }
        }
        $merged_hiroshima_HP_url_arr = array_merge(
            $hiroshima_HP_url_arr[0],$hiroshima_HP_url_arr[1],$hiroshima_HP_url_arr[2],$hiroshima_HP_url_arr[3],$hiroshima_HP_url_arr[4],$hiroshima_HP_url_arr[5],$hiroshima_HP_url_arr[6],$hiroshima_HP_url_arr[7],$hiroshima_HP_url_arr[8],$hiroshima_HP_url_arr[9],$hiroshima_HP_url_arr[10],$hiroshima_HP_url_arr[11],$hiroshima_HP_url_arr[12],$hiroshima_HP_url_arr[13],$hiroshima_HP_url_arr[14],$hiroshima_HP_url_arr[15],$hiroshima_HP_url_arr[16],$hiroshima_HP_url_arr[17],$hiroshima_HP_url_arr[18],$hiroshima_HP_url_arr[19],
            $hiroshima_HP_url_arr[20],$hiroshima_HP_url_arr[21],$hiroshima_HP_url_arr[22],$hiroshima_HP_url_arr[23],$hiroshima_HP_url_arr[24],$hiroshima_HP_url_arr[25],$hiroshima_HP_url_arr[26],$hiroshima_HP_url_arr[27],$hiroshima_HP_url_arr[28],$hiroshima_HP_url_arr[29],$hiroshima_HP_url_arr[30],$hiroshima_HP_url_arr[31],$hiroshima_HP_url_arr[32],$hiroshima_HP_url_arr[33],$hiroshima_HP_url_arr[34],$hiroshima_HP_url_arr[35],$hiroshima_HP_url_arr[36]
        );
        $yamaguchi_HP_url_arr = [];
        foreach($yamaguchi_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/chugoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $yamaguchi_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $yamaguchi_HP_url_arr[]= [null];
            }
        }
        $merged_yamaguchi_HP_url_arr = array_merge(
            $yamaguchi_HP_url_arr[0],$yamaguchi_HP_url_arr[1],$yamaguchi_HP_url_arr[2],$yamaguchi_HP_url_arr[3],$yamaguchi_HP_url_arr[4],$yamaguchi_HP_url_arr[5],$yamaguchi_HP_url_arr[6],$yamaguchi_HP_url_arr[7],$yamaguchi_HP_url_arr[8],$yamaguchi_HP_url_arr[9],$yamaguchi_HP_url_arr[10],$yamaguchi_HP_url_arr[11],$yamaguchi_HP_url_arr[12],$yamaguchi_HP_url_arr[13],$yamaguchi_HP_url_arr[14],$yamaguchi_HP_url_arr[15],$yamaguchi_HP_url_arr[16],$yamaguchi_HP_url_arr[17],$yamaguchi_HP_url_arr[18],$yamaguchi_HP_url_arr[19],
            $yamaguchi_HP_url_arr[20],$yamaguchi_HP_url_arr[21],$yamaguchi_HP_url_arr[22],$yamaguchi_HP_url_arr[23],$yamaguchi_HP_url_arr[24],$yamaguchi_HP_url_arr[25],$yamaguchi_HP_url_arr[26],$yamaguchi_HP_url_arr[27],$yamaguchi_HP_url_arr[28]
        );
        $tokushima_HP_url_arr = [];
        foreach($tokushima_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/shikoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $tokushima_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $tokushima_HP_url_arr[]= [null];
            }
        }
        $merged_tokushima_HP_url_arr = array_merge(
            $tokushima_HP_url_arr[0],$tokushima_HP_url_arr[1],$tokushima_HP_url_arr[2],$tokushima_HP_url_arr[3],$tokushima_HP_url_arr[4],$tokushima_HP_url_arr[5],$tokushima_HP_url_arr[6],$tokushima_HP_url_arr[7],$tokushima_HP_url_arr[8],$tokushima_HP_url_arr[9],$tokushima_HP_url_arr[10],$tokushima_HP_url_arr[11],$tokushima_HP_url_arr[12],$tokushima_HP_url_arr[13],$tokushima_HP_url_arr[14],$tokushima_HP_url_arr[15]
        );
        $kagawa_HP_url_arr = [];
        foreach($kagawa_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/shikoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $kagawa_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $kagawa_HP_url_arr[]= [null];
            }
        }
        $merged_kagawa_HP_url_arr = array_merge(
            $kagawa_HP_url_arr[0],$kagawa_HP_url_arr[1],$kagawa_HP_url_arr[2],$kagawa_HP_url_arr[3],$kagawa_HP_url_arr[4],$kagawa_HP_url_arr[5],$kagawa_HP_url_arr[6],$kagawa_HP_url_arr[7],$kagawa_HP_url_arr[8],$kagawa_HP_url_arr[9],$kagawa_HP_url_arr[10],$kagawa_HP_url_arr[11],$kagawa_HP_url_arr[12],$kagawa_HP_url_arr[13],$kagawa_HP_url_arr[14],$kagawa_HP_url_arr[15],$kagawa_HP_url_arr[16],$kagawa_HP_url_arr[17],$kagawa_HP_url_arr[18],$kagawa_HP_url_arr[19],
            $kagawa_HP_url_arr[20],$kagawa_HP_url_arr[21],$kagawa_HP_url_arr[22],$kagawa_HP_url_arr[23],$kagawa_HP_url_arr[24],$kagawa_HP_url_arr[25],$kagawa_HP_url_arr[26],$kagawa_HP_url_arr[27],$kagawa_HP_url_arr[28]
        );
        $ehime_HP_url_arr = [];
        foreach($ehime_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/shikoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $ehime_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $ehime_HP_url_arr[]= [null];
            }
        }
        $merged_ehime_HP_url_arr = array_merge(
            $ehime_HP_url_arr[0],$ehime_HP_url_arr[1],$ehime_HP_url_arr[2],$ehime_HP_url_arr[3],$ehime_HP_url_arr[4],$ehime_HP_url_arr[5],$ehime_HP_url_arr[6],$ehime_HP_url_arr[7],$ehime_HP_url_arr[8],$ehime_HP_url_arr[9],$ehime_HP_url_arr[10],$ehime_HP_url_arr[11],$ehime_HP_url_arr[12],$ehime_HP_url_arr[13],$ehime_HP_url_arr[14],$ehime_HP_url_arr[15],$ehime_HP_url_arr[16],$ehime_HP_url_arr[17],$ehime_HP_url_arr[18],$ehime_HP_url_arr[19],
            $ehime_HP_url_arr[20],$ehime_HP_url_arr[21],$ehime_HP_url_arr[22],$ehime_HP_url_arr[23],$ehime_HP_url_arr[24],$ehime_HP_url_arr[25],$ehime_HP_url_arr[26],$ehime_HP_url_arr[27],$ehime_HP_url_arr[28],$ehime_HP_url_arr[29],$ehime_HP_url_arr[30],$ehime_HP_url_arr[31],$ehime_HP_url_arr[32],$ehime_HP_url_arr[33],$ehime_HP_url_arr[34],$ehime_HP_url_arr[35],$ehime_HP_url_arr[36],$ehime_HP_url_arr[37],$ehime_HP_url_arr[38]
        );
        $kochi_HP_url_arr = [];
        foreach($kochi_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/shikoku/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $kochi_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $kochi_HP_url_arr[]= [null];
            }
        }
        $merged_kochi_HP_url_arr = array_merge(
            $kochi_HP_url_arr[0],$kochi_HP_url_arr[1],$kochi_HP_url_arr[2],$kochi_HP_url_arr[3],$kochi_HP_url_arr[4],$kochi_HP_url_arr[5],$kochi_HP_url_arr[6],$kochi_HP_url_arr[7],$kochi_HP_url_arr[8],$kochi_HP_url_arr[9],$kochi_HP_url_arr[10],$kochi_HP_url_arr[11],$kochi_HP_url_arr[12],$kochi_HP_url_arr[13],$kochi_HP_url_arr[14]
        );
        $fukuoka_HP_url_arr = [];
        foreach($fukuoka_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kyusyu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $fukuoka_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $fukuoka_HP_url_arr[]= [null];
            }
        }
        $merged_fukuoka_HP_url_arr = array_merge(
            $fukuoka_HP_url_arr[0],$fukuoka_HP_url_arr[1],$fukuoka_HP_url_arr[2],$fukuoka_HP_url_arr[3],$fukuoka_HP_url_arr[4],$fukuoka_HP_url_arr[5],$fukuoka_HP_url_arr[6],$fukuoka_HP_url_arr[7],$fukuoka_HP_url_arr[8],$fukuoka_HP_url_arr[9],$fukuoka_HP_url_arr[10],$fukuoka_HP_url_arr[11],$fukuoka_HP_url_arr[12],$fukuoka_HP_url_arr[13],$fukuoka_HP_url_arr[14],$fukuoka_HP_url_arr[15],$fukuoka_HP_url_arr[16],$fukuoka_HP_url_arr[17],$fukuoka_HP_url_arr[18],$fukuoka_HP_url_arr[19],
            $fukuoka_HP_url_arr[20],$fukuoka_HP_url_arr[21],$fukuoka_HP_url_arr[22],$fukuoka_HP_url_arr[23],$fukuoka_HP_url_arr[24],$fukuoka_HP_url_arr[25],$fukuoka_HP_url_arr[26],$fukuoka_HP_url_arr[27],$fukuoka_HP_url_arr[28],$fukuoka_HP_url_arr[29],$fukuoka_HP_url_arr[30],$fukuoka_HP_url_arr[31],$fukuoka_HP_url_arr[32],$fukuoka_HP_url_arr[33],$fukuoka_HP_url_arr[34],$fukuoka_HP_url_arr[35],$fukuoka_HP_url_arr[36],$fukuoka_HP_url_arr[37],$fukuoka_HP_url_arr[38],$fukuoka_HP_url_arr[39],
            $fukuoka_HP_url_arr[40],$fukuoka_HP_url_arr[41],$fukuoka_HP_url_arr[42],$fukuoka_HP_url_arr[43],$fukuoka_HP_url_arr[44],$fukuoka_HP_url_arr[45],$fukuoka_HP_url_arr[46],$fukuoka_HP_url_arr[47],$fukuoka_HP_url_arr[48],$fukuoka_HP_url_arr[49],$fukuoka_HP_url_arr[50],$fukuoka_HP_url_arr[51],$fukuoka_HP_url_arr[52],$fukuoka_HP_url_arr[53],$fukuoka_HP_url_arr[54],$fukuoka_HP_url_arr[55],$fukuoka_HP_url_arr[56],$fukuoka_HP_url_arr[57]
        );
        $saga_HP_url_arr = [];
        foreach($saga_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kyusyu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $saga_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $saga_HP_url_arr[]= [null];
            }
        }
        $merged_saga_HP_url_arr = array_merge(
            $saga_HP_url_arr[0],$saga_HP_url_arr[1],$saga_HP_url_arr[2],$saga_HP_url_arr[3],$saga_HP_url_arr[4],$saga_HP_url_arr[5],$saga_HP_url_arr[6],$saga_HP_url_arr[7],$saga_HP_url_arr[8],$saga_HP_url_arr[9],$saga_HP_url_arr[10],$saga_HP_url_arr[11],$saga_HP_url_arr[12],$saga_HP_url_arr[13],$saga_HP_url_arr[14],$saga_HP_url_arr[15],$saga_HP_url_arr[16],$saga_HP_url_arr[17],$saga_HP_url_arr[18],$saga_HP_url_arr[19],
            $saga_HP_url_arr[20],$saga_HP_url_arr[21],$saga_HP_url_arr[22],$saga_HP_url_arr[23],$saga_HP_url_arr[24]
        );
        $nagasaki_HP_url_arr = [];
        foreach($nagasaki_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kyusyu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $nagasaki_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $nagasaki_HP_url_arr[]= [null];
            }
        }
        $merged_nagasaki_HP_url_arr = array_merge(
            $nagasaki_HP_url_arr[0],$nagasaki_HP_url_arr[1],$nagasaki_HP_url_arr[2],$nagasaki_HP_url_arr[3],$nagasaki_HP_url_arr[4],$nagasaki_HP_url_arr[5],$nagasaki_HP_url_arr[6],$nagasaki_HP_url_arr[7],$nagasaki_HP_url_arr[8],$nagasaki_HP_url_arr[9],$nagasaki_HP_url_arr[10],$nagasaki_HP_url_arr[11],$nagasaki_HP_url_arr[12],$nagasaki_HP_url_arr[13],$nagasaki_HP_url_arr[14],$nagasaki_HP_url_arr[15],$nagasaki_HP_url_arr[16],$nagasaki_HP_url_arr[17],$nagasaki_HP_url_arr[18],$nagasaki_HP_url_arr[19],
            $nagasaki_HP_url_arr[20],$nagasaki_HP_url_arr[21]
        );
        $kumamoto_HP_url_arr = [];
        foreach($kumamoto_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kyusyu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $kumamoto_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $kumamoto_HP_url_arr[]= [null];
            }
        }
        $merged_kumamoto_HP_url_arr = array_merge(
            $kumamoto_HP_url_arr[0],$kumamoto_HP_url_arr[1],$kumamoto_HP_url_arr[2],$kumamoto_HP_url_arr[3],$kumamoto_HP_url_arr[4],$kumamoto_HP_url_arr[5],$kumamoto_HP_url_arr[6],$kumamoto_HP_url_arr[7],$kumamoto_HP_url_arr[8],$kumamoto_HP_url_arr[9],$kumamoto_HP_url_arr[10],$kumamoto_HP_url_arr[11],$kumamoto_HP_url_arr[12],$kumamoto_HP_url_arr[13],$kumamoto_HP_url_arr[14],$kumamoto_HP_url_arr[15],$kumamoto_HP_url_arr[16],$kumamoto_HP_url_arr[17],$kumamoto_HP_url_arr[18],$kumamoto_HP_url_arr[19],
            $kumamoto_HP_url_arr[20],$kumamoto_HP_url_arr[21],$kumamoto_HP_url_arr[22],$kumamoto_HP_url_arr[23],$kumamoto_HP_url_arr[24],$kumamoto_HP_url_arr[25],$kumamoto_HP_url_arr[26],$kumamoto_HP_url_arr[27],$kumamoto_HP_url_arr[28],$kumamoto_HP_url_arr[29],$kumamoto_HP_url_arr[30],$kumamoto_HP_url_arr[31],$kumamoto_HP_url_arr[32],$kumamoto_HP_url_arr[33],$kumamoto_HP_url_arr[34],$kumamoto_HP_url_arr[35],$kumamoto_HP_url_arr[36],$kumamoto_HP_url_arr[37],$kumamoto_HP_url_arr[38],$kumamoto_HP_url_arr[39],
            $kumamoto_HP_url_arr[40],$kumamoto_HP_url_arr[41],$kumamoto_HP_url_arr[42],$kumamoto_HP_url_arr[43]
        );
        $ooita_HP_url_arr = [];
        foreach($ooita_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kyusyu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $ooita_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $ooita_HP_url_arr[]= [null];
            }
        }
        $merged_ooita_HP_url_arr = array_merge(
            $ooita_HP_url_arr[0],$ooita_HP_url_arr[1],$ooita_HP_url_arr[2],$ooita_HP_url_arr[3],$ooita_HP_url_arr[4],$ooita_HP_url_arr[5],$ooita_HP_url_arr[6],$ooita_HP_url_arr[7],$ooita_HP_url_arr[8],$ooita_HP_url_arr[9],$ooita_HP_url_arr[10],$ooita_HP_url_arr[11],$ooita_HP_url_arr[12],$ooita_HP_url_arr[13],$ooita_HP_url_arr[14],$ooita_HP_url_arr[15],$ooita_HP_url_arr[16],$ooita_HP_url_arr[17],$ooita_HP_url_arr[18],$ooita_HP_url_arr[19],
            $ooita_HP_url_arr[20],$ooita_HP_url_arr[21],$ooita_HP_url_arr[22],$ooita_HP_url_arr[23],$ooita_HP_url_arr[24],$ooita_HP_url_arr[25],$ooita_HP_url_arr[26],$ooita_HP_url_arr[27],$ooita_HP_url_arr[28],$ooita_HP_url_arr[29],$ooita_HP_url_arr[30],$ooita_HP_url_arr[31],$ooita_HP_url_arr[32],$ooita_HP_url_arr[33]
        );
        $miyazaki_HP_url_arr = [];
        foreach($miyazaki_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kyusyu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $miyazaki_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $miyazaki_HP_url_arr[]= [null];
            }
        }
        $merged_miyazaki_HP_url_arr = array_merge(
            $miyazaki_HP_url_arr[0],$miyazaki_HP_url_arr[1],$miyazaki_HP_url_arr[2],$miyazaki_HP_url_arr[3],$miyazaki_HP_url_arr[4],$miyazaki_HP_url_arr[5],$miyazaki_HP_url_arr[6],$miyazaki_HP_url_arr[7],$miyazaki_HP_url_arr[8],$miyazaki_HP_url_arr[9],$miyazaki_HP_url_arr[10],$miyazaki_HP_url_arr[11],$miyazaki_HP_url_arr[12],$miyazaki_HP_url_arr[13],$miyazaki_HP_url_arr[14],$miyazaki_HP_url_arr[15],$miyazaki_HP_url_arr[16],$miyazaki_HP_url_arr[17],$miyazaki_HP_url_arr[18],$miyazaki_HP_url_arr[19],
            $miyazaki_HP_url_arr[20],$miyazaki_HP_url_arr[21],$miyazaki_HP_url_arr[22],$miyazaki_HP_url_arr[23],$miyazaki_HP_url_arr[24],$miyazaki_HP_url_arr[25],$miyazaki_HP_url_arr[26]
        );
        $kagoshima_HP_url_arr = [];
        foreach($kagoshima_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/kyusyu/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $kagoshima_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $kagoshima_HP_url_arr[]= [null];
            }
        }
        $merged_kagoshima_HP_url_arr = array_merge(
            $kagoshima_HP_url_arr[0],$kagoshima_HP_url_arr[1],$kagoshima_HP_url_arr[2],$kagoshima_HP_url_arr[3],$kagoshima_HP_url_arr[4],$kagoshima_HP_url_arr[5],$kagoshima_HP_url_arr[6],$kagoshima_HP_url_arr[7],$kagoshima_HP_url_arr[8],$kagoshima_HP_url_arr[9],$kagoshima_HP_url_arr[10],$kagoshima_HP_url_arr[11],$kagoshima_HP_url_arr[12],$kagoshima_HP_url_arr[13],$kagoshima_HP_url_arr[14],$kagoshima_HP_url_arr[15],$kagoshima_HP_url_arr[16],$kagoshima_HP_url_arr[17],$kagoshima_HP_url_arr[18],$kagoshima_HP_url_arr[19],
            $kagoshima_HP_url_arr[20],$kagoshima_HP_url_arr[21],$kagoshima_HP_url_arr[22],$kagoshima_HP_url_arr[23],$kagoshima_HP_url_arr[24],$kagoshima_HP_url_arr[25],$kagoshima_HP_url_arr[26],$kagoshima_HP_url_arr[27],$kagoshima_HP_url_arr[28],$kagoshima_HP_url_arr[29],$kagoshima_HP_url_arr[30],$kagoshima_HP_url_arr[31],$kagoshima_HP_url_arr[32],$kagoshima_HP_url_arr[33],$kagoshima_HP_url_arr[34],$kagoshima_HP_url_arr[35],$kagoshima_HP_url_arr[36],$kagoshima_HP_url_arr[37],$kagoshima_HP_url_arr[38],$kagoshima_HP_url_arr[39],
            $kagoshima_HP_url_arr[40],$kagoshima_HP_url_arr[41],$kagoshima_HP_url_arr[42],$kagoshima_HP_url_arr[43]
        );
        $okinawa_HP_url_arr = [];
        foreach($okinawa_href as $url) {
            $bath_url = $client->request('GET', 'https://www.supersento.com/okinawa/'.$url);
            if($bath_url->filter('.gochui_txt')->count() !== 0) {
                $okinawa_HP_url_arr[]= $bath_url->filter('.gochui_txt')->last()->each(function ($node) { return $node->filter('a')->first()->attr('href'); });
            } else {
                $okinawa_HP_url_arr[]= [null];
            }
        }
        $merged_okinawa_HP_url_arr = array_merge(
            $miyazaki_HP_url_arr[0],$miyazaki_HP_url_arr[1],$miyazaki_HP_url_arr[2],$miyazaki_HP_url_arr[3],$miyazaki_HP_url_arr[4],$miyazaki_HP_url_arr[5],$miyazaki_HP_url_arr[6],$miyazaki_HP_url_arr[7],$miyazaki_HP_url_arr[8],$miyazaki_HP_url_arr[9],$miyazaki_HP_url_arr[10]
        );

        // お風呂URLまとめ
        $merged_URL = array_merge($merged_hokaido_HP_url_arr,$merged_aomori_HP_url_arr,$merged_iwate_HP_url_arr,$merged_akita_HP_url_arr,$merged_yamagata_HP_url_arr,$merged_miyagi_HP_url_arr,$merged_fukushima_HP_url_arr,$merged_ibaraki_HP_url_arr,$merged_tochigi_HP_url_arr,$merged_gunma_HP_url_arr,$merged_saitama_HP_url_arr,$merged_chiba_HP_url_arr,$merged_tokyo_HP_url_arr,$merged_kanagawa_HP_url_arr,$merged_niigata_HP_url_arr,$merged_toyama_HP_url_arr,$merged_ishikawa_HP_url_arr,$merged_fukui_HP_url_arr,$merged_yamanashi_HP_url_arr,$merged_nagano_HP_url_arr,$merged_gifu_HP_url_arr,$merged_shizuoka_HP_url_arr,$merged_aichi_HP_url_arr,$merged_mie_HP_url_arr,$merged_shiga_HP_url_arr,$merged_kyoto_HP_url_arr,$merged_osaka_HP_url_arr,$merged_hyogo_HP_url_arr,$merged_nara_HP_url_arr,$merged_wakayama_HP_url_arr,$merged_totori_HP_url_arr,$merged_shimane_HP_url_arr,$merged_okayama_HP_url_arr,$merged_hiroshima_HP_url_arr,$merged_yamaguchi_HP_url_arr,$merged_tokushima_HP_url_arr,$merged_kagawa_HP_url_arr,$merged_ehime_HP_url_arr,$merged_kochi_HP_url_arr,$merged_fukuoka_HP_url_arr,$merged_saga_HP_url_arr,$merged_nagasaki_HP_url_arr,$merged_kumamoto_HP_url_arr,$merged_ooita_HP_url_arr,$merged_miyazaki_HP_url_arr,$merged_kagoshima_HP_url_arr,$merged_okinawa_HP_url_arr);

        for($i=0; $i<count($names);$i++) {
            Bath::insert([
                'name' => $names[$i],
                // 'closing_day' => $closes[$i],
                'place' => $prefecures[$i],
                'url' => $merged_URL[$i],
            ]);
        }
    }
}
