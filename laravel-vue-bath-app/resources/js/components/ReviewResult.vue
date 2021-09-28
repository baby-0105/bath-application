<template>
    <div class="review">
        <p class="whole-review" v-if="isEvaluated(bath.eval_cd)">{{ bath.eval_cd }}</p><p class="whole-review" v-else>--</p>
        <ul class="others-review">
            <li v-if="isEvaluated(bath.hot_water_eval_cd)">{{ bath.hot_water_eval_cd }}</li> <li v-else>--</li>
            <li v-if="isEvaluated(bath.rock_eval_cd)">{{ bath.rock_eval_cd }}</li> <li v-else>--</li>
            <li v-if="isEvaluated(bath.sauna_eval_cd)">{{ bath.sauna_eval_cd }}</li> <li v-else>--</li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        props: [ 'bath' ],
        computed: {
            isEvaluated() {
                return function(evalCd) {
                    return evalCd !== null;
                }
            },
        },
    }
</script>
