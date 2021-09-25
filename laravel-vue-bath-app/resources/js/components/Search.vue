<template>
    <div>
        <div class="popup hide" id="popup">
            <div class="content">
                <p class="text">まだ、ログインが完了していません。</p>
                <p class="text">ログインを完了させてください。</p>
                <button class="btn close" id="close"></button>
            </div>
        </div>
        <div class="form-block">
            <p class="prefecture-error error"></p> <p class="keyword-error error"></p> <p class="field-error error"></p>
            <div class="prefecture-keyword">
                <select class="prefecture field" name="prefecture" v-model="selectedPrefecture">
                    <option value="" hidden>都道府県を選択してください</option>
                    <option v-for="prefecture in selectData.prefectures" :key="prefecture.code" :value="prefecture.code">{{ prefecture.name }}</option>
                </select>
                <input class="keyword field" type="search" name="keyword" v-model="keyword" placeholder="キーワードを入力してください">
            </div>
            <ul class="eval-select">
                <li v-for="evalBlock in evalBlocks" :key="evalBlock.name" class="eval-block">
                    <div class="error-block">
                        <p :class="evalBlock.errorRow + '-eval-error error'"></p><p :class="evalBlock.errorHigh + '-eval-error error'"></p>
                    </div>
                    <div class="eval-select-block">
                        <label for="" class="select-form-title">{{ evalBlock.name }}</label>
                        <select class="eval field" :name="evalBlock.nameTag" v-model="evalBlock.rowSelectedEval">
                            <option value="">{{ evalBlock.name }}</option>
                            <option v-for="e in selectData.eval" :key="e.code" :value="e.code">{{ e.name }}</option>
                        </select>
                        <span>〜</span>
                        <select class="eval field" :name="evalBlock.nameTag" v-model="evalBlock.highSelectedEval">
                            <option value="">{{ evalBlock.name }}</option>
                            <option v-for="e in selectData.eval" :key="e.code" :value="e.code">{{ e.name }}</option>
                        </select>
                    </div>
                </li>
            </ul>
            <button class="main-submit-btn field" @click="getBathsInfo()"></button>
        </div>

        <div class="search-result bath-index">
            <ul class="bath">
                <p class="bath-num" v-if="baths.length > 0">お風呂件数：{{ baths.length }}件</p>
                <li class="list" v-for="bath in baths" :key="bath.index">
                    <p v-if="bath.id == resFavoritedId" class="favorite-error error"></p>
                    <div class="title-block">
                        <h4 class="title">{{ bath.name }}</h4>
                        <a v-if="isFavoritedId.includes(bath.id)" @click="unFavorite(bath.id)">
                            <img class="star-icon" :src="'../svg/star-yellow.svg'" alt="お気に入り 星アイコン 黄色">
                        </a>
                        <a v-else @click="addFavorite(bath.id)">
                            <img class="star-icon" :src="'../svg/star-gray.svg'" alt="お気に入り 星アイコン 灰色">
                        </a>
                    </div>
                    <div class="mark-block">
                        <review-result :bath="bath"></review-result>
                        <!-- <ul class="mark" v-if="bath.is_rock !== null && bath.is_sauna !== null">
                            <li class="rock" v-if="bath.is_rock !== null">岩盤浴有</li>
                            <li class="sauna" v-if="bath.is_sauna !== null">サウナ有</li>
                        </ul> -->
                    </div>
                    <div class="text-info">
                        <p class="place">{{ bath.place }} {{ bath.city }}</p>
                        <p class="closing-day">{{ bath.closing_day }}</p>
                        <!-- <ul class="time">
                            <li class="holiday" v-if="bath.holiday_time !== null">土日：{{ bath.holiday_time }}</li><li v-else>土日：記載なし</li>
                            <li class="weekday" v-if="bath.weekday_time !== null">平日：{{ bath.weekday_time }}</li><li v-else>平日：記載なし</li>
                        </ul> -->
                    </div>
                    <!-- <div class="link-block">
                        <a class="post-link">みんなの投稿</a>
                    </div> -->
                </li>
            </ul>
            <p class="no-result" v-if="baths.length === 0">検索結果は有りません。</p>
        </div>
    </div>
</template>

