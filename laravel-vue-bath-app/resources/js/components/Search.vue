<template>
    <div class="form-block">
        <p class="prefecture-error error"></p>
        <p class="keyword-error error"></p>
        <p class="field-error error"></p>
        <div class="prefecture-keyword">
            <select class="prefecture field" name="prefecture" v-model="selectedPrefecture">
                <option value=""  hidden>都道府県を選択してください</option>
                <option v-for="prefecture in selectData.prefectures" :key="prefecture.code" :value="prefecture.code">{{ prefecture.name }}</option>
            </select>
            <input class="keyword field" type="search" name="keyword" v-model="keyword" placeholder="キーワードを入力してください">
        </div>
        <div class="eval-select">
            <p class="row-eval-error error"></p><p class="high-eval-error error"></p>
            <div class="eval-block">
                <label for="" class="select-form-title">全体評価</label>
                <select class="eval field" name="eval" v-model="rowSelectedEval">
                    <option value=""  hidden>全体評価</option>
                    <option v-for="e in selectData.eval" :key="e.code" :value="e.code">{{ e.name }}</option>
                </select>
                <span>〜</span>
                <select class="eval field" name="eval" v-model="highSelectedEval">
                    <option value=""  hidden>全体評価</option>
                    <option v-for="e in selectData.eval" :key="e.code" :value="e.code">{{ e.name }}</option>
                </select>
            </div>
            <p class="row-hot-water-eval-error error"></p><p class="high-hot-water-eval-error error"></p>
            <div class="eval-block">
                <label for="" class="select-form-title">お湯評価</label>
                <select class="eval field" name="hot_water_eval" v-model="rowSelectedHotWaterEval">
                    <option value="" hidden>お湯評価</option>
                    <option v-for="e in selectData.eval" v-bind:key="e.code" :value="e.code">{{ e.name }}</option>
                </select>
                <span>〜</span>
                <select class="eval field" name="hot_water_eval" v-model="highSelectedHotWaterEval">
                    <option value="" hidden>お湯評価</option>
                    <option v-for="e in selectData.eval" v-bind:key="e.code" :value="e.code">{{ e.name }}</option>
                </select>
            </div>
            <p class="row-rock-eval-error error"></p><p class="high-rock-eval-error error"></p>
            <div class="eval-block">
                <label for="" class="select-form-title">岩盤浴評価</label>
                <select class="eval field" name="rock_eval" v-model="rowSelectedRockEval">
                    <option value="" hidden>岩盤浴評価</option>
                    <option v-for="e in selectData.eval" v-bind:key="e.code" :value="e.code">{{ e.name }}</option>
                </select>
                <span>〜</span>
                <select class="eval field" name="rock_eval" v-model="highSelectedRockEval">
                    <option value="" hidden>岩盤浴評価</option>
                    <option v-for="e in selectData.eval" v-bind:key="e.code" :value="e.code">{{ e.name }}</option>
                </select>
            </div>
            <p class="row-sauna-eval-error error"></p><p class="high-sauna-eval-error error"></p>
            <div class="eval-block">
                <label for="" class="select-form-title">サウナ評価</label>
                <select class="eval field" name="sauna_eval" v-model="rowSelectedSaunaEval">
                    <option value="" hidden>サウナ評価</option>
                    <option v-for="e in selectData.eval" v-bind:key="e.code" :value="e.code">{{ e.name }}</option>
                </select>
                <span>〜</span>
                <select class="eval field" name="sauna_eval" v-model="highSelectedSaunaEval">
                    <option value="" hidden>サウナ評価</option>
                    <option v-for="e in selectData.eval" v-bind:key="e.code" :value="e.code">{{ e.name }}</option>
                </select>
            </div>
        </div>
        <button class="field" @click="getBathsInfo()">検索する</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedPrefecture: '',
                keyword: '',
                rowSelectedEval: '',
                rowSelectedHotWaterEval: '',
                rowSelectedRockEval: '',
                rowSelectedSaunaEval: '',
                highSelectedEval: '',
                highSelectedHotWaterEval: '',
                highSelectedRockEval: '',
                highSelectedSaunaEval: ''
            }
        },
        props: {
            selectData: { type: Object },
        },
        methods: {
            getBathsInfo() {
                const url = '/bath/search/';
                $('.form-block .error').text('');
                axios.post(url, {
                    prefecture: this.selectedPrefecture,
                    keyword: this.keyword,
                    row_eval: this.rowSelectedEval,
                    row_hot_water_eval: this.rowSelectedHotWaterEval,
                    row_rock_eval: this.rowSelectedRockEval,
                    row_sauna_eval: this.rowSelectedSaunaEval,
                    high_eval: this.highSelectedEval,
                    high_hot_water_eval: this.highSelectedHotWaterEval,
                    high_rock_eval: this.highSelectedRockEval,
                    high_sauna_eval: this.highSelectedSaunaEval,
                })
                .then(response => {
                })
                .catch(e => {
                    // console.log(e.response.data.errors);
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
            }
        }
    }
</script>
