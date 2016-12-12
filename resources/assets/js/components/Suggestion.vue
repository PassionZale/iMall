<template>
    <form id="suggest-form" @submit.prevent="submitSuggestion()">
        <div class="form-wrapper">
            <title>问题或建议</title>
            <mt-field
                    placeholder="请描述您的问题或建议，我们将尽快优化体验，感谢您的反馈。"
                    slot="suggestion"
                    type="textarea"
                    rows="6"
                    :value.sync="suggestion">
            </mt-field>
        </div>
        <div class="form-wrapper">
            <mt-button :disabled="form_disabled" type="primary" size="large">提交</mt-button>
        </div>
    </form>
</template>

<script>
    import { Field } from 'mint-ui';
    import { Button } from 'mint-ui';
    export default{
        data(){
            return{
                suggestion:'',
                form_disabled:true
            }
        },
        components:{
            Field, Button
        },
        watch:{
            'suggestion':{
                handler:function(val){
                    val !== '' ? this.$set('form_disabled', false)
                    : this.$set('form_disabled', true);
                }
            }
        },
        methods:{
            submitSuggestion:function(){
                console.log(this.suggestion);
            }
        }
    }
</script>