<script>
    import ReviewResult from './ReviewResult';

    export default {
        components: {
            'review-result': ReviewResult,
        },
        data() {
            return {
                evalBlocks: {
                    all:      { name: '全体評価', nameTag: 'eval', rowSelectedEval: '', highSelectedEval: '', errorRow: 'row', errorHigh: 'high' },
                    hotWater: { name: 'お湯評価', nameTag: 'hot_water_eval', rowSelectedEval: '', highSelectedEval: '', errorRow: 'row-hot-water', errorHigh: 'high-hot-water' },
                    rock:     { name: '岩盤浴評価', nameTag: 'rock_eval', rowSelectedEval: '', highSelectedEval: '', errorRow: 'row-rock', errorHigh: 'high-rock' },
                    sauna:    { name: 'サウナ評価', nameTag: 'sauna_eval', rowSelectedEval: '', highSelectedEval: '', errorRow: 'row-sauna', errorHigh: 'high-sauna' },
                },
                selectedPrefecture: '',
                keyword: '',
                baths: {},
                isFavoritedId: {},
                resFavoritedId: '',
                isLogin: '',
            }
        },
        props: {
            selectData: { type: Object },
        },
        methods: {
            getBathsInfo() {
                axios.defaults.baseURL = process.env.VUE_APP_API_ENDPOINT
                const url = '/bath/search';
                $('.form-block .error').text('');
                axios.post(url, {
                    prefecture: this.selectedPrefecture,
                    keyword: this.keyword,
                    row_eval: this.evalBlocks.all.rowSelectedEval,
                    row_hot_water_eval: this.evalBlocks.hotWater.rowSelectedEval,
                    row_rock_eval: this.evalBlocks.rock.rowSelectedEval,
                    row_sauna_eval: this.evalBlocks.sauna.rowSelectedEval,
                    high_eval: this.evalBlocks.all.highSelectedEval,
                    high_hot_water_eval: this.evalBlocks.hotWater.highSelectedEval,
                    high_rock_eval: this.evalBlocks.rock.highSelectedEval,
                    high_sauna_eval: this.evalBlocks.sauna.highSelectedEval,
                })
                .then(response => {
                    this.baths = response.data.baths;
                    this.isFavoritedId = response.data.isFavoritedId;
                    this.isLogin = response.data.isLogin;

                    const headerHeight = $('#header').height();
                    $("html,body").animate({scrollTop:$('.search-result').offset().top - headerHeight}, 1000);
                })
                .catch(e => {
                    $('.form-block .prefecture-error').text(e.response.data.errors.prefecture);
                    $('.form-block .keyword-error').text(e.response.data.errors.keyword);
                    $('.form-block .row-eval-error').text(e.response.data.errors.row_eval);
                    $('.form-block .high-eval-error').text(e.response.data.errors.high_eval);
                    $('.form-block .row-hot-water-eval-error').text(e.response.data.errors.row_hot_water_eval);
                    $('.form-block .high-hot-water-eval-error').text(e.response.data.errors.high_hot_water_eval);
                    $('.form-block .row-rock-eval-error').text(e.response.data.errors.row_rock_eval);
                    $('.form-block .high-rock-eval-error').text(e.response.data.errors.high_rock_eval);
                    $('.form-block .row-sauna-eval-error').text(e.response.data.errors.row_sauna_eval);
                    $('.form-block .high-sauna-eval-error').text(e.response.data.errors.high_sauna_eval);
                    $('.form-block .field-error').text(e.response.data.errors.field);
                })
            },
            addFavorite(bathId) {
                if(!this.isLogin) {
                    const $popup = $('#bathSearch .popup');
                    $popup.addClass('flex');
                    $popup.removeClass('hide');
                    return false;
                }

                const url = '/bath/addFavorite';
                $('.search-result .error').text('');
                axios.post(url, {
                    bathId: bathId,
                })
                .then(response => {
                    this.isFavoritedId.push(response.data);
                    this.resFavoritedId = response.data;
                })
                .catch(e => {
                    $('.search-result .favorite-error').text(e.response.data.errors.bathId);
                })
            },
            unFavorite(bathId) {
                const url = '/bath/unFavorite';
                $('.search-result .error').text('');
                axios.post(url, {
                    bathId: bathId,
                })
                .then(response => {
                    let val = response.data,
                        index = this.isFavoritedId.indexOf(val);

                    this.isFavoritedId.splice(index, 1);
                    this.resFavoritedId = response.data;
                })
                .catch(e => {
                    $('.search-result .favorite-error').text(e.response.data.errors.bathId);
                })
            }
        }
    }
</script>
