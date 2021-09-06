<template>
    <div class="bath-search list">
        <label class="field-name">お風呂検索<span class="red">*</span></label>
        <div class="search-block">
            <p class="prefecture-error error"></p>
            <p class="keyword-error error"></p>
            <p class="field-error error"></p>
            <div class="search-field">
                <select class="select" v-model="selectedPrefecture">
                    <option value="">都道府県を選択してください</option>
                    <option v-for="prefecture in prefectures" :key="prefecture.code" :value="prefecture.code">{{ prefecture.name }}</option>
                </select>
                <div class="tablet-field">
                    <input class="keyword" v-model="keyword" placeholder="キーワードを入力してください" type="text">
                    <button type="button" class="search-btn" @click="searchBath()"></button>
                </div>
            </div>
            <div class="search-result" v-if="baths.length > 0">
                <select class="select bath-select" v-model="selectedBath" name="bath_code">
                    <option value="">お風呂を選択してください</option>
                    <option v-for="bath in baths" :key="bath.id" :value="bath.id">{{ bath.name }}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedPrefecture: '',
                keyword: '',
                selectedBath: '',
                baths: {},
            }
        },
        props: {
            prefectures: { type: Array },
        },
        methods: {
            searchBath() {
                const url = '/post/search/';
                $('.bath-search .error').text('');
                axios.post(url, {
                    prefecture: this.selectedPrefecture,
                    keyword: this.keyword,
                })
                .then(response => {
                    this.baths = response.data;
                })
                .catch(e => {
                    $('.bath-search .prefecture-error').text(e.response.data.errors.prefecture);
                    $('.bath-search .keyword-error').text(e.response.data.errors.keyword);
                    $('.bath-search .field-error').text(e.response.data.errors.field);
                })
            },
        }
    }
</script>

<style lang="scss">
    .post-form .search-block {
        width: 80%;
        @media screen and (max-width: 760px) {
            width: 100%;
        }
    }

    .post-form .search-field {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        @media screen and (max-width: 1024px) {
            flex-direction: column;
        }
    }

    .post-form .search-field .select {
        width: 40%;
        @media screen and (max-width: 1024px) {
            width: 100%;
        }
    }

    .post-form .search-field .keyword {
        width: 75%;
        @media screen and (max-width: 1024px) {
            width: 80%;
        }
    }

    .post-form .search-field .search-btn {
        border: 1px solid #222;
        border-radius: 5px;
        padding: 14px;
        width: 25%;
        &:hover {
            color: #ffffff;
            background: #222;
        }
    }

    .post-form .search-field .tablet-field {
        display: flex;
        align-items: center;
        width: 60%;
        @media screen and (max-width: 1024px) {
            width: 100%;
            justify-content: space-between;
        }
    }

    .post-form .search-result .bath-select {
        width: 100%;
        background: #dfdfdf;
    }

    .post-form .search-btn { &:after { content: '検索'; }}
</style>
