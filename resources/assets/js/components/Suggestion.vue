<template>
    <form @submit.prevent="submitSuggestion()" id="suggest-form">
        <div class="form-wrapper">
            <title>问题或建议</title>
            <mt-field placeholder="请描述您的问题或建议，我们将尽快优化体验，感谢您的反馈。" type="textarea" rows="6"></mt-field>
        </div>
        <div class="form-wrapper">
            <mt-button type="primary" size="large">提交</mt-button>
        </div>
    </form>
</template>

<script>
    import { Field } from 'mint-ui';
    import { Button } from 'mint-ui';
    export default{
        data(){
            return{
                suggestion:''
            }
        },
        components:{
            Field, Button
        },
        methods:{
            submitSuggestion:function(){

            }
        }
    }
</script>
